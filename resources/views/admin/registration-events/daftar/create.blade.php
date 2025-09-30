@extends('admin.layouts.app')
@section('breadcumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('registration-events.index') }}">Perlombaan</a></li>
        <li class="breadcrumb-item"><a href="{{ route('registration-events.index') }}">Daftar</a></li>
        <li class="breadcrumb-item active" aria-current="page">Pendaftaran Lomba</li>
    </ol>
@endsection
@section('content')
    <style>
        .widget-content-area {
            padding: 20px;
        }

        .detail-item {
            margin-bottom: 1.5rem;
        }

        .detail-label {
            color: #888ea8;
            font-size: 13px;
            margin-bottom: 4px;
            font-weight: 600;
        }

        .detail-value {
            font-weight: 500;
            font-size: 15px;
        }

        .participant-form {
            background-color: #0e1726;
            border-color: #1b2e4b !important;
        }

        .participant-form label {
            color: #888ea8;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 1.5rem !important;
        }

        .actions-container {
            margin-top: 2rem;
            border-top: 1px solid #1b2e4b;
            padding-top: 1.5rem;
        }

        .form-control,
        .select2-container--default .select2-selection--single,
        .select2-container--default .select2-selection--multiple {
            background-color: #1b2e4b !important;
            border: 1px solid #3b3f5c !important;
            color: #e0e6ed !important;
            border-radius: 6px !important;
        }

        .form-control:focus {
            box-shadow: none;
        }

        .form-control::placeholder {
            color: #888ea8;
            opacity: 1;
        }

        .form-control[readonly] {
            background-color: #1b2e4b !important;
            cursor: not-allowed;
        }

        .select-readonly {
            pointer-events: none;
            background-color: #1b2e4b !important;
            cursor: not-allowed;
        }

        .select2-container--default .select2-selection--single {
            height: 45px !important;
            padding: 8px 12px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 25px !important;
            color: #e0e6ed !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 43px !important;
        }

        .select2-dropdown {
            border: 1px solid #3b3f5c;
        }

        .select2-container--default .select2-results__option {
            background-color: #1b2e4b;
            color: #888ea8;
        }

        .select2-results__option--highlighted[aria-selected] {
            background-color: #4361ee !important;
            color: #ffffff !important;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1px solid #3b3f5c !important;
            color: #888ea8 !important;
            background-color: #1b2e4b !important;
        }

        .select2-dropdown {
            background-color: #1b2e4b !important;
            border-color: #3b3f5c !important;
        }

        .select2-container .select2-selection--multiple {
            min-height: 45px !important;
            padding: 2px !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #0e1726 !important;
            border: 1px solid #3b3f5c !important;
            color: #e0e6ed !important;
            border-radius: 4px;
            display: inline-flex !important;
            align-items: center !important;
            margin: 4px !important;
            padding: 0 0 0 10px !important;
            height: 32px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #e0e6ed !important;
            position: static !important;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 25px;
            height: 100%;
            margin-left: 6px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @include('admin.components.alert')
    <div class="layout-px-spacing">
        <form action="{{ route('registration-events.store') }}" method="POST" id="registrationForm">
            @csrf
            <input type="hidden" name="event_id" value="{{ $event->id }}">
            <div class="row layout-top-spacing">
                <div class="col-12 layout-spacing">
                    <div class="widget-content widget-content-area br-8">
                        <div class="p-3">
                            <h5 class="mb-4">Event</h5>
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="detail-item">
                                        <div class="detail-label">Nama</div>
                                        <div class="detail-value">{{ $event->name }}</div>
                                    </div>
                                    <div class="detail-item">
                                        <div class="detail-label">Lokasi</div>
                                        <div class="detail-value">{{ $event->location }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="detail-item">
                                        <div class="detail-label">Tanggal</div>
                                        <div class="detail-value">{{ $event->date_technical->format('d F Y') }}</div>
                                    </div>
                                    <div class="detail-item">
                                        <div class="detail-label">Status</div>
                                        <div class="detail-value"><span class="badge badge-success">Dibuka</span></div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="detail-item">
                                        <div class="detail-label">Tanggal Pendaftaran</div>
                                        <div class="detail-value">{{ $event->start_registration_date->format('d M') }} -
                                            {{ $event->end_registration_date->format('d M Y') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="detail-item">
                                        <div class="detail-label">Tanggal Technical Meeting</div>
                                        <div class="detail-value">{{ $event->date_technical->format('d F Y') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 layout-spacing">
                    <div class="widget-content widget-content-area br-8">
                        <div class="p-4">
                            <div class="d-sm-flex justify-content-sm-between align-items-sm-center mb-4">
                                <h5 class="mb-3 mb-sm-0">Data Peserta</h5>
                                <button type="button" id="add-participant-btn" class="btn btn-secondary">Tambah
                                    Peserta</button>
                            </div>
                            <div id="participants-container">
                            </div>
                            <div class="actions-container">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="detail-label">Total</div>
                                        <h4 id="grand-total-price" class="text-success mb-0">Rp 0</h4>
                                    </div>
                                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="{{ route('registration-events.index') }}"
                                            class="btn btn-danger">Batalkan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="participant-template" style="display: none;">
        <div class="participant-form mb-4 border rounded p-3 position-relative">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0">Peserta</h6>
                <button type="button" class="btn btn-danger btn-sm remove-participant-btn">Hapus</button>
            </div>
            <div class="row">
                <div class="form-group col-lg-3 col-md-6 col-12">
                    <label>Club</label>
                    <input type="text" class="form-control"
                        value="{{ Auth::user()->club->name_club ?? 'Klub Tidak Terdaftar' }}" readonly>
                </div>
                <div class="form-group col-lg-3 col-md-6 col-12">
                    <label>Anggota</label>
                    <select name="name" class="form-select member-select" required>
                        <option value="" disabled selected>-- Pilih Anggota --</option>
                        @foreach($clubMembers as $member)
                            <option value="{{ $member->fullname }}" data-gender="{{ $member->gender }}"
                                data-dob="{{ $member->date_of_birth ? \Carbon\Carbon::parse($member->date_of_birth)->format('Y-m-d') : '' }}"
                                data-school="{{ $member->school_name }}" data-class="{{ $member->sportClass->name ?? '' }}">
                                {{ $member->fullname }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-lg-3 col-md-6 col-12">
                    <label>Sekolah</label>
                    <input type="text" name="school" class="form-control" readonly>
                </div>
                <div class="form-group col-lg-3 col-md-6 col-12">
                    <label>Kelas</label>
                    <input type="text" name="class" class="form-control" readonly>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-3 col-md-6 col-12">
                    <label>Jenis Kelamin</label>
                    <select name="gender" class="form-control select-readonly" required>
                        <option value="male">Putra</option>
                        <option value="female">Putri</option>
                    </select>
                </div>
                <div class="form-group col-lg-3 col-md-6 col-12">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="date_of_birth" class="form-control" required readonly>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 col-12">
                    <label>Nama Pelatih/Orang Tua</label>
                    <input type="text" name="coach_name" class="form-control" required>
                </div>
                <div class="form-group col-md-6 col-12">
                    <label>No. HP Pelatih/Orang Tua</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12 mb-0">
                    <label>Nomor Acara Lomba</label>
                    <select name="race_numbers[]" multiple class="form-control race-number-select">
                        @foreach($race_numbers as $race)
                            <option value="{{ $race->id }}" data-price="{{ $race->price }}">{{ $race->name }} (Rp
                                {{ number_format($race->price) }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            if ($('#participants-container').hasClass('initialized')) {
                return;
            }
            $('#participants-container').addClass('initialized');

            let participantIndex = 0;
            $('#participants-container').html('');

            const oldParticipants = @json(old('participants', []));

            function initializeSelect2(context) {
                $(context).find('.member-select').select2({ placeholder: '-- Pilih Anggota --' });
                $(context).find('.race-number-select').select2({ placeholder: '-- Pilih Nomor Lomba --' });
            }

            function addParticipant(data = null) {
                let template = $('#participant-template').html();
                let newForm = $(template);

                newForm.find('[name]').each(function () {
                    let originalName = $(this).attr('name');
                    if (originalName) {
                        if (originalName.endsWith('[]')) {
                            let baseName = originalName.replace('[]', '');
                            $(this).attr('name', `participants[${participantIndex}][${baseName}][]`);
                        } else {
                            $(this).attr('name', `participants[${participantIndex}][${originalName}]`);
                        }
                    }
                });

                newForm.find('h6').text('Peserta ' + (participantIndex + 1));
                $('#participants-container').append(newForm);
                initializeSelect2(newForm);

                if (data) {
                    newForm.find('select[name$="[name]"]').val(data.name).trigger('change');
                    newForm.find('input[name$="[school]"]').val(data.school);
                    newForm.find('input[name$="[class]"]').val(data.class);
                    newForm.find('input[name$="[date_of_birth]"]').val(data.date_of_birth);
                    newForm.find('select[name$="[gender]"]').val(data.gender);
                    newForm.find('input[name$="[coach_name]"]').val(data.coach_name);
                    newForm.find('input[name$="[phone]"]').val(data.phone);

                    if (data.race_numbers) {
                        newForm.find('select[name$="[race_numbers][]"]').val(data.race_numbers).trigger('change');
                    }
                }

                participantIndex++;
            }

            function calculateGrandTotal() {
                let grandTotal = 0;
                $('.race-number-select').each(function () {
                    $(this).find('option:selected').each(function () {
                        grandTotal += parseFloat($(this).data('price'));
                    });
                });
                $('#grand-total-price').text('Rp ' + grandTotal.toLocaleString('id-ID'));
            }

            if (oldParticipants.length > 0) {
                oldParticipants.forEach(participantData => {
                    addParticipant(participantData);
                });
            } else {
                addParticipant();
            }

            calculateGrandTotal();

            $(document).on('click', '#add-participant-btn', function () {
                addParticipant();
            });

            $(document).on('click', '.remove-participant-btn', function () {
                $(this).closest('.participant-form').remove();
                let newIndex = 0;
                $('#participants-container .participant-form').each(function () {
                    $(this).find('h6').text('Peserta ' + (newIndex + 1));
                    $(this).find('[name]').each(function () {
                        let currentName = $(this).attr('name');
                        if (currentName) {
                            let newName = currentName.replace(/participants\[\d+\]/, `participants[${newIndex}]`);
                            $(this).attr('name', newName);
                        }
                    });
                    newIndex++;
                });
                participantIndex = newIndex;
                calculateGrandTotal();
            });

            $(document).on('change', '.race-number-select', calculateGrandTotal);

            $(document).on('change', '.member-select', function () {
                const selectedOption = $(this).find('option:selected');
                const form = $(this).closest('.participant-form');
                const schoolInput = form.find('input[name$="[school]"]');
                const classInput = form.find('input[name$="[class]"]');
                const dobInput = form.find('input[name$="[date_of_birth]"]');
                const genderSelect = form.find('select[name$="[gender]"]');

                if (selectedOption.length > 0 && selectedOption.val() !== "") {
                    const gender = selectedOption.data('gender');
                    const dob = selectedOption.data('dob');
                    const school = selectedOption.data('school');
                    const studentClass = selectedOption.data('class');
                    schoolInput.val(school);
                    classInput.val(studentClass);
                    dobInput.val(dob);
                    genderSelect.val(gender);
                } else {
                    schoolInput.val('');
                    classInput.val('');
                    dobInput.val('');
                    genderSelect.val('male');
                }
            });

        });
    </script>
@endpush