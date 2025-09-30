<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\RaceEventNumber;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\SportClass;
use Illuminate\Support\Facades\Crypt;

class RaceEventNumberController extends Controller
{
    public function index()
    {
        return view('admin.race-event-numbers.index', [
            'page_title' => ' Manajemen Race Event Numbers',
        ]);
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = RaceEventNumber::orderBy('name', 'asc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('price', function ($row) {
                    return 'Rp ' . number_format($row->price, 0, ',', '.');
                })
                ->addColumn('max_participants', function ($row) {
                    return $row->max_participants ?? '-';
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('race-event-numbers.modal-edit', $row->id);
                    $deleteUrl = route('race-event-numbers.modal-delete', $row->id);
                    $actionBtn = '
                        <button class="btn btn-primary btn-sm ren-edit-table" data-bs-target="#tabs-' . $row->id . '-edit-ren" data-url="' . $editUrl . '">Edit</button>
                        <button class="btn btn-danger btn-sm ren-delete-table" data-bs-toggle="modal" data-bs-target="#tabs-' . $row->id . '-delete-ren" data-url="' . $deleteUrl . '">Delete</button>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getModalAdd()
    {
        $classes = SportClass::orderBy('name')->get();
        return view('admin.race-event-numbers.modal-add', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'max_participants' => 'nullable|integer|min:1',
            'category_event' => 'required|in:age_category,class_category',
            'age_category' => 'required_if:category_event,age_category|nullable|string|max:255',
            'max_age' => 'required_if:category_event,age_category|nullable|string|max:255',
            'class_category' => 'required_if:category_event,class_category|nullable|string|max:255',
        ]);

        RaceEventNumber::create($request->all());

        return redirect()->route('race-event-numbers.index')->with('success', 'Nomor Lomba berhasil dibuat.');
    }

    public function getModalEdit(RaceEventNumber $raceEventNumber)
    {
        $classes = SportClass::orderBy('name')->get();
        return view('admin.race-event-numbers.modal-edit', compact('raceEventNumber', 'classes'));
    }

    public function update(Request $request, RaceEventNumber $raceEventNumber)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'max_participants' => 'nullable|integer|min:1',
            'category_event' => 'required|in:age_category,class_category',
            'age_category' => 'required_if:category_event,age_category|nullable|string|max:255',
            'max_age' => 'required_if:category_event,age_category|nullable|string|max:255',
            'class_category' => 'required_if:category_event,class_category|nullable|string|max:255',
        ]);

        $raceEventNumber->update($request->all());

        return redirect()->route('race-event-numbers.index')->with('success', 'Nomor Lomba berhasil diperbarui.');
    }

    public function getModalDelete(RaceEventNumber $raceEventNumber)
    {
        return view('admin.race-event-numbers.modal-delete', compact('raceEventNumber'));
    }

    public function destroy(RaceEventNumber $raceEventNumber)
    {
        $raceEventNumber->delete();
        return redirect()->route('race-event-numbers.index')->with('success', 'Nomor Lomba berhasil dihapus.');
    }

    public function updateMaxParticipants(Request $request, RaceEventNumber $raceEventNumber)
    {
        $request->validate([
            'group_count' => 'required|integer|min:1',
            'event_id' => 'required', 
            'start_time' => 'required', 
        ]);

        $raceEventNumber->max_participants = $request->group_count;
        $raceEventNumber->save();

        $encryptedId = $request->event_id;
        session()->flash('success', 'Maksimal peserta berhasil diperbarui. Buku Acara dibuat ulang.');

        return redirect()->route('my-participations.event-book', [
            'encrypted_id' => $encryptedId,
            'group_count' => $request->group_count,
            'start_time' => $request->start_time,
        ]);
    }
}