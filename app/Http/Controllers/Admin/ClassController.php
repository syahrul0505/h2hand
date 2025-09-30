<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\SportClass;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ClassController extends Controller
{
    public function index()
    {
        $page_title = 'Manajemen Class';
        return view('admin.class.index', compact('page_title'));
    }

    public function getData()
    {
        $classes = SportClass::query();

        return DataTables::of($classes)
            ->addIndexColumn()
            ->editColumn('registration_fee', function ($class) {
                return 'Rp ' . number_format($class->registration_fee, 0, ',', '.');
            })
            ->addColumn('action', function ($class) {
                // Edit
                $editButton = '<button type="button" class="btn btn-sm btn-info class-edit-table" data-bs-toggle="modal" data-bs-target="#tabs-' . $class->id . '-edit-class">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                        </button>';

                // Delete
                $deleteButton = '<button type="button" class="btn btn-sm btn-danger class-delete-table" data-bs-toggle="modal" data-bs-target="#tabs-' . $class->id . '-delete-class">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                        </button>';

                return $editButton . ' ' . $deleteButton;
            })
            ->rawColumns(['action']) 
            ->make(true);
    }

    public function getModalAdd()
    {
        return view('admin.class.modal-add');
    }
    public function create()
    {
        return view('class.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'grade' => 'nullable|string|max:255',
            'registration_fee' => 'required|numeric|min:0',
            'regular_contribution_price' => 'required|numeric|min:0',
            'quota_package_price' => 'required|numeric|min:0',
            'number_of_attendance' => 'required|integer|min:0',
        ]);

        SportClass::create($validatedData);

        return redirect()->route('class.index')->with('success', 'Class created successfully.');
    }

    //read
    public function show(SportClass $class)
    {
        return view('class.show', compact('class'));
    }

    public function getModalEdit(SportClass $class)
    {
        return view('admin.class.modal-edit', compact('class'));
    }

    //form edit
    public function edit(SportClass $class)
    {
        return view('class.edit', compact('class'));
    }

    public function update(Request $request, SportClass $class)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'grade' => 'nullable|string|max:255',
            'registration_fee' => 'required|numeric|min:0',
            'regular_contribution_price' => 'required|numeric|min:0',
            'quota_package_price' => 'required|numeric|min:0',
            'number_of_attendance' => 'required|integer|min:0',
        ]);

        $class->update($validatedData);

        return redirect()->route('class.index')->with('success', 'Class updated successfully.');
    }

    public function getModalDelete(SportClass $class)
    {
        return view('admin.class.modal-delete', compact('class'));
    }
    //Hapus
    public function destroy(SportClass $class)
    {
        $class->delete();
        return redirect()->route('class.index')->with('success', 'Class deleted successfully.');
    }
}