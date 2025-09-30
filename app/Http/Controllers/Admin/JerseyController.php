<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Jersey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class JerseyController extends Controller
{
    public function index()
    {
        $page_title = 'Manajemen Jersey';
        return view('admin.jersey.index', compact('page_title'));
    }

    public function getData()
    {
        $jerseys = Jersey::query();

        return DataTables::of($jerseys)
            ->addIndexColumn()
            ->editColumn('show_on_registration_form', function ($jersey) {
                return $jersey->show_on_registration_form ? '<span class="badge badge-success">Ya</span>' : '<span class="badge badge-danger">Tidak</span>';
            })
            ->editColumn('back_number', function ($jersey) {
                return $jersey->back_number ? '<span class="badge badge-success">Ya</span>' : '<span class="badge badge-danger">Tidak</span>';
            })
            ->editColumn('back_name', function ($jersey) {
                return $jersey->back_name ? '<span class="badge badge-success">Ya</span>' : '<span class="badge badge-danger">Tidak</span>';
            })
            ->addColumn('action', function ($jersey) {
                $editButton = '<button type="button" class="btn btn-sm btn-info jerseys-edit-table" data-bs-toggle="modal" data-bs-target="#tabs-' . $jersey->id . '-edit-jersey">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                            </button>';
                $deleteButton = '<button type="button" class="btn btn-sm btn-danger jerseys-delete-table" data-bs-toggle="modal" data-bs-target="#tabs-' . $jersey->id . '-delete-jersey">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            </button>';
                return $editButton . ' ' . $deleteButton;
            })
            ->rawColumns(['action', 'show_on_registration_form', 'back_number', 'back_name'])
            ->make(true);
    }
    //create
    public function getModalAdd()
    {
        return view('admin.jersey.modal-add');
    }

    public function create()
    {
        return view('jerseys.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'size' => 'required|string|max:255',
            'show_on_registration_form' => 'required|boolean',
            'back_number' => 'required|boolean',
            'back_name' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk gambar
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('jersey_images', 'public');
        }

        Jersey::create($validatedData);

        return redirect()->route('jerseys.index')->with('success', 'Jersey created successfully.');
    }

    //read
    public function show(Jersey $jersey)
    {

        return view('jerseys.show', compact('jersey'));
    }

    //edit
    public function getModalEdit(Jersey $jersey)
    {
        return view('admin.jersey.modal-edit', compact('jersey'));
    }

    public function edit(Jersey $jersey)
    {

        return view('jerseys.edit', compact('jersey'));
    }

    public function update(Request $request, Jersey $jersey)
    {
        $validatedData = $request->validate([
            'size' => 'required|string|max:255',
            'show_on_registration_form' => 'required|boolean',
            'back_number' => 'required|boolean',
            'back_name' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($jersey->image) {
                Storage::disk('public')->delete($jersey->image);
            }
            $validatedData['image'] = $request->file('image')->store('jersey_images', 'public');
        }

        $jersey->update($validatedData);

        return redirect()->route('jerseys.index')->with('success', 'Jersey updated successfully.');
    }

    //delete
    public function getModalDelete(Jersey $jersey)
    {
        return view('admin.jersey.modal-delete', compact('jersey'));
    }

    public function destroy(Jersey $jersey)
    {
        if ($jersey->image) {
            Storage::disk('public')->delete($jersey->image);
        }

        $jersey->delete();
        return redirect()->route('jerseys.index')->with('success', 'Jersey deleted successfully.');
    }
}