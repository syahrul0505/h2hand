<div class="modal fade" id="tabs-add-event" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('events.store') }}" method="post" class="modal-content" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tambah Event Baru</h5><button type="button" class="btn-close"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3 form-group"><strong>Nama Event:</strong><input type="text" name="name"
                            class="form-control" required></div>
                    <div class="col-md-12 mb-3 form-group"><strong>Lokasi:</strong><input type="text" name="location"
                            class="form-control" required></div>
                    <div class="col-md-12 mb-3 form-group"><strong>Link Lokasi (Google Maps):</strong><input type="url"
                            name="location_link" class="form-control" placeholder="https://maps.app.goo.gl/..."></div>
                    <div class="col-md-6 mb-3 form-group"><strong>Tanggal Mulai Pendaftaran:</strong><input type="date"
                            name="start_registration_date" class="form-control" required></div>
                    <div class="col-md-6 mb-3 form-group"><strong>Tanggal Selesai Pendaftaran:</strong><input
                            type="date" name="end_registration_date" class="form-control" required></div>
                    <div class="col-md-6 mb-3 form-group"><strong>Tanggal Technical Meeting:</strong><input type="date"
                            name="date_technical" class="form-control" required></div>
                            <div class="col-md-6 mb-3 form-group"><strong>Tanggal Lomba:</strong><input type="date"
                            name="date_of_competition" class="form-control" required></div>
                    <div class="col-md-6 mb-3 form-group"><strong>Maksimal Peserta:</strong><input type="number"
                            name="max_people" class="form-control" placeholder="Kosongkan jika tak terbatas"></div>
                    <hr class="my-3">
                    <div class="col-md-6 mb-3 form-group"><strong>Status:</strong><select name="status"
                            class="form-control">
                            <option value="upcoming">Upcoming</option>
                            <option value="ongoing">Ongoing</option>
                            <option value="finished">Finished</option>
                        </select></div>
                    <div class="col-md-6 mb-3 form-group"><strong>Gambar/Poster Event:</strong><input type="file"
                            name="image" class="form-control"></div>
                </div>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-light-dark"
                    data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<script>
    document.getElementById('category_event_selector_add').addEventListener('change', function () {
        var ageInput = document.getElementById('age_category_input_add');
        var classInput = document.getElementById('class_category_input_add');
        if (this.value === 'age_category') {
            ageInput.style.display = 'block';
            classInput.style.display = 'none';
        } else if (this.value === 'class_category') {
            ageInput.style.display = 'none';
            classInput.style.display = 'block';
        } else {
            ageInput.style.display = 'none';
            classInput.style.display = 'none';
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        const ageCategoryInput = document.querySelector('#age_category_input_add input[name="age_category"]');
        const maxAgeInput = document.querySelector('#age_category_input_add input[name="max_age"]');
        const warningText = document.getElementById('age-warning-add');

        const validateAgeInput = (e) => {
            const isNumeric = /^\d*$/.test(e.target.value);
            if (!isNumeric) {
                warningText.style.display = 'block';
            } else {
                warningText.style.display = 'none';
            }
        };

        if (ageCategoryInput && maxAgeInput) {
            ageCategoryInput.addEventListener('input', validateAgeInput);
            maxAgeInput.addEventListener('input', validateAgeInput);
        }
    });
</script>