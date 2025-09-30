<div class="modal fade modal-notification" id="tabs-add-supplier" tabindex="-1" role="dialog" aria-labelledby="tabsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('suppliers.store') }}" method="post" class="modal-content">
        @csrf
        @method('POST')
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <div class="icon-content m-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    </div>
                </div>

                <div class="text-center mb-3 mt-3">
                    <h4 class="mb-0">ADD SUPPLIER</h4>
                </div>

                <div class="mt-0 row">
                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="code">Code</label>
                            <input type="text" name="code" class="form-control form-control-sm" placeholder="Ex:S00001" aria-label="code" id="code" value="{{ $code ?? old('code') }}" readonly>

                            @if($errors->has('code'))
                                <p class="text-danger">{{ $errors->first('code') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label for="fullname">Fullname</label>
                            <input type="text" name="fullname" class="form-control form-control-sm" placeholder="Ex:franky" aria-label="fullname" id="fullname" value="{{ old('fullname') }}">

                            @if($errors->has('fullname'))
                                <p class="text-danger">{{ $errors->first('fullname') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label for="company">Company</label>
                            <input type="text" name="company" class="form-control form-control-sm" placeholder="Ex:PT xxxxxx" aria-label="company" id="company" value="{{ old('company') }}">

                            @if($errors->has('company'))
                                <p class="text-danger">{{ $errors->first('company') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control form-control-sm" placeholder="Ex:test@gmail.com" aria-label="email" id="email" value="{{ old('email') }}">

                            @if($errors->has('email'))
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" class="form-control form-control-sm" placeholder="Ex:0812xxxxxxxx" aria-label="phone" id="phone" value="{{ old('phone') }}">

                            @if($errors->has('phone'))
                                <p class="text-danger">{{ $errors->first('phone') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" cols="30" rows="5" class="form-control" placeholder="Ex:Jl.sudirman">{{ old('address') }}</textarea>

                            @if($errors->has('address'))
                                <p class="text-danger">{{ $errors->first('address') }}</p>
                            @endif
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

