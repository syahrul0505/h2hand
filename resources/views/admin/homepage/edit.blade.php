@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Poster</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.posters.update', $poster) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="title" class="form-label">Judul</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ $poster->title }}"
                                    required>
                            </div>

                            <textarea name="description" id="editor" class="form-control" rows="10">
                                {{ old('description', $poster->description ?? '') }}
                            </textarea>

                            <div class="mb-3">
                                <label for="image" class="form-label">Ganti Gambar Poster (Kosongkan jika tidak ingin
                                    diubah)</label>
                                <input type="file" name="image" id="image" class="form-control">
                                <div class="mt-2">
                                    <p>Gambar saat ini:</p>
                                    <img src="{{ Storage::url($poster->image) }}" width="200" alt="Current Image">
                                </div>
                            </div>

                            <a href="{{ route('admin.posters.manage') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection