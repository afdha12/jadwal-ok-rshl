@extends('components.layout')

@section('title', 'Edit Jadwal Operasi')

@section('content')
    <div class="px-4 py-8 max-w-7xl mx-auto">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-base-content">Edit Jadwal Operasi</h2>
            <p class="text-base-content/70 mt-1">Perbarui detail jadwal operasi pasien</p>
        </div>

        <form action="{{ route('schedule.update', $data->id) }}" method="POST" class="space-y-6" novalidate>
            @csrf
            @method('PUT')
            <input type="hidden" id="edit-id" value="{{ $data->id }}">

            @if ($errors->any())
                <div class="alert alert-error shadow-lg">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <h3 class="font-bold">Terdapat kesalahan pada form:</h3>
                            <ul class="list-disc ml-4 mt-1 text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Informasi Jadwal -->
            <div class="card bg-base-100 shadow-xl border border-base-200">
                <div class="card-body">
                    <h3 class="card-title text-lg border-b pb-2 mb-4">Informasi Jadwal</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Tgl Operasi -->
                        <div class="form-control w-full">
                            <label class="label"><span class="label-text font-medium">Tanggal Operasi <span
                                        class="text-error">*</span></span></label>
                            <input type="text" id="tgl_operasi" name="tgl_operasi"
                                class="input input-bordered w-full uppercase @error('tgl_operasi') input-error @enderror"
                                value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_operasi)->format('d-m-Y') }}"
                                required />
                            @error('tgl_operasi')
                                <label class="label"><span class="label-text-alt text-error">{{ $message }}</span></label>
                            @enderror
                        </div>

                        <!-- Ruang Operasi -->
                        <div class="form-control w-full">
                            <label class="label"><span class="label-text font-medium">Ruang Operasi <span
                                        class="text-error">*</span></span></label>
                            <select name="ruang_operasi" id="ruang_operasi" class="select select-bordered w-full uppercase"
                                required>
                                @foreach ($optionKamar as $room)
                                    <option value="{{ $room }}" @if ($room == $data->ruang_operasi) selected @endif>
                                        {{ $room }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Jam Operasi -->
                        <div class="form-control w-full">
                            <label class="label"><span class="label-text font-medium">Jam Operasi</span></label>
                            <div class="join w-full">
                                <select name="jam_operasi" id="jam_operasi" class="select select-bordered join-item w-1/2"
                                    data-selected="{{ $data->jam_operasi }}" required>
                                    <!-- options via js -->
                                </select>
                                <span class="btn btn-disabled join-item">s.d.</span>
                                <input type="text" name="jam_operasi2" id="jam_operasi2"
                                    class="input input-bordered join-item w-1/2 uppercase"
                                    value="{{ $data->jam_operasi2 }}">
                            </div>
                        </div>

                        <!-- Status Operasi -->
                        <div class="form-control w-full">
                            <label class="label"><span class="label-text font-medium">Status Operasi</span></label>
                            <select name="status" class="select select-bordered w-full uppercase">
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
            <div class="card bg-base-100 shadow-xl border border-base-200">
                <div class="card-body">
                    <h3 class="card-title text-lg border-b pb-2 mb-4">Informasi Pasien</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-control w-full">
                            <label class="label"><span class="label-text font-medium">No. CM <span
                                        class="text-error">*</span></span></label>
                            <input type="number" name="no_cm" id="no_cm"
                                class="input input-bordered w-full uppercase @error('no_cm') input-error @enderror"
                                value="{{ $data->no_cm }}" required />
                            @error('no_cm')
                                <label class="label"><span
                                        class="label-text-alt text-error">{{ $message }}</span></label>
                            @enderror
                        </div>

                        <div class="form-control w-full">
                            <label class="label"><span class="label-text font-medium">Nama Pasien <span
                                        class="text-error">*</span></span></label>
                            <div class="join w-full">
                                <select name="prefix" id="prefix" class="select select-bordered join-item">
                                    <option value="tn." {{ $data->prefix == 'tn.' ? 'selected' : '' }}>Tn.</option>
                                    <option value="ny." {{ $data->prefix == 'ny.' ? 'selected' : '' }}>Ny.</option>
                                    <option value="nn." {{ $data->prefix == 'nn.' ? 'selected' : '' }}>Nn.</option>
                                    <option value="by." {{ $data->prefix == 'by.' ? 'selected' : '' }}>By.</option>
                                    <option value="an." {{ $data->prefix == 'an.' ? 'selected' : '' }}>An.</option>
                                </select>
                                <input type="text" name="nama_pasien" id="nama_pasien"
                                    class="input input-bordered w-full join-item uppercase"
                                    value="{{ $data->nama_pasien }}" required>
                            </div>
                        </div>

                        <div class="form-control w-full">
                            <label class="label"><span class="label-text font-medium">Usia <span
                                        class="text-error">*</span></span></label>
                            <div class="join w-full">
                                <input type="number" name="usia" id="usia"
                                    class="input input-bordered w-full join-item @error('usia') input-error @enderror"
                                    value="{{ $data->usia }}" required>
                                <select name="s_usia" id="s_usia" class="select select-bordered join-item">
                                    <option value="Tahun"
                                        {{ in_array($data->s_usia, ['Tahun', 'thn']) ? 'selected' : '' }}>thn</option>
                                    <option value="Bulan"
                                        {{ in_array($data->s_usia, ['Bulan', 'bln']) ? 'selected' : '' }}>bln</option>
                                </select>
                            </div>
                            @error('usia')
                                <label class="label"><span
                                        class="label-text-alt text-error">{{ $message }}</span></label>
                            @enderror
                        </div>

                        <div class="form-control w-full">
                            <label class="label"><span class="label-text font-medium">Berat Badan (BB)</span></label>
                            <input type="text" name="bb" id="bb"
                                class="input input-bordered w-full uppercase" value="{{ $data->bb }}" />
                        </div>

                        <div class="form-control w-full md:col-span-2">
                            <label class="label"><span class="label-text font-medium">Jaminan <span
                                        class="text-error">*</span></span></label>
                            <input type="text" name="jaminan" id="jaminan"
                                class="input input-bordered w-full uppercase @error('jaminan') input-error @enderror"
                                value="{{ $data->jaminan }}" required />
                            @error('jaminan')
                                <label class="label"><span
                                        class="label-text-alt text-error">{{ $message }}</span></label>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Medis -->
            <div class="card bg-base-100 shadow-xl border border-base-200">
                <div class="card-body">
                    <h3 class="card-title text-lg border-b pb-2 mb-4">Informasi Medis & Prosedur</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-control w-full">
                            <label class="label"><span class="label-text font-medium">Diagnosa <span
                                        class="text-error">*</span></span></label>
                            <input type="text" name="diagnosa" id="diagnosa"
                                class="input input-bordered w-full uppercase @error('diagnosa') input-error @enderror"
                                value="{{ $data->diagnosa }}" required />
                            @error('diagnosa')
                                <label class="label"><span
                                        class="label-text-alt text-error">{{ $message }}</span></label>
                            @enderror
                        </div>
                        <div class="form-control w-full">
                            <label class="label"><span class="label-text font-medium">Tindakan <span
                                        class="text-error">*</span></span></label>
                            <input type="text" name="tindakan" id="tindakan"
                                class="input input-bordered w-full uppercase @error('tindakan') input-error @enderror"
                                value="{{ $data->tindakan }}" required />
                            @error('tindakan')
                                <label class="label"><span
                                        class="label-text-alt text-error">{{ $message }}</span></label>
                            @enderror
                        </div>

                        <div class="form-control w-full">
                            <label class="label"><span class="label-text font-medium">Operator <span
                                        class="text-error">*</span></span></label>
                            <select name="dokter_id" id="dokter_id" class="select select-bordered w-full"
                                data-selected="{{ $data->dokter_id ?? '' }}" required>
                                <!-- options via js -->
                            </select>
                        </div>

                        <div class="form-control w-full">
                            <label class="label"><span class="label-text font-medium">Asisten</span></label>
                            <input type="text" name="asisten" id="asisten"
                                class="input input-bordered w-full uppercase" value="{{ $data->asisten }}" />
                        </div>

                        <div class="form-control w-full">
                            <label class="label"><span class="label-text font-medium">Anestesi</span></label>
                            <select name="anestesi" id="anestesi" class="select select-bordered w-full" required>
                                <option value="">-- Pilih Anestesiologis --</option>
                                @foreach ($operators as $operator)
                                    <option value="{{ $operator->nama_dokter }}"
                                        @if ($operator->nama_dokter == $data->anestesi) selected @endif>{{ $operator->nama_dokter }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-control w-full justify-center mt-6">
                            <input type="hidden" name="verifikasi" value="belum">
                            <div class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="verifikasi" value="sudah" id="verifikasi"
                                    class="checkbox checkbox-xs" {{ $data->verifikasi == 'sudah' ? 'checked' : '' }} />
                                <label for="verifikasi"
                                    class="font-medium text-base cursor-pointer select-none">Verifikasi Persiapan
                                    Operasi</label>
                            </div>
                        </div>

                        <div class="form-control w-full md:col-span-2">
                            <label class="label"><span class="label-text font-medium">Catatan Hasil Pemeriksaan
                                    Penunjang</span></label>
                            <input type="text" name="catatan_hasil_penunjang" id="catatan_hasil_penunjang"
                                class="input input-bordered w-full uppercase"
                                value="{{ $data->catatan_hasil_penunjang }}" />
                        </div>

                        <div class="form-control w-full md:col-span-2">
                            <label class="label"><span class="label-text font-medium">Keterangan</span></label>
                            <input type="text" name="keterangan" id="keterangan" class="input input-bordered w-full"
                                value="{{ $data->keterangan }}" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Konsultasi -->
            <div class="card bg-base-100 shadow-xl border border-base-200">
                <div class="card-body">
                    <h3 class="card-title text-lg border-b pb-2 mb-4">Konsultasi Pre-Operatif</h3>

                    <div class="overflow-x-auto">
                        <table class="table table-zebra border w-full hidden md:table">
                            <thead class="bg-base-200 font-bold text-base-content">
                                <tr>
                                    <th>Jenis Konsul</th>
                                    <th>Tanggal Konsul</th>
                                    <th>Hasil Konsul</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="font-medium">IPD</td>
                                    <td><input id="tgl_ipd" type="date" name="tgl_ipd"
                                            class="input input-bordered input-sm w-full uppercase"
                                            value="{{ strtotime($data->tgl_ipd) ? date('Y-m-d', strtotime(str_replace('/', '-', $data->tgl_ipd))) : '' }}">
                                    </td>
                                    <td><input type="text" name="hasil_ipd"
                                            class="input input-bordered input-sm w-full uppercase"
                                            value="{{ $data->hasil_ipd }}"></td>
                                </tr>
                                <tr>
                                    <td class="font-medium">Jantung</td>
                                    <td><input id="tgl_jantung" type="date" name="tgl_jantung"
                                            class="input input-bordered input-sm w-full uppercase"
                                            value="{{ strtotime($data->tgl_jantung) ? date('Y-m-d', strtotime(str_replace('/', '-', $data->tgl_jantung))) : '' }}">
                                    </td>
                                    <td><input type="text" name="hasil_jantung"
                                            class="input input-bordered input-sm w-full uppercase"
                                            value="{{ $data->hasil_jantung }}"></td>
                                </tr>
                                <tr>
                                    <td class="font-medium">Anasthesi</td>
                                    <td><input id="tgl_anasthesi" type="date" name="tgl_anasthesi"
                                            class="input input-bordered input-sm w-full uppercase"
                                            value="{{ strtotime($data->tgl_anasthesi) ? date('Y-m-d', strtotime(str_replace('/', '-', $data->tgl_anasthesi))) : '' }}">
                                    </td>
                                    <td><input type="text" name="hasil_anasthesi"
                                            class="input input-bordered input-sm w-full uppercase"
                                            value="{{ $data->hasil_anasthesi }}"></td>
                                </tr>
                                <tr>
                                    <td class="font-medium">Lain-lain</td>
                                    <td><input id="tgl_lain" type="date" name="tgl_lain"
                                            class="input input-bordered input-sm w-full uppercase"
                                            value="{{ strtotime($data->tgl_lain) ? date('Y-m-d', strtotime(str_replace('/', '-', $data->tgl_lain))) : '' }}">
                                    </td>
                                    <td><input type="text" name="hasil_lain"
                                            class="input input-bordered input-sm w-full uppercase"
                                            value="{{ $data->hasil_lain }}"></td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Mobile view alternative -->
                        <div class="md:hidden space-y-4 pt-2">
                            <div class="bg-base-200 p-4 rounded-lg">
                                <h4 class="font-bold border-b border-base-300 pb-2 mb-3">Konsul IPD</h4>
                                <div class="space-y-3">
                                    <div>
                                        <label class="label pt-0"><span class="label-text">Tanggal</span></label>
                                        <input id="tgl_ipd" type="date" name="tgl_ipd"
                                            class="input input-bordered w-full input-sm uppercase"
                                            value="{{ strtotime($data->tgl_ipd) ? date('Y-m-d', strtotime(str_replace('/', '-', $data->tgl_ipd))) : '' }}">
                                    </div>
                                    <div>
                                        <label class="label pt-0"><span class="label-text">Hasil</span></label>
                                        <input type="text" name="hasil_ipd"
                                            class="input input-bordered w-full input-sm uppercase"
                                            value="{{ $data->hasil_ipd }}">
                                    </div>
                                </div>
                            </div>
                            <div class="bg-base-200 p-4 rounded-lg">
                                <h4 class="font-bold border-b border-base-300 pb-2 mb-3">Konsul Jantung</h4>
                                <div class="space-y-3">
                                    <div>
                                        <label class="label pt-0"><span class="label-text">Tanggal</span></label>
                                        <input id="tgl_jantung" type="date" name="tgl_jantung"
                                            class="input input-bordered w-full input-sm uppercase"
                                            value="{{ strtotime($data->tgl_jantung) ? date('Y-m-d', strtotime(str_replace('/', '-', $data->tgl_jantung))) : '' }}">
                                    </div>
                                    <div>
                                        <label class="label pt-0"><span class="label-text">Hasil</span></label>
                                        <input type="text" name="hasil_jantung"
                                            class="input input-bordered w-full input-sm uppercase"
                                            value="{{ $data->hasil_jantung }}">
                                    </div>
                                </div>
                            </div>
                            <div class="bg-base-200 p-4 rounded-lg">
                                <h4 class="font-bold border-b border-base-300 pb-2 mb-3">Konsul Anasthesi</h4>
                                <div class="space-y-3">
                                    <div>
                                        <label class="label pt-0"><span class="label-text">Tanggal</span></label>
                                        <input id="tgl_anasthesi" type="date" name="tgl_anasthesi"
                                            class="input input-bordered w-full input-sm uppercase"
                                            value="{{ strtotime($data->tgl_anasthesi) ? date('Y-m-d', strtotime(str_replace('/', '-', $data->tgl_anasthesi))) : '' }}">
                                    </div>
                                    <div>
                                        <label class="label pt-0"><span class="label-text">Hasil</span></label>
                                        <input type="text" name="hasil_anasthesi"
                                            class="input input-bordered w-full input-sm uppercase"
                                            value="{{ $data->hasil_anasthesi }}">
                                    </div>
                                </div>
                            </div>
                            <div class="bg-base-200 p-4 rounded-lg">
                                <h4 class="font-bold border-b border-base-300 pb-2 mb-3">Konsul Lain-lain</h4>
                                <div class="space-y-3">
                                    <div>
                                        <label class="label pt-0"><span class="label-text">Tanggal</span></label>
                                        <input id="tgl_lain" type="date" name="tgl_lain"
                                            class="input input-bordered w-full input-sm uppercase"
                                            value="{{ strtotime($data->tgl_lain) ? date('Y-m-d', strtotime(str_replace('/', '-', $data->tgl_lain))) : '' }}">
                                    </div>
                                    <div>
                                        <label class="label pt-0"><span class="label-text">Hasil</span></label>
                                        <input type="text" name="hasil_lain"
                                            class="input input-bordered w-full input-sm uppercase"
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
                <a href="{{ route('schedule.index') }}" class="btn btn-error btn-outline w-full md:w-32">Batal</a>
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
