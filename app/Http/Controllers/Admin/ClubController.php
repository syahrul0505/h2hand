<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Club;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ClubController extends Controller
{

    public function index()
    {
        $page_title = 'Daftar Klub';
        return view('admin.clubs.index', compact('page_title'));
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Club::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editBtn = '<button type="button" class="btn btn-warning btn-sm club-edit-table" data-bs-toggle="modal" data-bs-target="#tabs-' . $row->id . '-edit-club">Edit</button>';
                    $deleteBtn = '<button type="button" class="btn btn-danger btn-sm ms-2 club-delete-table" data-bs-toggle="modal" data-bs-target="#tabs-' . $row->id . '-delete-club">Delete</button>';
                    return $editBtn . ' ' . $deleteBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create()
    {
        return view('admin.clubs.modal-add');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name_club' => 'required|string|max:255|unique:clubs,name_club',
        ]);

        Club::create($request->all());

        return redirect()->route('clubs.index')->with('success', 'Klub berhasil ditambahkan!');
    }


    public function edit(Club $club)
    {
        return view('admin.clubs.modal-edit', compact('club'));
    }

    public function update(Request $request, Club $club)
    {
        $request->validate([
            'name_club' => 'required|string|max:255|unique:clubs,name_club,' . $club->id,
        ]);

        $club->update($request->all());

        return redirect()->route('clubs.index')->with('success', 'Klub berhasil diperbarui!');
    }


    public function destroyView(Club $club)
    {
        return view('admin.clubs.modal-delete', compact('club'));
    }

    public function destroy(Club $club)
    {
        $club->delete();
        return redirect()->route('clubs.index')->with('success', 'Klub berhasil dihapus!');
    }
}
