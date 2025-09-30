@extends('web.layouts.app')

@push('styles')
    <style>
        main.main-wrapper {
            padding-top: 85px;
        }

        .page-header {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset('assets/images/homepage/swiper00.jpg') }}') center center;
            background-size: cover;
            color: white;
        }

        .page-header .text-primary {
            color: #841b1bff !important; 
            text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
        }

        .form-wrapper {
            background-color: #fff;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }
    </style>
@endpush

@section('content')
    <main class="main-wrapper">
        <section class="page-header text-center py-10 py-md-12">
            <div class="container">
                <h1 class="display-3 fw-bold text-primary">Daftar Sekarang</h1>
                <p class="lead fs-22">Bergabunglah dengan komunitas para juara Rajendra Project.</p>
            </div>
        </section>

        <section class="wrapper">
            <div class="container py-10 py-md-12">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-7">
                        <div class="form-wrapper">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="fullname" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="fullname" name="fullname" value="{{ old('fullname') }}" required>
                                        @error('fullname')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nik" class="form-label">NIK</label>
                                        <input type="text" class="form-control" id="nik" name="nik" value="{{ old('nik') }}" required>
                                        @error('nik')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone_number" class="form-label">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required>
                                        @error('phone_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="date_of_birth" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                                        @error('date_of_birth')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="gender" class="form-label">Jenis Kelamin</label>
                                        <select class="form-control" id="gender" name="gender" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        @error('gender')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="school_name" class="form-label">Nama Sekolah</label>
                                    <input type="text" class="form-control" id="school_name" name="school_name" value="{{ old('school_name') }}" required>
                                    @error('school_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="club_id" class="form-label">Club</label>
                                        <select class="form-control" id="club_id" name="club_id" required>
                                            <option value="">Pilih Club</option>
                                            @foreach($clubs as $club)
                                                <option value="{{ $club->id }}" {{ old('club_id') == $club->id ? 'selected' : '' }}>{{ $club->name_club }}</option>
                                            @endforeach
                                        </select>
                                        @error('club_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="class_id" class="form-label">Kelas</label>
                                        <select class="form-control" id="class_id" name="class_id" required>
                                            <option value="">Pilih Kelas</option>
                                            @foreach($classes as $class)
                                                <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('class_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg rounded-xl">Daftar Sekarang</button>
                                </div>

                                <div class="text-center mt-3">
                                    <p>Sudah punya akun? <a href="{{ route('login') }}" class="text-primary">Login di sini</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection