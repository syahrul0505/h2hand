@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Poster Homepage</h6>
                <a href="{{ route('admin.posters.create') }}" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah Poster Baru</span>
                </a>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle" id="dataTable" width="100%"
                        cellspacing="0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%;">No.</th>
                                <th style="width: 15%;">Gambar</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($posters as $poster)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        @if($poster->image)
                                            <img src="{{ Storage::url($poster->image) }}" alt="{{ $poster->title }}"
                                                class="img-thumbnail" style="width: 120px; height: auto; object-fit: cover;">
                                        @else
                                            <span class="text-muted">Tidak ada gambar</span>
                                        @endif
                                    </td>
                                    <td>{{ $poster->title }}</td>
                                    <td class="small">
                                        {{ Str::limit(strip_tags($poster->description), 150, '...') }}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Aksi Poster">
                                            <a href="{{ route('admin.posters.edit', $poster) }}" class="btn btn-warning btn-sm"
                                                title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{ route('admin.posters.destroy', $poster) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Yakin ingin menghapus poster ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        Belum ada data poster. Silakan tambahkan poster baru.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection