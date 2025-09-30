<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Event;
use App\Models\RaceEventNumber;
use App\Models\RegistrationEvent;
use App\Models\RegistrationEventClub;
use App\Models\RegistrationEventDetail;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class RegistrationEventController extends Controller
{
    public function index()
    {
        $events = Event::withCount('participants')->latest()->get();
        $registeredEventIds = [];
        if (Auth::check() && Auth::user()->club_id) {
            $registeredEventIds = RegistrationEvent::whereHas('participants', function ($query) {
                $query->where('club', Auth::user()->club->name_club);
            })->pluck('event_id')->toArray();
        }
        return view('admin.registration-events.daftar.index', [
            'page_title' => 'Daftar Perlombaan',
            'events' => $events,
            'registeredEventIds' => $registeredEventIds
        ]);
    }

    public function create($encrypted_id)
    {
        try {
            $id = Crypt::decryptString($encrypted_id);
        } catch (\Exception $e) {
            abort(404);
        }

        $event = Event::findOrFail($id);

        $race_numbers = RaceEventNumber::orderBy('name')->get();
        $clubMembers = [];
        if (Auth::check() && Auth::user()->club_id) {
            $clubMembers = User::with('sportClass')
                ->where('club_id', Auth::user()->club_id)
                ->orderBy('fullname', 'asc')
                ->get();
        }
        return view('admin.registration-events.daftar.create', [
            'page_title' => 'Formulir Pendaftaran',
            'event' => $event,
            'race_numbers' => $race_numbers,
            'clubMembers' => $clubMembers
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'participants' => 'required|array|min:1',
            'participants.*.name' => 'required|string|max:255',
            'participants.*.gender' => 'required|in:male,female',
            'participants.*.date_of_birth' => 'required|date',
            'participants.*.coach_name' => 'required|string|max:255',
            'participants.*.phone' => 'required|string|max:20',
            'participants.*.race_numbers' => 'required|array|min:1',
            'participants.*.race_numbers.*' => 'exists:race_event_numbers,id',
        ]);

        $event = Event::findOrFail($request->event_id);

        foreach ($request->participants as $participantData) {
            $isAlreadyRegistered = RegistrationEventClub::where('name', $participantData['name'])
                ->whereHas('registrationEvent', function ($query) use ($request) {
                    $query->where('event_id', $request->event_id);
                })->exists();

            if ($isAlreadyRegistered) {
                return redirect()->back()
                    ->with('failed', 'Pendaftaran gagal: Peserta dengan nama "' . $participantData['name'] . '" sudah terdaftar pada event ini.')
                    ->withInput();
            }

            foreach ($participantData['race_numbers'] as $race_number_id) {
                $raceNumber = RaceEventNumber::findOrFail($race_number_id);

                if (!is_null($raceNumber->max_participants)) {
                    $registeredCount = RegistrationEventDetail::whereHas('registrationEvent', function ($query) use ($request) {
                        $query->where('event_id', $request->event_id);
                    })->where('race_event_number_id', $race_number_id)->count();

                    if ($registeredCount >= $raceNumber->max_participants) {
                        return redirect()->back()
                            ->with('failed', 'Pendaftaran gagal: Kuota untuk nomor lomba "' . $raceNumber->name . '" sudah penuh.')
                            ->withInput();
                    }
                }

                if ($raceNumber->category_event == 'age_category') {
                    if (empty($participantData['date_of_birth']) || !strtotime($participantData['date_of_birth'])) {
                        return redirect()->back()
                            ->with('failed', 'Pendaftaran gagal: Tanggal lahir untuk peserta "' . $participantData['name'] . '" tidak valid atau kosong.')
                            ->withInput();
                    }

                    $birthDate = Carbon::parse($participantData['date_of_birth']);
                    $age = $birthDate->diffInYears($event->date_technical); // Perhitungan umur tetap pakai tanggal event

                    // Ambil syarat umur dari $raceNumber
                    $minAge = (int) preg_replace('/[^0-9]/', '', $raceNumber->age_category);
                    $maxAge = (int) preg_replace('/[^0-9]/', '', $raceNumber->max_age);

                    if ($age < $minAge || $age > $maxAge) {
                        return redirect()->back()
                            ->with('failed', 'Pendaftaran gagal: Umur peserta "' . $participantData['name'] . '" (' . $age . ' tahun) tidak memenuhi syarat umur ' . $minAge . ' - ' . $maxAge . ' tahun untuk nomor lomba "' . $raceNumber->name . '".')
                            ->withInput();
                    }

                } elseif ($raceNumber->category_event == 'class_category') {
                    $participantClass = $participantData['class'] ?? null;

                    // check class partisipan
                    if ($participantClass !== $raceNumber->class_category) {
                        return redirect()->back()
                            ->with('failed', 'Pendaftaran gagal: Kelas peserta "' . $participantData['name'] . '" (' . $participantClass . ') tidak sesuai dengan kategori nomor lomba "' . $raceNumber->name . '" (' . $raceNumber->class_category . ').')
                            ->withInput();
                    }
                }
            }
        }

        DB::beginTransaction();
        try {
            $registration = RegistrationEvent::create([
                'event_id' => $request->event_id,
                'user_id' => Auth::id(),
                'total' => 0,
            ]);

            $grandTotal = 0;

            foreach ($request->participants as $participantData) {
                $clubName = Auth::user()->club->name_club ?? 'Klub Tidak Terdaftar';
                $participant = $registration->participants()->create([
                    'club' => $clubName,
                    'name' => $participantData['name'],
                    'gender' => $participantData['gender'],
                    'date_of_birth' => $participantData['date_of_birth'],
                    'school' => $participantData['school'] ?? null,
                    'class' => $participantData['class'] ?? null,
                    'coach_name' => $participantData['coach_name'],
                    'phone' => $participantData['phone'],
                ]);

                $selectedRaceNumbers = RaceEventNumber::find($participantData['race_numbers']);

                foreach ($selectedRaceNumbers as $race) {
                    $participant->details()->create([
                        'registration_event_id' => $registration->id,
                        'race_event_number_id' => $race->id,
                        'name' => $race->name,
                        'price' => $race->price,
                    ]);
                    $grandTotal += $race->price;
                }
            }

            $registration->total = $grandTotal;
            $registration->save();
            DB::commit();

            return redirect()->route('my-participations.index')->with('success', 'Pendaftaran untuk ' . count($request->participants) . ' peserta berhasil.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('failed', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
    public function myParticipations()
    {
        $events = collect();
        if (Auth::check() && Auth::user()->club_id) {
            $participatedEventIds = RegistrationEventClub::where('club', Auth::user()->club->name_club)
                ->with('registrationEvent')
                ->get()
                ->pluck('registrationEvent.event_id')
                ->unique()
                ->filter();

            if ($participatedEventIds->isNotEmpty()) {
                $events = Event::withCount('participants')->whereIn('id', $participatedEventIds)->latest()->get();
            }
        }
        return view('admin.registration-events.partisipasi.index', [
            'page_title' => 'Partisipasi',
            'events' => $events,
        ]);
    }

    public function getMyParticipationsData(Request $request)
    {
        if ($request->ajax()) {
            $data = RegistrationEventClub::with('registrationEvent.event')
                ->latest()
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('event_name', function ($row) {
                    return $row->registrationEvent->event->name ?? 'N/A';
                })
                ->addColumn('club_name', function ($row) {
                    return $row->club ?? 'N/A';
                })
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-info btn-sm">Detail</button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function showParticipationDetail($encrypted_id)
    {
        try {
            $id = Crypt::decryptString($encrypted_id);
        } catch (\Exception $e) {
            abort(404);
        }

        $event = Event::findOrFail($id);

        return view('admin.registration-events.partisipasi.detail-partisipasi', [
            'page_title' => 'Detail Partisipasi: ' . $event->name,
            'event' => $event
        ]);
    }

    public function getParticipationDetailsData(Request $request, Event $event)
    {
        if ($request->ajax()) {
            $data = RegistrationEventClub::with('registrationEvent.event')
                ->whereHas('registrationEvent', function ($query) use ($event) {
                    $query->where('event_id', $event->id);
                })
                ->latest()
                ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('event_name', function ($row) {
                    return $row->registrationEvent->event->name ?? 'N/A';
                })
                ->addColumn('club_name', function ($row) {
                    return $row->club ?? 'N/A';
                })
                ->make(true);
        }
    }

    public function showCompetitionSchedule($encrypted_id)
    {
        try {
            $id = Crypt::decryptString($encrypted_id);
            $event = Event::findOrFail($id);
        } catch (DecryptException $e) {
            abort(404);
        }

        $details = RegistrationEventDetail::with(['participant', 'raceEventNumber'])
            ->whereHas('registrationEvent', function ($query) use ($event) {
                $query->where('event_id', $event->id);
            })
            ->get();

        $groupedSchedule = collect();

        $uniqueCombinations = $details->groupBy([
            'race_event_number_id',
            function ($item) {
                return $item->participant->class ?? 'N/A';
            }
        ]);

        foreach ($uniqueCombinations as $raceNumberId => $classesByRace) {
            foreach ($classesByRace as $class => $participants) {
                $firstDetail = $participants->first();
                if ($firstDetail && $firstDetail->raceEventNumber) {
                    $groupedSchedule->push([
                        'race_name' => $firstDetail->raceEventNumber->name,
                        'class' => $class,
                        'putra_count' => $participants->whereIn('participant.gender', ['male', 'L'])->count(),
                        'putri_count' => $participants->whereIn('participant.gender', ['female', 'P'])->count(),
                    ]);
                }
            }
        }

        $sortedSchedule = $groupedSchedule->sortBy('race_name')->values();

        return view('admin.registration-events.partisipasi.competition-schedule', [
            'page_title' => 'Susunan Acara Lomba',
            'event' => $event,
            'scheduleItems' => $sortedSchedule
        ]);
    }

    public function showBukuAcara($eventId)
    {
        $raceEventNumbers = RaceEventNumber::where('event_id', $eventId)->get();
        return view('admin.registration-events.partisipasi.buku-acara.buku-acara', compact('raceEventNumbers'));
    }

    public function showEventBook(Request $request, $encrypted_id)
    {
        try {
            $id = Crypt::decryptString($encrypted_id);
            $event = Event::findOrFail($id);
        } catch (DecryptException $e) {
            abort(404);
        }

        if ($request->has('group_count') && $request->has('start_time')) {
            $request->validate([
                'start_time' => 'required|date_format:H:i',
                'group_count' => 'required|integer|min:1',
            ]);

            DB::beginTransaction();
            try {
                RegistrationEventDetail::whereHas('registrationEvent', function ($query) use ($event) {
                    $query->where('event_id', $event->id);
                })->update([
                            'seri' => null,
                            'lintasan' => null,
                            'waktu_mulai' => null,
                            'hasil' => null,
                            'status' => null,
                            'posisi' => null
                        ]);

                $allDetails = RegistrationEventDetail::with(['participant', 'raceEventNumber'])
                    ->whereHas('registrationEvent', function ($query) use ($event) {
                        $query->where('event_id', 'like', '%' . $event->id . '%');
                    })->get();
                $participantsByRace = $allDetails->groupBy('race_event_number_id');
                $localHeatsToSchedule = [];

                // reset buat acara
                if ($request->has('master_override')) {
                    $raceIds = $participantsByRace->keys();
                    RaceEventNumber::whereIn('id', $raceIds)->update([
                        'max_participants' => $request->input('group_count')
                    ]);
                }
                foreach ($participantsByRace as $raceId => $participants) {
                    $seriCounter = 1;
                    $clubsInRace = $participants->pluck('participant.club')->unique();

                    $max_swimmers_per_local_heat = 0;

                    $max_swimmers_per_local_heat = 0;

                    if ($request->has('master_override')) {
                        $max_swimmers_per_local_heat = $request->input('group_count');
                    } else {
                        $max_swimmers_per_local_heat = $participants->first()->raceEventNumber->max_participants;
                        if (is_null($max_swimmers_per_local_heat)) {
                            $max_swimmers_per_local_heat = $request->input('group_count');
                        }
                    }
                    if (empty($max_swimmers_per_local_heat) || $max_swimmers_per_local_heat <= 0) {
                        //atur lint
                        $max_swimmers_per_local_heat = 8;
                    }
                    if ($clubsInRace->count() <= 1) {
                        $chunks = $participants->chunk($max_swimmers_per_local_heat);
                    } else {
                        $participantsByClub = $participants->groupBy('participant.club');
                        $maxSwimmersInAClub = $participantsByClub->max(function ($swimmers) {
                            return $swimmers->count();
                        });
                        $distributedParticipants = collect();
                        for ($i = 0; $i < $maxSwimmersInAClub; $i++) {
                            foreach ($participantsByClub as $swimmers) {
                                if (isset($swimmers[$i]))
                                    $distributedParticipants->push($swimmers[$i]);
                            }
                        }
                        $chunks = $distributedParticipants->chunk($max_swimmers_per_local_heat);
                    }
                    foreach ($chunks as $chunk) {
                        $localHeatsToSchedule[] = (object) [
                            'race_name' => $chunk->first()->raceEventNumber->name,
                            'seri' => $seriCounter++,
                            'participants' => $chunk->values()
                        ];
                    }
                }

                $startTime = Carbon::parse($request->input('start_time'));
                $durationPerHeat = 2;
                $maxLanes = 9;
                $timeSlots = [];

                foreach ($localHeatsToSchedule as $localHeat) {
                    $heatSize = $localHeat->participants->count();
                    $placed = false;
                    $searchIndex = 0;

                    while (!$placed) {
                        if (!isset($timeSlots[$searchIndex])) {
                            $timeSlots[$searchIndex] = [
                                'time' => $startTime->copy()->addMinutes($searchIndex * $durationPerHeat),
                                'lanes' => array_fill(1, $maxLanes, null)
                            ];
                        }

                        $emptyLanesCount = 0;
                        $startLane = -1;
                        for ($i = 1; $i <= $maxLanes; $i++) {
                            if ($timeSlots[$searchIndex]['lanes'][$i] === null) {
                                if ($startLane == -1)
                                    $startLane = $i;
                                $emptyLanesCount++;
                            } else {
                                $emptyLanesCount = 0;
                                $startLane = -1;
                            }

                            if ($emptyLanesCount >= $heatSize) {
                                $p_index = 0;
                                foreach ($localHeat->participants as $participant) {
                                    $laneNumber = $startLane + $p_index;
                                    $timeSlots[$searchIndex]['lanes'][$laneNumber] = $participant;

                                    $participant->update([
                                        'seri' => $localHeat->seri,
                                        'lintasan' => $laneNumber,
                                        'waktu_mulai' => $timeSlots[$searchIndex]['time']->format('H:i:s'),
                                    ]);
                                    $p_index++;
                                }
                                $placed = true;
                                break;
                            }
                        }
                        $searchIndex++;
                    }
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('failed', 'Gagal membuat buku acara: ' . $e->getMessage());
            }
        }

        // Ambil data yang sudah tersimpan di database untuk ditampilkan
        $details = RegistrationEventDetail::with(['participant', 'raceEventNumber'])
            ->whereHas('registrationEvent', function ($query) use ($event) {
                $query->where('event_id', $event->id);
            })
            ->whereNotNull('seri')
            ->orderBy('waktu_mulai')->orderBy('race_event_number_id')->orderBy('seri')->orderBy('lintasan')
            ->get();

        $eventBookData = $details->groupBy('raceEventNumber.name');

        return view('admin.registration-events.partisipasi.buku-acara.buku-acara', [
            'page_title' => 'Buku Acara',
            'event' => $event,
            'eventBookData' => $eventBookData,
        ]);
    }

    // Simpan hasil lomba
    public function updateEventBookResults(Request $request, $encrypted_id)
    {
        $request->validate([
            'results' => 'required|array',
            'results.*' => 'array',
        ]);

        $id = Crypt::decryptString($encrypted_id);

        DB::beginTransaction();
        try {
            $allRaceIds = [];
            foreach ($request->results as $detailId => $data) {
                $detail = RegistrationEventDetail::findOrFail($detailId);
                $status = $data['status'] ?? null;
                $hasil = $data['hasil'] ?? null;
                $lintasan = $data['lintasan'] ?? $detail->lintasan;
                // Jika status NS atau DQ, hasil dan posisi di-null-kan
                if ($status === 'NS' || $status === 'DQ') {
                    $hasil = null;
                    $posisi = null;
                } else {
                    $status = null;
                    $posisi = $detail->posisi;
                }

                $detail->update([
                    'hasil' => $hasil,
                    'status' => $status,
                    'posisi' => $posisi,
                    'lintasan' => $lintasan,
                ]);

                if (!in_array($detail->race_event_number_id, $allRaceIds)) {
                    $allRaceIds[] = $detail->race_event_number_id;
                }
            }

            // Setelah semua diupdate, hitung ulang posisi untuk setiap nomor lomba 
            foreach ($allRaceIds as $raceId) {
                $participantsToRank = RegistrationEventDetail::whereHas('registrationEvent', function ($query) use ($id) {
                    $query->where('event_id', $id);
                })
                    ->where('race_event_number_id', $raceId)
                    ->whereNull('status') // Hanya yang tidak NS/DQ
                    ->whereNotNull('hasil') // Hanya yang punya hasil
                    ->where('hasil', '!=', '')
                    ->orderBy('hasil', 'asc') // Urutkan berdasarkan waktu tercepat
                    ->get();

                $rank = 1;
                foreach ($participantsToRank as $participant) {
                    $participant->update(['posisi' => $rank++]);
                }
            }

            DB::commit();
            // return redirect()->back()->with('success', 'Hasil perlombaan berhasil disimpan.');
            //biar ga ke reset
            return redirect()->route('my-participations.event-book', $encrypted_id)
                ->with('success', 'Hasil perlombaan berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('failed', 'Terjadi kesalahan saat menyimpan hasil: ' . $e->getMessage());
        }
    }

    public function cetakBukuAcaraPdf($encrypted_id)
    {
        try {
            $id = \Illuminate\Support\Facades\Crypt::decryptString($encrypted_id);
            $event = \App\Models\Event::findOrFail($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404);
        }

        $details = \App\Models\RegistrationEventDetail::with(['participant', 'raceEventNumber'])
            ->whereHas('registrationEvent', function ($query) use ($event) {
                $query->where('event_id', $event->id);
            })
            ->whereNotNull('seri')
            ->orderBy('waktu_mulai')->orderBy('race_event_number_id')->orderBy('seri')->orderBy('lintasan')
            ->get();

        $eventBookData = $details->groupBy('raceEventNumber.name');

        $pdf = PDF::loadView('admin.registration-events.partisipasi.buku-acara.buku-acara-pdf', [
            'event' => $event,
            'eventBookData' => $eventBookData
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('Buku Acara - ' . $event->name . '.pdf');
    }
    //Show Buku Hasil
    public function showBukuHasil($encrypted_id)
    {
        try {
            $id = \Illuminate\Support\Facades\Crypt::decryptString($encrypted_id);
            $event = \App\Models\Event::findOrFail($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404);
        }

        $allResults = \App\Models\RegistrationEventDetail::with(['participant', 'raceEventNumber'])
            ->whereHas('registrationEvent', function ($query) use ($event) {
                $query->where('event_id', $event->id);
            })
            ->whereNotNull('hasil')
            ->where('hasil', '!=', '')
            ->whereNull('status')
            ->orderBy('hasil', 'asc') // Urutan sudah dari yang tercepat
            ->get();

        $eventBookData = $allResults->groupBy('raceEventNumber.name');

        return view('admin.registration-events.partisipasi.buku-hasil.buku-hasil', [
            'page_title' => 'Buku Hasil',
            'event' => $event,
            'eventBookData' => $eventBookData,
        ]);
    }

    public function cetakBukuHasilPdf($encrypted_id)
    {
        try {
            $id = \Illuminate\Support\Facades\Crypt::decryptString($encrypted_id);
            $event = \App\Models\Event::findOrFail($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404);
        }

        // Ambil SEMUA data hasil, bukan hanya 3 teratas
        $allResults = \App\Models\RegistrationEventDetail::with(['participant', 'raceEventNumber'])
            ->whereHas('registrationEvent', function ($query) use ($event) {
                $query->where('event_id', $event->id);
            })
            ->whereNotNull('hasil')->where('hasil', '!=', '')->whereNull('status')
            ->orderBy('hasil', 'asc')
            ->get();

        // Kelompokkan semua hasil berdasarkan nama lombanya
        $eventBookData = $allResults->groupBy('raceEventNumber.name');

        // Load view PDF dengan data yang sudah lengkap
        $pdf = PDF::loadView('admin.registration-events.partisipasi.buku-hasil.buku-hasil-pdf', [
            'event' => $event,
            'eventBookData' => $eventBookData
        ])->setPaper('a4', 'landscape'); // Atur kertas menjadi A4 landscape

        return $pdf->stream('Buku Hasil - ' . $event->name . '.pdf');
    }

    //Show Juara
    public function showJuara($encrypted_id)
    {
        try {
            $id = \Illuminate\Support\Facades\Crypt::decryptString($encrypted_id);
            $event = \App\Models\Event::findOrFail($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404);
        }

        $winners = \App\Models\RegistrationEventDetail::with('participant')
            ->whereHas('registrationEvent', function ($query) use ($event) {
                $query->where('event_id', $event->id);
            })
            ->whereIn('posisi', [1, 2, 3])
            ->get();

        $standings = $winners->groupBy('participant.club')
            ->map(function ($teamWinners, $clubName) {
                return [
                    'club_name' => $clubName,
                    'gold' => $teamWinners->where('posisi', 1)->count(),
                    'silver' => $teamWinners->where('posisi', 2)->count(),
                    'bronze' => $teamWinners->where('posisi', 3)->count(),
                ];
            })

            ->sort(function ($a, $b) {
                // Urutkan berdasarkan Emas (descending)
                if ($a['gold'] !== $b['gold']) {
                    return $b['gold'] <=> $a['gold'];
                }
                // Jika Emas sama, urutkan berdasarkan Perak (descending)
                if ($a['silver'] !== $b['silver']) {
                    return $b['silver'] <=> $a['silver'];
                }
                // Jika Perak sama, urutkan berdasarkan Perunggu (descending)
                return $b['bronze'] <=> $a['bronze'];
            })
            ->values();

        return view('admin.registration-events.partisipasi.juara.juara', [
            'page_title' => 'Klasemen Juara',
            'event' => $event,
            'standings' => $standings,
        ]);
    }

    public function cetakJuaraPdf($encrypted_id)
    {
        try {
            $id = \Illuminate\Support\Facades\Crypt::decryptString($encrypted_id);
            $event = \App\Models\Event::findOrFail($id);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404);
        }

        $winners = \App\Models\RegistrationEventDetail::with('participant')
            ->whereHas('registrationEvent', function ($query) use ($event) {
                $query->where('event_id', $event->id);
            })
            ->whereIn('posisi', [1, 2, 3])
            ->get();

        $standings = $winners->groupBy('participant.club')
            ->map(function ($teamWinners, $clubName) {
                return [
                    'club_name' => $clubName,
                    'gold' => $teamWinners->where('posisi', 1)->count(),
                    'silver' => $teamWinners->where('posisi', 2)->count(),
                    'bronze' => $teamWinners->where('posisi', 3)->count(),
                ];
            })
            ->sort(function ($a, $b) {
                if ($a['gold'] !== $b['gold']) {
                    return $b['gold'] <=> $a['gold'];
                }
                if ($a['silver'] !== $b['silver']) {
                    return $b['silver'] <=> $a['silver'];
                }
                return $b['bronze'] <=> $a['bronze'];
            })
            ->values();

        $pdf = PDF::loadView('admin.registration-events.partisipasi.juara.juara-pdf', [
            'event' => $event,
            'standings' => $standings
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('Klasemen Juara - ' . $event->name . '.pdf');
    }

}
