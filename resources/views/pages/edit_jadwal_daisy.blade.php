@extends('components.layout')

@section('title', 'Edit Jadwal Operasi')

@section('content')
    <div class="px-4 py-8 max-w-7xl mx-auto">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Edit Jadwal Operasi</h2>
            <p class="text-muted mt-1">Perbarui detail jadwal operasi pasien</p>
        </div>

        <form action="{{ route('schedule.update', $data->id) }}" method="POST" class="space-y-6" novalidate>
            @csrf
            @method('PUT')
            <input type="hidden" id="edit-id" value="{{ $data->id }}">

            @if ($errors->any())
                <div class="alert alert-danger shadow-sm">
                    <div>
                        <h5 class="font-bold">Terdapat kesalahan pada form:</h5>
                        <ul class="list-disc ml-4 mt-1 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Informasi Jadwal -->
            <div class="card bg-white shadow-sm border mb-4">
                <div class="card-body">
                    <h3 class="card-title text-lg border-b pb-2 mb-4">Informasi Jadwal</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Tgl Operasi -->
                        <div class="w-full">
                            <label class="form-label font-medium">Tanggal Operasi <span class="text-danger">*</span></label>
                            <input type="text" id="tgl_operasi" name="tgl_operasi"
                                class="form-control text-uppercase @error('tgl_operasi') is-invalid @enderror"
                                value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_operasi)->format('d-m-Y') }}"
                                required />
                            @error('tgl_operasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Ruang Operasi -->
                        <div class="w-full">
                            <label class="form-label font-medium">Ruang Operasi <span class="text-danger">*</span></label>
                            <select name="ruang_operasi" id="ruang_operasi" class="form-select text-uppercase"
                                required>
                                @foreach ($optionKamar as $room)
                                    <option value="{{ $room }}" @if ($room == $data->ruang_operasi) selected @endif>
                                        {{ $room }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Jam Operasi -->
                        <div class="w-full">
                            <label class="form-label font-medium">Jam Operasi</label>
                            <div class="input-group">
                                <select name="jam_operasi" id="jam_operasi" class="form-select"
                                    data-selected="{{ $data->jam_operasi }}" required>
                                    <!-- options via js -->
                                </select>
                                <span class="input-group-text">s.d.</span>
                                <input type="text" name="jam_operasi2" id="jam_operasi2"
                                    class="form-control text-uppercase"
                                    value="{{ $data->jam_operasi2 }}">
                            </div>
                        </div>

                        <!-- Status Operasi -->
                        <div class="w-full">
                            <label class="form-label font-medium">Status Operasi</label>
                            <select name="status" class="form-select text-uppercase">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}" @if ($status == $data->status) selected @endif>
                                        {{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Pasien -->
            <div class="card bg-white shadow-sm border mb-4">
                <div class="card-body">
                    <h3 class="card-title text-lg border-b pb-2 mb-4">Informasi Pasien</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="w-full">
                            <label class="form-label font-medium">No. CM <span class="text-danger">*</span></label>
                            <input type="number" name="no_cm" id="no_cm"
                                class="form-control text-uppercase @error('no_cm') is-invalid @enderror"
                                value="{{ $data->no_cm }}" required />
                            @error('no_cm')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="w-full">
                            <label class="form-label font-medium">Nama Pasien <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select name="prefix" id="prefix" class="form-select" style="max-width: 90px;">
                                    <option value="tn." {{ $data->prefix == 'tn.' ? 'selected' : '' }}>Tn.</option>
                                    <option value="ny." {{ $data->prefix == 'ny.' ? 'selected' : '' }}>Ny.</option>
                                    <option value="nn." {{ $data->prefix == 'nn.' ? 'selected' : '' }}>Nn.</option>
                                    <option value="by." {{ $data->prefix == 'by.' ? 'selected' : '' }}>By.</option>
                                    <option value="an." {{ $data->prefix == 'an.' ? 'selected' : '' }}>An.</option>
                                </select>
                                <input type="text" name="nama_pasien" id="nama_pasien"
                                    class="form-control text-uppercase @error('nama_pasien') is-invalid @enderror"
                                    value="{{ $data->nama_pasien }}" required>
                                @error('nama_pasien')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="w-full">
                            <label class="form-label font-medium">Usia <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" name="usia" id="usia"
                                    class="form-control @error('usia') is-invalid @enderror"
                                    value="{{ $data->usia }}" required>
                                <select name="s_usia" id="s_usia" class="form-select" style="max-width: 90px;">
                                    <option value="Tahun"
                                        {{ in_array($data->s_usia, ['Tahun', 'thn']) ? 'selected' : '' }}>thn</option>
                                    <option value="Bulan"
                                        {{ in_array($data->s_usia, ['Bulan', 'bln']) ? 'selected' : '' }}>bln</option>
                                </select>
                                @error('usia')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="w-full">
                            <label class="form-label font-medium">Berat Badan (BB)</label>
                            <input type="text" name="bb" id="bb"
                                class="form-control text-uppercase" value="{{ $data->bb }}" />
                        </div>

                        <div class="w-full md:col-span-2">
                            <label class="form-label font-medium">Jaminan <span class="text-danger">*</span></label>
                            <input type="text" name="jaminan" id="jaminan"
                                class="form-control text-uppercase @error('jaminan') is-invalid @enderror"
                                value="{{ $data->jaminan }}" required />
                            @error('jaminan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Medis -->
            <div class="card bg-white shadow-sm border mb-4">
                <div class="card-body">
                    <h3 class="card-title text-lg border-b pb-2 mb-4">Informasi Medis & Prosedur</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="w-full">
                            <label class="form-label font-medium">Diagnosa <span class="text-danger">*</span></label>
                            <input type="text" name="diagnosa" id="diagnosa"
                                class="form-control text-uppercase @error('diagnosa') is-invalid @enderror"
                                value="{{ $data->diagnosa }}" required />
                            @error('diagnosa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label class="form-label font-medium">Tindakan <span class="text-danger">*</span></label>
                            <input type="text" name="tindakan" id="tindakan"
                                class="form-control text-uppercase @error('tindakan') is-invalid @enderror"
                                value="{{ $data->tindakan }}" required />
                            @error('tindakan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="w-full">
                            <label class="form-label font-medium">Operator <span class="text-danger">*</span></label>
                            <select name="dokter_id" id="dokter_id" class="form-select"
                                data-selected="{{ $data->dokter_id ?? '' }}" required>
                                <!-- options via js -->
                            </select>
                        </div>

                        <div class="w-full">
                            <label class="form-label font-medium">Asisten</label>
                            <input type="text" name="asisten" id="asisten"
                                class="form-control text-uppercase" value="{{ $data->asisten }}" />
                        </div>

                        <div class="w-full">
                            <label class="form-label font-medium">Anestesi</label>
                            <select name="anestesi" id="anestesi" class="form-select" required>
                                <option value="">-- Pilih Anestesiologis --</option>
                                @foreach ($operators as $operator)
                                    <option value="{{ $operator->nama_dokter }}"
                                        @if ($operator->nama_dokter == $data->anestesi) selected @endif>{{ $operator->nama_dokter }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="w-full flex items-center mt-4">
                            <input type="hidden" name="verifikasi" value="belum">
                            <div class="form-check">
                                <input type="checkbox" name="verifikasi" value="sudah" id="verifikasi"
                                    class="form-check-input" {{ $data->verifikasi == 'sudah' ? 'checked' : '' }} />
                                <label for="verifikasi"
                                    class="form-check-label font-medium cursor-pointer select-none">Verifikasi Persiapan
                                    Operasi</label>
                            </div>
                        </div>

                        <div class="w-full md:col-span-2">
                            <label class="form-label font-medium">Catatan Hasil Pemeriksaan Penunjang</label>
                            <input type="text" name="catatan_hasil_penunjang" id="catatan_hasil_penunjang"
                                class="form-control text-uppercase"
                                value="{{ $data->catatan_hasil_penunjang }}" />
                        </div>

                        <div class="w-full md:col-span-2">
                            <label class="form-label font-medium">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control"
                                value="{{ $data->keterangan }}" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Konsultasi -->
            <div class="card bg-white shadow-sm border mb-4">
                <div class="card-body">
                    <h3 class="card-title text-lg border-b pb-2 mb-4">Konsultasi Pre-Operatif</h3>

                    <div class="overflow-x-auto">
                        <table class="table table-striped table-bordered w-full hidden md:table align-middle">
                            <thead class="table-light font-bold">
                                <tr>
                                    <th>Jenis Konsul</th>
                                    <th>Tanggal Konsul</th>
                                    <th>Hasil Konsul</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="font-medium align-middle">IPD</td>
                                    <td><input id="tgl_ipd" type="date" name="tgl_ipd"
                                            class="form-control form-control-sm text-uppercase"
                                            value="{{ strtotime($data->tgl_ipd) ? date('Y-m-d', strtotime(str_replace('/', '-', $data->tgl_ipd))) : '' }}">
                                    </td>
                                    <td><input type="text" name="hasil_ipd"
                                            class="form-control form-control-sm text-uppercase"
                                            value="{{ $data->hasil_ipd }}"></td>
                                </tr>
                                <tr>
                                    <td class="font-medium align-middle">Jantung</td>
                                    <td><input id="tgl_jantung" type="date" name="tgl_jantung"
                                            class="form-control form-control-sm text-uppercase"
                                            value="{{ strtotime($data->tgl_jantung) ? date('Y-m-d', strtotime(str_replace('/', '-', $data->tgl_jantung))) : '' }}">
                                    </td>
                                    <td><input type="text" name="hasil_jantung"
                                            class="form-control form-control-sm text-uppercase"
                                            value="{{ $data->hasil_jantung }}"></td>
                                </tr>
                                <tr>
                                    <td class="font-medium align-middle">Anasthesi</td>
                                    <td><input id="tgl_anasthesi" type="date" name="tgl_anasthesi"
                                            class="form-control form-control-sm text-uppercase"
                                            value="{{ strtotime($data->tgl_anasthesi) ? date('Y-m-d', strtotime(str_replace('/', '-', $data->tgl_anasthesi))) : '' }}">
                                    </td>
                                    <td><input type="text" name="hasil_anasthesi"
                                            class="form-control form-control-sm text-uppercase"
                                            value="{{ $data->hasil_anasthesi }}"></td>
                                </tr>
                                <tr>
                                    <td class="font-medium align-middle">Lain-lain</td>
                                    <td><input id="tgl_lain" type="date" name="tgl_lain"
                                            class="form-control form-control-sm text-uppercase"
                                            value="{{ strtotime($data->tgl_lain) ? date('Y-m-d', strtotime(str_replace('/', '-', $data->tgl_lain))) : '' }}">
                                    </td>
                                    <td><input type="text" name="hasil_lain"
                                            class="form-control form-control-sm text-uppercase"
                                            value="{{ $data->hasil_lain }}"></td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Mobile view alternative -->
                        <div class="md:hidden space-y-4 pt-2">
                            <div class="bg-light p-4 rounded mb-3 border">
                                <h6 class="font-bold border-bottom pb-2 mb-3">Konsul IPD</h6>
                                <div class="space-y-3">
                                    <div>
                                        <label class="form-label text-sm mb-1">Tanggal</label>
                                        <input id="tgl_ipd" type="date" name="tgl_ipd"
                                            class="form-control form-control-sm text-uppercase"
                                            value="{{ strtotime($data->tgl_ipd) ? date('Y-m-d', strtotime(str_replace('/', '-', $data->tgl_ipd))) : '' }}">
                                    </div>
                                    <div>
                                        <label class="form-label text-sm mb-1">Hasil</label>
                                        <input type="text" name="hasil_ipd"
                                            class="form-control form-control-sm text-uppercase"
                                            value="{{ $data->hasil_ipd }}">
                                    </div>
                                </div>
                            </div>
                            <div class="bg-light p-4 rounded mb-3 border">
                                <h6 class="font-bold border-bottom pb-2 mb-3">Konsul Jantung</h6>
                                <div class="space-y-3">
                                    <div>
                                        <label class="form-label text-sm mb-1">Tanggal</label>
                                        <input id="tgl_jantung" type="date" name="tgl_jantung"
                                            class="form-control form-control-sm text-uppercase"
                                            value="{{ strtotime($data->tgl_jantung) ? date('Y-m-d', strtotime(str_replace('/', '-', $data->tgl_jantung))) : '' }}">
                                    </div>
                                    <div>
                                        <label class="form-label text-sm mb-1">Hasil</label>
                                        <input type="text" name="hasil_jantung"
                                            class="form-control form-control-sm text-uppercase"
                                            value="{{ $data->hasil_jantung }}">
                                    </div>
                                </div>
                            </div>
                            <div class="bg-light p-4 rounded mb-3 border">
                                <h6 class="font-bold border-bottom pb-2 mb-3">Konsul Anasthesi</h6>
                                <div class="space-y-3">
                                    <div>
                                        <label class="form-label text-sm mb-1">Tanggal</label>
                                        <input id="tgl_anasthesi" type="date" name="tgl_anasthesi"
                                            class="form-control form-control-sm text-uppercase"
                                            value="{{ strtotime($data->tgl_anasthesi) ? date('Y-m-d', strtotime(str_replace('/', '-', $data->tgl_anasthesi))) : '' }}">
                                    </div>
                                    <div>
                                        <label class="form-label text-sm mb-1">Hasil</label>
                                        <input type="text" name="hasil_anasthesi"
                                            class="form-control form-control-sm text-uppercase"
                                            value="{{ $data->hasil_anasthesi }}">
                                    </div>
                                </div>
                            </div>
                            <div class="bg-light p-4 rounded mb-3 border">
                                <h6 class="font-bold border-bottom pb-2 mb-3">Konsul Lain-lain</h6>
                                <div class="space-y-3">
                                    <div>
                                        <label class="form-label text-sm mb-1">Tanggal</label>
                                        <input id="tgl_lain" type="date" name="tgl_lain"
                                            class="form-control form-control-sm text-uppercase"
                                            value="{{ strtotime($data->tgl_lain) ? date('Y-m-d', strtotime(str_replace('/', '-', $data->tgl_lain))) : '' }}">
                                    </div>
                                    <div>
                                        <label class="form-label text-sm mb-1">Hasil</label>
                                        <input type="text" name="hasil_lain"
                                            class="form-control form-control-sm text-uppercase"
                                            value="{{ $data->hasil_lain }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex flex-col-reverse md:flex-row justify-end gap-3 pb-8">
                <a href="{{ route('schedule.index') }}" class="btn btn-outline-danger w-full md:w-32">Batal</a>
                <button type="submit" class="btn btn-primary w-full md:w-auto px-8">Simpan Perubahan</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.querySelector('#tgl_operasi');
            const roomInput = document.querySelector('#ruang_operasi');
            const timeSelect = document.querySelector('#jam_operasi');
            const doctorSelect = document.querySelector('#dokter_id');
            const editId = document.querySelector('#edit-id') ? document.querySelector('#edit-id').value : null;
            const form = document.querySelector('form');

            form.addEventListener('submit', function() {
                const isMobile = window.innerWidth < 768;
                if (isMobile) {
                    // Disable desktop table inputs
                    document.querySelectorAll('table.hidden.md\\:table input').forEach(el => el.disabled =
                        true);
                } else {
                    // Disable mobile view inputs
                    document.querySelectorAll('div.md\\:hidden input').forEach(el => el.disabled = true);
                }
            });

            const selectedDoctorId = doctorSelect.dataset.selected;

            function fetchAvailableTimes() {
                const date = dateInput.value;
                const room = roomInput.value;

                if (!date || !room) {
                    timeSelect.innerHTML = '<option value="">Pilih tanggal & ruang</option>';
                    return;
                }

                let url = `/get-available-times?tgl_operasi=${date}&ruang_operasi=${room}`;
                if (editId) url += `&edit_id=${editId}`;

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        timeSelect.innerHTML = '<option value="">Pilih Jam</option>';
                        data.forEach(time => {
                            timeSelect.innerHTML += `<option value="${time}">${time}</option>`;
                        });

                        const currentTime = document.querySelector('#jam_operasi').dataset.selected;
                        if (currentTime) {
                            const option = timeSelect.querySelector(`option[value="${currentTime}"]`);
                            if (option) option.selected = true;
                        }

                        fetchAvailableDoctors();
                    })
                    .catch(error => console.error("Error fetching times:", error));
            }

            function fetchAvailableDoctors() {
                const date = dateInput.value;
                const room = roomInput.value;
                const time = timeSelect.value;

                if (!date || !room || !time) {
                    doctorSelect.innerHTML = '<option value="">Pilih tgl, ruang & jam</option>';
                    return;
                }

                fetch(
                        `/get-available-doctors?tgl_operasi=${date}&ruang_operasi=${room}&jam_operasi=${time}&edit_id=${editId}`
                    )
                    .then(response => response.json())
                    .then(data => {
                        doctorSelect.innerHTML = '<option value="">Pilih Dokter</option>';
                        data.forEach(doctor => {
                            doctorSelect.innerHTML +=
                                `<option value="${doctor.id}" ${doctor.id == selectedDoctorId ? 'selected' : ''}>${doctor.nama_dokter}</option>`;
                        });

                        doctorSelect.dataset.selected = '';
                    })
                    .catch(error => console.error("Error fetching doctors:", error));
            }

            dateInput.addEventListener('change', fetchAvailableTimes);
            roomInput.addEventListener('change', fetchAvailableTimes);
            timeSelect.addEventListener('change', fetchAvailableDoctors);

            fetchAvailableTimes();
        });
    </script>
@endsection
