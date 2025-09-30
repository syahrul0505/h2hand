<div class="modal fade modal-notification" id="tabs-add-class" tabindex="-1" role="dialog"
    aria-labelledby="tabsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('class.store') }}" method="post" class="modal-content">
            @csrf
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <div class="icon-content m-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-package">
                            <line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line>
                            <path
                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                            </path>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                    </div>
                </div>

                <div class="text-center mb-3 mt-3">
                    <h4 class="mb-0">ADD CLASS</h4>
                </div>

                <div class="mt-0 row">
                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Nama</label>
                            <input type="text" name="name" class="form-control form-control-sm"
                                placeholder="Ex: Kelas Reguler Pagi" id="name" value="{{ old('name') }}">
                            @if($errors->has('name'))
                            <p class="text-danger">{{ $errors->first('name') }}</p>@endif
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label for="type">Tipe</label>
                            <input type="text" name="type" class="form-control form-control-sm"
                                placeholder="Ex: Reguler" id="type" value="{{ old('type') }}">
                            @if($errors->has('type'))
                            <p class="text-danger">{{ $errors->first('type') }}</p>@endif
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label for="grade">Jenjang (opsional)</label>
                            <input type="text" name="grade" class="form-control form-control-sm" placeholder="Ex: U-12"
                                id="grade" value="{{ old('grade') }}">
                            @if($errors->has('grade'))
                            <p class="text-danger">{{ $errors->first('grade') }}</p>@endif
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label for="registration_fee">Biaya Registrasi</label>
                            <input type="number" name="registration_fee" class="form-control form-control-sm"
                                placeholder="0" id="registration_fee" value="{{ old('registration_fee', 0) }}"
                                step="any">
                            @if($errors->has('registration_fee'))
                            <p class="text-danger">{{ $errors->first('registration_fee') }}</p>@endif
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label for="regular_contribution_price">Harga Iuran Reguler</label>
                            <input type="number" name="regular_contribution_price" class="form-control form-control-sm"
                                placeholder="0" id="regular_contribution_price"
                                value="{{ old('regular_contribution_price', 0) }}" step="any">
                            @if($errors->has('regular_contribution_price'))
                            <p class="text-danger">{{ $errors->first('regular_contribution_price') }}</p>@endif
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label for="quota_package_price">Harga Paket Kuota</label>
                            <input type="number" name="quota_package_price" class="form-control form-control-sm"
                                placeholder="0" id="quota_package_price" value="{{ old('quota_package_price', 0) }}"
                                step="any">
                            @if($errors->has('quota_package_price'))
                            <p class="text-danger">{{ $errors->first('quota_package_price') }}</p>@endif
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="number_of_attendance">Jumlah Kehadiran (per paket)</label>
                            <input type="number" name="number_of_attendance" class="form-control form-control-sm"
                                placeholder="0" id="number_of_attendance" value="{{ old('number_of_attendance', 0) }}">
                            @if($errors->has('number_of_attendance'))
                            <p class="text-danger">{{ $errors->first('number_of_attendance') }}</p>@endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-dark" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>