<div class="modal fade" id="tabs-{{ $raceEventNumber->id }}-edit-ren" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('race-event-numbers.update', $raceEventNumber->id) }}" method="post"
            class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title">Edit Nomor Lomba: {{ $raceEventNumber->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="name">Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ $raceEventNumber->name }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="price">Harga</label>
                    <input type="number" name="price" class="form-control" value="{{ $raceEventNumber->price }}"
                        required>
                </div>
                <div class="form-group mb-3">
                    <label for="max_participants">Maksimal Peserta (Opsional)</label>
                    <input type="number" name="max_participants" class="form-control" placeholder="Contoh: 50" min="1"
                        value="{{ $raceEventNumber->max_participants }}">
                </div>

                <hr class="my-3">

                <div class="col-md-12 mb-3 form-group">
                    <strong>Kategori Event:</strong>
                    <select name="category_event" id="category_event_selector_edit_{{ $raceEventNumber->id }}"
                        class="form-control" required>
                        <option value="" disabled>-- Pilih Jenis Kategori --</option>
                        <option value="age_category" {{ $raceEventNumber->category_event == 'age_category' ? 'selected' : '' }}>Berdasarkan Kategori Umur (Input Manual)</option>
                        <option value="class_category" {{ $raceEventNumber->category_event == 'class_category' ? 'selected' : '' }}>Berdasarkan Kelas (Pilih dari Daftar)</option>
                    </select>
                </div>

                <div id="age_category_input_edit_{{ $raceEventNumber->id }}" class="col-md-12 mb-3"
                    style="display: none;">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <strong>Input Minimal Umur:</strong>
                            <input type="number" name="age_category" class="form-control" placeholder="Contoh: 9"
                                min="0" value="{{ $raceEventNumber->age_category }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <strong>Input Batas Umur:</strong>
                            <input type="number" name="max_age" class="form-control" placeholder="Contoh: 10" min="0"
                                value="{{ $raceEventNumber->max_age }}">
                        </div>
                    </div>
                </div>

                <div id="class_category_input_edit_{{ $raceEventNumber->id }}" class="col-md-12 mb-3 form-group"
                    style="display: none;">
                    <strong>Pilih Kategori Kelas:</strong>
                    <select name="class_category" class="form-control">
                        <option value="" disabled>-- Pilih Kelas --</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->name }}" {{ $raceEventNumber->class_category == $class->name ? 'selected' : '' }}>{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-dark" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function setupCategoryToggle(selectorId) {
        const selector = document.getElementById(selectorId);
        const ageInput = document.getElementById('age_category_input_edit_' + selectorId.split('_').pop());
        const classInput = document.getElementById('class_category_input_edit_' + selectorId.split('_').pop());

        function toggleInputs() {
            if (selector.value === 'age_category') {
                ageInput.style.display = 'block';
                classInput.style.display = 'none';
            } else if (selector.value === 'class_category') {
                ageInput.style.display = 'none';
                classInput.style.display = 'block';
            } else {
                ageInput.style.display = 'none';
                classInput.style.display = 'none';
            }
        }

        selector.addEventListener('change', toggleInputs);

        toggleInputs();
    }

    setupCategoryToggle('category_event_selector_edit_{{ $raceEventNumber->id }}');
</script>