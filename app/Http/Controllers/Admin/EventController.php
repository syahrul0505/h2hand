<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\SportClass;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index()
    {
        return view('admin.events.index', [
            'page_title' => 'Manajemen Event'
        ]);
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Event::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('start_registration_date', function ($row) {
                    return Carbon::parse($row->start_registration_date)->format('d M Y');
                })
                ->addColumn('end_registration_date', function ($row) {
                    return Carbon::parse($row->end_registration_date)->format('d M Y');
                })
                ->addColumn('date_technical', function ($row) {
                    return Carbon::parse($row->date_technical)->format('d M Y');
                })
                ->addColumn('date_of_competition', function ($row) {
                    return $row->date_of_competition ? $row->date_of_competition->format('d M Y') : '';
                })
                ->addColumn('location', function ($row) {
                    if ($row->location_link) {
                        return '<a href="' . $row->location_link . '" target="_blank">' . $row->location . '</a>';
                    }
                    return $row->location;
                })
                ->addColumn('status_badge', function ($row) {
                    $badgeClass = 'bg-info';
                    if ($row->status == 'finished') {
                        $badgeClass = 'bg-success';
                    } elseif ($row->status == 'ongoing') {
                        $badgeClass = 'bg-warning';
                    }
                    return '<span class="badge ' . $badgeClass . '">' . Str::title($row->status) . '</span>';
                })
                ->addColumn('action', function ($row) {
                    // Gunakan $row->id untuk akses ID event yang benar
                    $editUrl = route('events.modal-edit', $row->id);
                    $deleteUrl = route('events.modal-delete', $row->id);
                    $actionBtn = '
                    <button class="btn btn-primary btn-sm event-edit-table" data-bs-toggle="modal" data-bs-target="#tabs-' . $row->id . '-edit-event" data-url="' . $editUrl . '">Edit</button>
                    <button class="btn btn-danger btn-sm event-delete-table" data-bs-toggle="modal" data-bs-target="#tabs-' . $row->id . '-delete-event" data-url="' . $deleteUrl . '">Delete</button>
                ';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status_badge', 'location'])
                ->make(true);
        }
    }

    public function getModalAdd()
    {
        // Hapus variabel $classes karena tidak digunakan di view
        return view('admin.events.modal-add');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateRequest($request);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/events');
            $validatedData['image'] = Storage::url($imagePath);
        }
        Event::create($validatedData);
        return redirect()->route('events.index')->with('success', 'Event berhasil dibuat.');
    }

    public function getModalEdit(Event $event)
    {
        // Hapus variabel $classes karena tidak digunakan di view
        return view('admin.events.modal-edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validatedData = $this->validateRequest($request, $event->id);
        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::delete(str_replace('/storage', 'public', $event->image));
            }
            $imagePath = $request->file('image')->store('public/events');
            $validatedData['image'] = Storage::url($imagePath);
        }
        $event->update($validatedData);
        return redirect()->route('events.index')->with('success', 'Event berhasil diperbarui.');
    }

    public function getModalDelete(Event $event)
    {
        return view('admin.events.modal-delete', compact('event'));
    }

    public function destroy(Event $event)
    {
        if ($event->image) {
            Storage::delete(str_replace('/storage', 'public', $event->image));
        }
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event berhasil dihapus.');
    }

    private function validateRequest(Request $request, $eventId = null)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'start_registration_date' => 'required|date',
            'end_registration_date' => 'required|date|after_or_equal:start_registration_date',
            'date_technical' => 'required|date',
            'date_of_competition' => 'required|date|after_or_equal:date_technical',
            'location' => 'required|string',
            'location_link' => 'nullable|url',
            'status' => 'required|string',
            'max_people' => 'nullable|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }
}