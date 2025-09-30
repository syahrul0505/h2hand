@extends('admin.layouts.app')

@push('style-link')
    <style>
        .event-card {
            background-color: #2A3042;
            border: none;
            border-radius: 8px;
            color: #e0e6ed;
            padding: 25px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .event-card-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .event-logo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .event-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .event-title h5 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 2px;
            line-height: 1.4;
            color: #ffffff;
        }

        .event-title p {
            font-size: 0.85rem;
            margin-bottom: 0;
            color: #888ea8;
            text-transform: uppercase;
        }

        .event-details {
            list-style: none;
            padding-left: 0;
            flex-grow: 1;
            font-size: 0.875rem;
        }

        .event-details li {
            display: flex;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .event-details svg {
            width: 16px;
            height: 16px;
            margin-right: 10px;
            margin-top: 3px;
            flex-shrink: 0;
            color: #888ea8;
        }

        .event-details .badge {
            font-size: 0.8rem;
            padding: 4px 10px;
        }

        .event-details .badge-success {
            background-color: #009688 !important;
            color: #fff;
        }

        .event-details .badge-danger {
            background-color: #e7515a !important;
            color: #fff;
        }

        .event-details-label {
            color: #888ea8;
            margin-right: 5px;
        }

        .event-location a {
            color: #4361ee !important;
            text-decoration: none;
            font-weight: 600;
        }

        .event-location a:hover {
            text-decoration: underline;
        }

        .btn-daftar {
            background-color: #4361ee;
            border-color: #4361ee;
            color: #ffffff;
            width: 100%;
            margin-top: 20px;
            font-weight: 600;
        }
    </style>
@endpush

@section('content')
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
                <div class="widget-content-area br-8">
                    <div class="p-3">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>{{ $page_title }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            @forelse($events as $event)
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="event-card">
                                        <div>
                                            <div class="event-card-header">
                                                <div class="event-logo">
                                                    @if($event->image)
                                                        <img src="{{ asset($event->image) }}" alt="{{ $event->name }}">
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                                            viewBox="0 0 24 24" fill="none" stroke="#4361ee" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="feather feather-award">
                                                            <circle cx="12" cy="8" r="7"></circle>
                                                            <polyline points="8.21 13.89 7 23 12 17 17 23 15.79 13.88"></polyline>
                                                        </svg>
                                                    @endif
                                                </div>
                                                <div class="event-title">
                                                    <h5>{{ Str::upper($event->name) }}</h5>
                                                    <p></p>
                                                </div>
                                            </div>

                                            <ul class="event-details">
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-info">
                                                        <circle cx="12" cy="12" r="10"></circle>
                                                        <line x1="12" y1="16" x2="12" y2="12"></line>
                                                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                                    </svg>
                                                    <div>
                                                        <span class="event-details-label">Status:</span>
                                                        @if($event->status == 'upcoming' || $event->status == 'dibuka')
                                                            <span class="badge badge-success">Dibuka</span>
                                                        @else
                                                            <span class="badge badge-danger">Ditutup</span>
                                                        @endif
                                                    </div>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-users">
                                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                        <circle cx="9" cy="7" r="4"></circle>
                                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                                    </svg>
                                                    <div>
                                                        <span class="event-details-label">Peserta:</span>
                                                        <strong>{{ $event->participants_count }} /
                                                            {{ $event->max_people ?? '∞' }}</strong>
                                                    </div>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-calendar">
                                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                                    </svg>
                                                    <div><span class="event-details-label">Perlombaan:</span>
                                                        {{ $event->date_of_competition->format('d F Y') }}</div>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-edit-3">
                                                        <path d="M12 20h9"></path>
                                                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z">
                                                        </path>
                                                    </svg>
                                                    <div><span class="event-details-label">Pendaftaran:</span>
                                                        {{ $event->start_registration_date->format('d F Y') }} -
                                                        {{ $event->end_registration_date->format('d F Y') }}
                                                    </div>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-calendar">
                                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                                    </svg>
                                                    <div><span class="event-details-label">Technical Meeting:</span>
                                                        {{ $event->date_technical->format('d F Y') }}</div>
                                                </li>
                                                <li class="event-location">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-map-pin">
                                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                        <circle cx="12" cy="10" r="3"></circle>
                                                    </svg>
                                                    <div>
                                                        <span class="event-details-label">Lokasi:</span>
                                                        @if($event->location_link)
                                                            <a href="{{ $event->location_link }}"
                                                                target="_blank">{{ $event->location }}</a>
                                                        @else
                                                            <span style="color: #e0e6ed;">{{ $event->location }}</span>
                                                        @endif
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        @php
                                            $now = \Carbon\Carbon::now();
                                            $isCompetitionFinished = $event->date_of_competition && $now->greaterThan($event->date_of_competition);
                                            $isRegistrationOpen = $now->between($event->start_registration_date, $event->end_registration_date);
                                            $isFull = $event->max_people && $event->participants_count >= $event->max_people;
                                        @endphp

                                        @if ($isCompetitionFinished)
                                            <button class="btn btn-secondary w-100 mt-3" disabled>Pendaftaran Selesai</button>
                                        @elseif($isFull)
                                            <button class="btn btn-warning w-100 mt-3" disabled>Kuota Penuh</button>
                                        @elseif($isRegistrationOpen)
                                            <a href="{{ route('registration-events.create', Crypt::encryptString($event->id)) }}"
                                                class="btn btn-daftar">Daftar</a>
                                        @else
                                            <button class="btn btn-secondary w-100 mt-3" disabled>Pendaftaran Ditutup</button>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p class="text-center">Belum ada event yang tersedia.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection