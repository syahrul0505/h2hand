<div class="modal fade modal-notification" id="tabs-{{ $coupon->id }}-edit-coupon" tabindex="-1" role="dialog" aria-labelledby="tabsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="mt-0 modal-content" action="{{ route('coupons.update', $coupon->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <div class="icon-content m-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-gift"><polyline points="20 12 20 22 4 22 4 12"></polyline><rect x="2" y="7" width="20" height="5"></rect><line x1="12" y1="22" x2="12" y2="7"></line><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path></svg>
                    </div>
                </div>

                <div class="text-center mb-3 mt-3">
                    <h4 class="mb-0">EDIT COUPON</h4>
                </div>

                <div class="mt-0 row">
                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="code">Code</label>
                            <input type="text" name="code" class="form-control form-control-sm" placeholder="Ex:CPN00001" aria-label="code" id="code" value="{{ $coupon->code ?? old('code') }}" readonly>

                            @if($errors->has('code'))
                                <p class="text-danger">{{ $errors->first('code') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Nama</label>
                            <input type="text" name="name" class="form-control form-control-sm" placeholder="Ex:Happy New Year" aria-label="name" id="name" value="{{ $coupon->name ?? old('name') }}">

                            @if($errors->has('name'))
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label for="type">Tipe</label>
                            <select class="form-control form-control-sm" name="type" id="type">
                                <option selected value="Percentage Discount" {{ ($coupon->type == 'Percentage Discount') ? 'selected' : '' }}>Percentage Discount</option>
                                <option value="Flat Discount" {{ ($coupon->type == 'Flat Discount') ? 'selected' : '' }}>Flat Discount</option>
                            </select>
                            @if($errors->has('type'))
                                <p class="text-danger">{{ $errors->first('type') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <label for="discount_value" class="text-white" style="opacity: .8;">Nilai Diskon</label>
                        <input type="text" name="discount_value" id="discount_value" class="form-control form-control-sm" aria-label="Discount Cart" placeholder="Ex:10.000 / 10%" value="{{ $coupon->discount_value ?? old('discount_value') }}">

                        @if($errors->has('discount_value'))
                            <p class="text-danger">{{ $errors->first('discount_value') }}</p>
                        @endif
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <label for="minimum_cart" class="text-white" style="opacity: .8;">Minimal Keranjang</label>
                        <div class="input-group">
                            <span class="input-group-text" id="group-rp">Rp</span>
                            <input type="text" name="minimum_cart" id="minimum_cart" class="form-control form-control-sm" aria-label="Minimum Cart" placeholder="Ex:10.000" value="{{ $coupon->minimum_cart ?? old('minimum_cart') }}">
                        </div>

                        @if($errors->has('minimum_cart'))
                            <p class="text-danger">{{ $errors->first('minimum_cart') }}</p>
                        @endif
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <label for="discount_threshold" class="text-white" style="opacity: .8;">Diskon Batasan</label>
                        <div class="input-group">
                            <span class="input-group-text" id="group-rp">Rp</span>
                            <input type="text" name="discount_threshold" id="discount_threshold" class="form-control form-control-sm" aria-label="Discount Threshold" placeholder="Ex:10.000" value="{{ $coupon->discount_threshold ?? old('discount_threshold') }}">
                        </div>

                        @if($errors->has('discount_threshold'))
                            <p class="text-danger">{{ $errors->first('discount_threshold') }}</p>
                        @endif
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <label for="max_discount_value" class="text-white" style="opacity: .8;">Maximal Nilai Diskon</label>
                        <div class="input-group">
                            <span class="input-group-text" id="group-rp">Rp</span>
                            <input type="text" name="max_discount_value" id="max_discount_value" class="form-control form-control-sm" aria-label="Max Discount Value" placeholder="Ex:10.000" value="{{ $coupon->max_discount_value ?? old('max_discount_value') }}">
                        </div>

                        @if($errors->has('max_discount_value'))
                            <p class="text-danger">{{ $errors->first('max_discount_value') }}</p>
                        @endif
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label for="expired_at">Kadaluarsa</label>
                            <input type="date" name="expired_at" class="form-control form-control-sm" placeholder="Ex:10-10-2024" aria-label="expired_at" id="expired_at" value="{{ date('Y-m-d', strtotime($coupon->expired_at)) ?? old('expired_at') }}">

                            @if($errors->has('expired_at'))
                                <p class="text-danger">{{ $errors->first('expired_at') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group mb-3">
                            <label for="limit_usage">Batas Penggunaan</label>
                            <input type="number" name="limit_usage" class="form-control form-control-sm" min="0" placeholder="Ex:10" aria-label="limit_usage" id="limit_usage" value="{{ $coupon->limit_usage ?? old('limit_usage') }}">

                            @if($errors->has('limit_usage'))
                                <p class="text-danger">{{ $errors->first('limit_usage') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select class="form-control form-control-sm" name="status" id="status">
                                <option selected value="true" {{ ($coupon->status == true) ? 'selected' : '' }}>Active</option>
                                <option value="false" {{ ($coupon->status == false) ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @if($errors->has('status'))
                                <p class="text-danger">{{ $errors->first('status') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light-dark" type="button" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

