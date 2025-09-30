<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Event;
use App\Models\Invoice;
use App\Models\RegistrationEvent;
use App\Models\RegistrationEventDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    public function index()
    {
        $page_title = 'Tagihan Klub per Event';
        return view('admin.invoices.index', compact('page_title'));
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $participations = RegistrationEvent::with('user.club', 'event')
                ->get()
                ->map(function ($reg) {
                    return [
                        'event_id' => $reg->event_id,
                        'club_id' => $reg->user->club_id ?? null
                    ];
                })
                ->filter()
                ->unique()
                ->values();

            foreach ($participations as $participation) {
                $eventId = $participation['event_id'];
                $clubId = $participation['club_id'];

                $totalAmount = RegistrationEvent::where('event_id', $eventId)
                    ->whereHas('user', function ($query) use ($clubId) {
                        $query->where('club_id', $clubId);
                    })
                    ->sum('total');

                $event = Event::find($eventId);
                $paymentDate = Carbon::parse($event->end_registration_date);
                $dueDate = $paymentDate->copy()->addDays(5);

                Invoice::updateOrCreate(
                    [
                        'event_id' => $eventId,
                        'club_id' => $clubId,
                    ],
                    [
                        'invoice_number' => 'INV-' . Carbon::now()->format('Ymd') . '-' . $clubId . '-' . $eventId,
                        'payment_date' => $paymentDate->toDateString(),
                        'due_date' => $dueDate->toDateString(),
                        'total_amount' => $totalAmount,
                    ]
                );
            }

            $data = Invoice::with(['event', 'club', 'transactions'])->latest()->get();
            foreach ($data as $invoice) {
                if ($invoice->status === 'unpaid') {
                    $totalDiscounts = $invoice->transactions->sum('discount_amount');
                    if (bccomp((string) ($invoice->paid_amount + $totalDiscounts), (string) $invoice->total_amount, 2) >= 0) {
                        $invoice->status = 'paid';
                    }
                }
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('payment_date', function ($row) {
                    return Carbon::parse($row->payment_date)->translatedFormat('d F Y');
                })
                ->editColumn('due_date', function ($row) {
                    return Carbon::parse($row->due_date)->translatedFormat('d F Y');
                })
                ->addColumn('subjek', function ($row) {
                    return $row->event->name ?? 'N/A';
                })
                ->addColumn('nama_club', function ($row) {
                    return $row->club->name_club ?? 'Klub Dihapus';
                })
                ->addColumn('total_pembayaran', function ($row) {
                    return 'Rp ' . number_format($row->total_amount, 0, ',', '.');
                })
                ->addColumn('sisa_pembayaran', function ($row) {
                    //  Perhitungan sisa tagihan + diskon
                    $totalDiscounts = $row->transactions->sum('discount_amount');
                    $remaining = $row->total_amount - $row->paid_amount - $totalDiscounts;
                    $remaining = max(0, $remaining); // Pastikan tidak minus
                    return 'Rp ' . number_format($remaining, 0, ',', '.');
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'paid') {
                        return '<span class="badge badge-light-success">Lunas</span>';
                    } else {
                        return '<span class="badge badge-light-warning">Belum Lunas</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $detailBtn = '<a href="' . route('invoices.show', $row->id) . '" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                      </a>';
                    $downloadBtn = '<a href="' . route('invoices.cetak-pdf', $row->id) . '" class="btn btn-success btn-sm ms-2" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak PDF">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                                        </a>';

                    return $detailBtn . ' ' . $downloadBtn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }

    private function isParticipantPaid(Invoice $invoice, int $participantId): bool
    {
        $totalCost = RegistrationEventDetail::whereHas('registrationEvent', function ($query) use ($invoice) {
            $query->where('event_id', $invoice->event_id)
                ->whereHas('user', function ($subQuery) use ($invoice) {
                    $subQuery->where('club_id', $invoice->club_id);
                });
        })->whereHas('participant', function ($q) use ($participantId) {
            $q->where('id', $participantId);
        })->sum('price');

        if ($totalCost <= 0) {
            return false;
        }

        $paidAmount = $invoice->transactions()->where('user_id', $participantId)->sum('amount');
        return bccomp((string) $paidAmount, (string) $totalCost, 2) >= 0;
    }

    public function show(Invoice $invoice)
    {

        if ($invoice->status == 'unpaid') {
            $totalDiscounts = $invoice->transactions()->sum('discount_amount');
            $totalPayable = $invoice->total_amount;

            // Jika (Total Dibayar + Total Diskon) >= Total Tagihan
            if (bccomp((string) ($invoice->paid_amount + $totalDiscounts), (string) $totalPayable, 2) >= 0) {
                $invoice->status = 'paid';
                $invoice->save(); 
            }
        }
        $invoice->load(['club', 'event', 'transactions.participant']);

        $details = RegistrationEventDetail::whereHas('registrationEvent', function ($query) use ($invoice) {
            $query->where('event_id', $invoice->event_id)->whereHas('user', function ($subQuery) use ($invoice) {
                $subQuery->where('club_id', $invoice->club_id);
            });
        })->with('participant')->get();

        $groupedDetails = [];
        foreach ($details as $detail) {
            $participantId = $detail->participant->id ?? null;
            if (!$participantId)
                continue;

            if (!isset($groupedDetails[$participantId])) {
                $user = User::where('fullname', $detail->participant->name)->first();

                // Hitung total dibayar & total diskon dari transaksi
                $transactions = $invoice->transactions()->when($user, function ($query) use ($user) {
                    return $query->where('user_id', $user->id);
                });
                $paidAmount = $transactions->sum('amount');
                $discountAmount = $transactions->sum('discount_amount');

                $groupedDetails[$participantId] = [
                    'participant_name' => $detail->participant->name,
                    'races' => [],
                    'total_price' => 0,
                    'paid_amount' => $paidAmount,
                    'discount_amount' => $discountAmount, 
                    'user_id' => $user ? $user->id : null
                ];
            }

            $groupedDetails[$participantId]['races'][] = ['name' => $detail->name, 'price' => $detail->price];
            $groupedDetails[$participantId]['total_price'] += $detail->price;
        }

        foreach ($groupedDetails as &$participant) {
            $totalPrice = $participant['total_price'];
            $paidAmount = $participant['paid_amount'];
            $discountAmount = $participant['discount_amount'];

            //  (dibayar + diskon) >= total tagihan
            $isPaid = (bccomp((string) ($paidAmount + $discountAmount), (string) $totalPrice, 2) >= 0) && $totalPrice > 0;
            $participant['is_paid'] = $isPaid;
        }

        $page_title = 'Detail Tagihan: ' . ($invoice->club->name_club ?? '');
        return view('admin.invoices.show-invoice', compact('invoice', 'page_title', 'groupedDetails'));
    }

    public function showConfirmationForm(Invoice $invoice)
    {
        $page_title = 'Konfirmasi Pembayaran';
        $clubUsers = \App\Models\User::where('club_id', $invoice->club_id)
            ->pluck('id', 'fullname')
            ->toArray();

        $details = RegistrationEventDetail::whereHas('registrationEvent', function ($query) use ($invoice) {
            $query->where('event_id', $invoice->event_id)->whereHas('user', function ($subQuery) use ($invoice) {
                $subQuery->where('club_id', $invoice->club_id);
            });
        })->with('participant')->get();

        $paidDataByUser = $invoice->transactions()
            ->whereNotNull('user_id')
            ->groupBy('user_id')
            ->selectRaw('user_id, SUM(amount) as total_paid, SUM(discount_amount) as total_discount')
            ->get()
            ->keyBy('user_id');

        // Hitung total diskon dari semua transaksi di invoice ini
        $totalDiscounts = $invoice->transactions()->sum('discount_amount');

        // Hitung sisa tagihan dengan benar: Total - Dibayar - Diskon
        $remainingClubInvoice = $invoice->total_amount - $invoice->paid_amount - $totalDiscounts;

        $totalGeneralPaid = $invoice->transactions()->whereNull('user_id')->sum('amount');

        $groupedDetails = [];
        foreach ($details as $detail) {
            if (empty($detail->participant) || empty($detail->participant->name)) {
                continue;
            }
            $participantName = $detail->participant->name;
            $participantUserId = $clubUsers[$participantName] ?? null;

            if (!$participantUserId) {
                continue;
            }

            if (!isset($groupedDetails[$participantUserId])) {
                $paidAmount = $paidDataByUser->has($participantUserId) ? $paidDataByUser[$participantUserId]->total_paid : 0;
                $discountAmount = $paidDataByUser->has($participantUserId) ? $paidDataByUser[$participantUserId]->total_discount : 0;

                $groupedDetails[$participantUserId] = [
                    'participant_name' => $participantName,
                    'total_price' => 0,
                    'paid_amount' => $paidAmount,
                    'discount_amount' => $discountAmount,
                ];
            }
            $groupedDetails[$participantUserId]['total_price'] += $detail->price;
        }

        foreach ($groupedDetails as &$detail) {
            $totalDeduction = $detail['paid_amount'] + $detail['discount_amount'];
            $detail['remaining_price'] = max(0, $detail['total_price'] - $totalDeduction);
        }

        return view('admin.invoices.konfirmasi-invoice', compact(
            'invoice',
            'page_title',
            'groupedDetails',
            'totalGeneralPaid',
            'remainingClubInvoice',
            'totalDiscounts' 
        ));
    }

    public function storeConfirmation(Request $request, Invoice $invoice)
    {
        $validator = Validator::make($request->all(), [
            'transaction_date' => 'required|date',
            'payment_method' => 'required|string',
            'amount' => 'required|numeric|min:0', 
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'participant_id' => 'nullable|exists:users,id',
            'discount_type' => 'nullable|in:price,percent',
            'discount_value' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $userId = $request->participant_id;
            if (!$userId) {
                //(tanpa diskon individual)
                $inputAmount = $request->amount;
                $maxAllowedAmount = ($invoice->total_amount - $invoice->discount) - $invoice->paid_amount;
                if (bccomp((string) $inputAmount, (string) $maxAllowedAmount, 2) === 1) {
                    return redirect()->back()->with('failed', 'Jumlah pembayaran melebihi sisa tagihan klub.')->withInput();
                }

            } else {
                // dengan diskon
                $user = User::find($userId);
                $participantTotalCost = RegistrationEventDetail::whereHas('registrationEvent', function ($query) use ($invoice) {
                    $query->where('event_id', $invoice->event_id);
                })->whereHas('participant', function ($q) use ($user) {
                    $q->where('name', $user->fullname);
                })->sum('price');

                $participantPaidAmount = $invoice->transactions()->where('user_id', $userId)->sum('amount');
                $participantDiscountAmount = $invoice->transactions()->where('user_id', $userId)->sum('discount_amount');
                $sisaTagihanPeserta = $participantTotalCost - ($participantPaidAmount + $participantDiscountAmount);

                if ($sisaTagihanPeserta <= 0) {
                    return redirect()->back()->with('failed', 'Gagal! Tagihan untuk peserta ini sudah lunas.')->withInput();
                }

                $discountAmount = 0;
                if ($request->filled('discount_type') && $request->filled('discount_value')) {
                    if ($request->discount_type === 'percent') {
                        $discountAmount = ($sisaTagihanPeserta * $request->discount_value) / 100;
                    } else {
                        $discountAmount = $request->discount_value;
                    }
                }

                $totalYangHarusDilunasi = $sisaTagihanPeserta - $discountAmount;
                $inputAmount = $request->amount;

                // total pembayaran + diskon tidak boleh melebihi sisa tagihan
                if (bccomp((string) ($inputAmount + $discountAmount), (string) $sisaTagihanPeserta, 2) === 1) {
                    return redirect()->back()->with('failed', 'Kombinasi pembayaran dan diskon melebihi sisa tagihan peserta.')->withInput();
                }
            }


            $filePath = $request->file('payment_proof')->store('public/payment_proofs');

            $invoice->transactions()->create([
                'transaction_date' => $request->transaction_date,
                'payment_method' => $request->payment_method,
                'amount' => $inputAmount,
                'discount_amount' => $discountAmount ?? 0, 
                'payment_proof' => $filePath,
                'user_id' => $userId,
            ]);

            $invoice->paid_amount += $inputAmount;

            //Hitung total diskon dari SEMUA transaksi di invoice ini
            $totalDiscounts = $invoice->transactions()->sum('discount_amount');

            //Total yang harus dibayar adalah total tagihan
            $totalPayable = $invoice->total_amount;

            //Kondisi lunas: (Total Dibayar + Total Diskon) >= Total Tagihan
            if (bccomp((string) ($invoice->paid_amount + $totalDiscounts), (string) $totalPayable, 2) >= 0) {
                $invoice->status = 'paid';
            } else {
                $invoice->status = 'unpaid';
            }
            $invoice->save();

            DB::commit();
            return redirect()->route('invoices.show', $invoice->id)->with('success', 'Pembayaran berhasil dikonfirmasi.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('failed', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function cetakPDF(Invoice $invoice)
    {
        $invoice->load('transactions.participant');
        $details = RegistrationEventDetail::whereHas('registrationEvent', function ($query) use ($invoice) {
            $query->where('event_id', $invoice->event_id)->whereHas('user', function ($subQuery) use ($invoice) {
                $subQuery->where('club_id', $invoice->club_id);
            });
        })->with('participant')->get();

        $groupedDetails = [];
        foreach ($details as $detail) {
            $participantId = $detail->participant->id ?? null;
            if (!$participantId)
                continue;

            if (!isset($groupedDetails[$participantId])) {
                $user = User::where('fullname', $detail->participant->name)->first();

                // Hitung total dibayar & total diskon dari transaksi
                $transactions = $invoice->transactions()->when($user, function ($query) use ($user) {
                    return $query->where('user_id', $user->id);
                });
                $paidAmount = $transactions->sum('amount');
                $discountAmount = $transactions->sum('discount_amount');

                $groupedDetails[$participantId] = [
                    'participant_name' => $detail->participant->name,
                    'races' => [],
                    'total_price' => 0,
                    'paid_amount' => $paidAmount,
                    'discount_amount' => $discountAmount, // Data diskon
                    'user_id' => $user ? $user->id : null
                ];
            }

            $groupedDetails[$participantId]['races'][] = ['name' => $detail->name, 'price' => $detail->price,];
            $groupedDetails[$participantId]['total_price'] += $detail->price;
        }

        // Periksa status pembayaran untuk /peserta DENGAN  DISKON
        foreach ($groupedDetails as &$participant) {
            $totalPrice = $participant['total_price'];
            $paidAmount = $participant['paid_amount'];
            $discountAmount = $participant['discount_amount'];

            // (dibayar + diskon) >= total tagihan
            $isPaid = (bccomp((string) ($paidAmount + $discountAmount), (string) $totalPrice, 2) >= 0) && $totalPrice > 0;
            $participant['is_paid'] = $isPaid;
        }

        $pdf = Pdf::loadView('admin.invoices.pdf_invoice', compact('invoice', 'groupedDetails'));

        return $pdf->download('invoice-' . $invoice->invoice_number . '.pdf');
    }

}