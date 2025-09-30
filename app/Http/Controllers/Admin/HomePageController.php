<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poster;
use Illuminate\Support\Facades\Storage;

class HomePageController extends Controller
{
    // ... metode index() dan managePosters() tetap sama ...
    public function index()
    {
        $posters = Poster::latest()->take(3)->get();
        return view('web.homepage.index', compact('posters'));
    }

    public function show(Poster $poster)
    {
        return view('web.homepage.show', compact('poster'));
    }

    public function managePosters()
    {
        $posters = Poster::all();
        // Pastikan baris ini persis seperti ini
        return view('admin.homepage.manage', compact('posters'));
    }


    public function create()
    {
        return view('admin.homepage.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('public/posters');

        Poster::create([
            'title' => $request->title,
            'description' => $request->description, // Simpan deskripsi
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.posters.manage')->with('success', 'Poster berhasil ditambahkan.');
    }

    public function edit(Poster $poster)
    {
        return view('admin.homepage.edit', compact('poster'));
    }

    public function update(Request $request, Poster $poster)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $poster->image;

        if ($request->hasFile('image')) {
            Storage::delete($poster->image);
            $imagePath = $request->file('image')->store('public/posters');
        }

        $poster->update([
            'title' => $request->title,
            'description' => $request->description, // Update deskripsi
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.posters.manage')->with('success', 'Poster berhasil diperbarui.');
    }

    // ... metode destroy() tetap sama ...
    public function destroy(Poster $poster)
    {
        Storage::delete($poster->image);
        $poster->delete();

        return redirect()->route('admin.posters.manage')->with('success', 'Poster berhasil dihapus.');
    }
}