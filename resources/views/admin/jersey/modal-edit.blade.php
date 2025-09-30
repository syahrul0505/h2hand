<div class="modal fade modal-notification" id="tabs-{{ $jersey->id }}-edit-jersey" tabindex="-1" role="dialog"
    aria-labelledby="tabsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('jerseys.update', $jersey->id) }}" method="post" class="modal-content"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <div class="icon-content m-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-t-shirt">
                            <path
                                d="M20.38 3.46 16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.47a1 1 0 0 0 .99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2V10h2.15a1 1 0 0 0 .99-.84l.58-3.47a2 2 0 0 0-1.34-2.23z">
                            </path>
                        </svg>
                    </div>
                </div>

                <div class="text-center mb-3 mt-3">
                    <h4 class="mb-0">EDIT JERSEY</h4>
                </div>

                <div class="mt-0 row">
                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="size">Ukuran</label>
                            <input type="text" name="size" class="form-control form-control-sm"
                                placeholder="Ex: L, XL, S" id="size" value="{{ $jersey->size ?? old('size') }}">
                            @if($errors->has('size'))
                            <p class="text-danger">{{ $errors->first('size') }}</p>@endif
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="image">Ganti Gambar (Opsional)</label>
                            @if($jersey->image)
                                <img src="{{ asset('storage/' . $jersey->image) }}" alt="Jersey Image" class="d-block mb-2"
                                    style="max-width: 100px; border-radius: 8px;">
                            @endif
                            <input type="file" class="form-control file-upload-input" name="image" id="image">
                            @if($errors->has('image'))
                            <p class="text-danger">{{ $errors->first('image') }}</p>@endif
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-group mb-3">
                            <label for="show_on_registration_form">Tampil di Form?</label>
                            <select class="form-control form-control-sm" name="show_on_registration_form"
                                id="show_on_registration_form">
                                <option value="1" {{ ($jersey->show_on_registration_form ?? old('show_on_registration_form')) == 1 ? 'selected' : '' }}>Ya</option>
                                <option value="0" {{ ($jersey->show_on_registration_form ?? old('show_on_registration_form')) == 0 ? 'selected' : '' }}>Tidak</option>
                            </select>
                            @if($errors->has('show_on_registration_form'))
                            <p class="text-danger">{{ $errors->first('show_on_registration_form') }}</p>@endif
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-group mb-3">
                            <label for="back_number">Pakai No Punggung?</label>
                            <select class="form-control form-control-sm" name="back_number" id="back_number">
                                <option value="1" {{ ($jersey->back_number ?? old('back_number')) == 1 ? 'selected' : '' }}>Ya</option>
                                <option value="0" {{ ($jersey->back_number ?? old('back_number')) == 0 ? 'selected' : '' }}>Tidak</option>
                            </select>
                            @if($errors->has('back_number'))
                            <p class="text-danger">{{ $errors->first('back_number') }}</p>@endif
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-group mb-3">
                            <label for="back_name">Pakai Nama Punggung?</label>
                            <select class="form-control form-control-sm" name="back_name" id="back_name">
                                <option value="1" {{ ($jersey->back_name ?? old('back_name')) == 1 ? 'selected' : '' }}>Ya
                                </option>
                                <option value="0" {{ ($jersey->back_name ?? old('back_name')) == 0 ? 'selected' : '' }}>
                                    Tidak</option>
                            </select>
                            @if($errors->has('back_name'))
                            <p class="text-danger">{{ $errors->first('back_name') }}</p>@endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-dark" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>