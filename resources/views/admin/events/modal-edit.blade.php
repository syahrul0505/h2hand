<div class="modal fade" id="tabs-{{ $event->id }}-edit-event" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('events.update', $event->id) }}" method="post" class="modal-content"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title">Edit Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3 form-group"><strong>Nama Event:</strong><input type="text" name="name"
                            value="{{ $event->name }}" class="form-control" required></div>
                    <div class="col-md-12 mb-3 form-group"><strong>Lokasi:</strong><input type="text" name="location"
                            value="{{ $event->location }}" class="form-control" required></div>
                    <div class="col-md-12 mb-3 form-group"><strong>Link Lokasi (Google Maps):</strong><input type="url"
                            name="location_link" value="{{ $event->location_link }}" class="form-control"
                            placeholder="https://maps.app.goo.gl/..."></div>
                    <div class="col-md-6 mb-3 form-group"><strong>Tanggal Mulai Pendaftaran:</strong><input type="date"
                            name="start_registration_date"
                            value="{{ $event->start_registration_date->format('Y-m-d') }}" class="form-control"
                            required></div>
                    <div class="col-md-6 mb-3 form-group"><strong>Tanggal Selesai Pendaftaran:</strong><input
                            type="date" name="end_registration_date"
                            value="{{ $event->end_registration_date->format('Y-m-d') }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3 form-group"><strong>Tanggal Technical Meeting:</strong><input type="date"
                            name="date_technical" value="{{ $event->date_technical->format('Y-m-d') }}"
                            class="form-control" required></div>
                    {{-- Tambahkan conditional check di sini --}}
                    <div class="col-md-6 mb-3 form-group"><strong>Tanggal Lomba:</strong><input type="date"
    name="date_of_competition" value="{{ optional($event->date_of_competition)->format('Y-m-d') }}"
    class="form-control" required></div>
                    <div class="col-md-6 mb-3 form-group"><strong>Maksimal Peserta:</strong><input type="number"
                            name="max_people" value="{{ $event->max_people }}" class="form-control"></div>
                    <hr class="my-3">
                    <div class="col-md-6 mb-3 form-group"><strong>Status:</strong><select name="status"
                            class="form-control">
                            <option value="upcoming" {{ $event->status == 'upcoming' ? 'selected' : '' }}>Upcoming
                            </option>
                            <option value="ongoing" {{ $event->status == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                            <option value="finished" {{ $event->status == 'finished' ? 'selected' : '' }}>Finished
                            </option>
                        </select></div>
                    <div class="col-md-6 mb-3 form-group">
                        <strong>Ganti Gambar/Poster:</strong><input type="file" name="image" class="form-control">
                        @if($event->image)<small>Gambar saat ini: <a href="{{ asset($event->image) }}"
                                target="_blank">Lihat</a></small>@endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-dark" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>