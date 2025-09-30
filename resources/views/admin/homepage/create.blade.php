@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Poster Baru</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.posters.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Judul</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>

                            <textarea name="description" id="editor" class="form-control" rows="10">
                                {{ old('description', $poster->description ?? '') }}
                            </textarea>

                            <div class="mb-3">
                                <label for="image" class="form-label">Gambar Poster</label>
                                <input type="file" name="image" id="image" class="form-control" required>
                            </div>

                            <a href="{{ route('admin.posters.manage') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection