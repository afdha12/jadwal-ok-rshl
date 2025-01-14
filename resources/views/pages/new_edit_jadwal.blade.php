@extends('components.layout')

@section('title', 'Edit Jadwal Operasi')

@section('content')

    <div class="row d-flex justify-content-center align-items-center m-3">
        <h3>Edit Jadwal Operasi</h3>
    </div>
    <form action="{{ route('schedule.update', $data->id) }}" method="POST">
        {{-- <form action="{{ route('schedule.store') }}" method="POST"> --}}
        @csrf
        @method('PUT')

        <input type="hidden" id="edit-id" value="{{ $data->id }}">

        <div class="card my-2">
            <div class="card-body m-3">
                <div class="row">
                    <div class="col">
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Tanggal Operasi</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm required text-uppercase"
                                    id="tgl_operasi" name="tgl_operasi"
                                    value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_operasi)->format('d-m-Y') }}">
                            </div>
                        </div>
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Ruang Operasi</label>
                            </div>
                            <div class="col-sm-5">
                                <select name="ruang_operasi" id="ruang_operasi"
                                    class="form-control form-control-sm required text-uppercase">
                                    @foreach ($optionKamar as $room)
                                        <option value="{{ $room }}"
                                            @if ($room == $data->ruang_operasi) selected @endif>
                                            {{ $room }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col ms-auto">
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Jam Operasi</label>
                            </div>
                            <div class="col-sm-5">
                                <div class="input-group input-group-sm">
                                    <select name="jam_operasi" id="jam_operasi"
                                        class="form-control form-control-sm required"
                                        data-selected="{{ $data->jam_operasi }}">
                                        {{-- <option value="{{ $data->jam_operasi }}">{{ $data->jam_operasi }}</option> --}}
                                    </select>
                                    {{-- <input type="text" class="form-control form-control-sm text-uppercase"
                                        id="jam_operasi" name="jam_operasi" value="{{ $data->jam_operasi }}"> --}}
                                    <input class="input-group-text col-2" type="text" value="s.d."
                                        aria-label="Disabled input example" disabled readonly>
                                    <input type="text" class="form-control form-control-sm text-uppercase"
                                        id="jam_operasi2" name="jam_operasi2" value="{{ $data->jam_operasi2 }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card my-2">
            <div class="card-body m-3">
                <div class="row">
                    <div class="col">
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">No. CM</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="number" class="form-control form-control-sm required text-uppercase"
                                    id="no_cm" name="no_cm" value="{{ $data->no_cm }}">
                            </div>
                        </div>

                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Nama Pasien</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm required text-uppercase"
                                    id="nama_pasien" name="nama_pasien" value="{{ $data->nama_pasien }}">
                            </div>
                        </div>
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Usia</label>
                            </div>
                            <div class="col-sm-5">
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control form-control-sm required" id="usia"
                                        name="usia" value="{{ $data->usia }}" aria-label="usia"
                                        aria-describedby="basic-addon1">
                                    {{-- <input type="text" class="form-control form-control-sm" placeholder="Username" aria-label="Username"
                                                aria-describedby="basic-addon1"> --}}
                                    {{-- <span class="input-group-text" id="basic-addon1">thn</span> --}}
                                    <select class="input-group-text" id="s_usia" name="s_usia">
                                        <option value="thn">thn</option>
                                        <option value="bln">bln</option>
                                    </select>
                                    @error('usia')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">BB</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm text-uppercase" id="bb"
                                    name="bb" value="{{ $data->bb }}">
                            </div>
                        </div>
                    </div>

                    <div class="col ms-auto">
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Diagnosa</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm required text-uppercase"
                                    id="diagnosa" name="diagnosa" value="{{ $data->diagnosa }}">
                            </div>
                        </div>

                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Jaminan</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm required text-uppercase"
                                    id="jaminan" name="jaminan" value="{{ $data->jaminan }}">
                            </div>
                        </div>

                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Tindakan</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm required text-uppercase"
                                    id="tindakan" name="tindakan" value="{{ $data->tindakan }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card my-2">
            <div class="card-body m-3">
                <div class="row">
                    <div class="col">
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Operator</label>
                            </div>
                            <div class="col-sm-5">
                                {{-- <input type="text" class="form-control form-control-sm required text-uppercase" id="operator" name="operator"> --}}
                                <select name="dokter_id" id="dokter_id" class="form-control form-control-sm required"
                                    data-selected="{{ $data->dokter_id ?? '' }}">
                                    {{-- @foreach ($operators as $operator)
                                        <option value="{{ $operator->id }}"
                                            @if ($operator->id == $data->dokter_id) selected @endif>
                                            {{ $operator->nama_dokter }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Asisten</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm text-uppercase" id="asisten"
                                    name="asisten" value="{{ $data->asisten }}">
                            </div>
                        </div>
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Instrumentator</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm text-uppercase"
                                    id="instrumentator" name="instrumentator" value="{{ $data->instrumentator }}">
                            </div>
                        </div>
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Sirkulasi</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm text-uppercase" id="sirkulasi"
                                    name="sirkulasi" value="{{ $data->sirkulasi }}">
                            </div>
                        </div>
                    </div>
                    <div class="col ms-auto">
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Anestesi</label>
                            </div>
                            <div class="col-sm-5">
                                <select name="anestesi" class="form-control form-control-sm required">
                                    <option value="">-- Pilih Anestesiologis --</option>
                                    @foreach ($operators as $operator)
                                        <option value="{{ $operator->nama_dokter }}"
                                            @if ($operator->nama_dokter == $data->anestesi) selected @endif>
                                            {{ $operator->nama_dokter }}</option>
                                    @endforeach
                                </select>
                                {{-- <input type="text" class="form-control form-control-sm" id="anestesi"
                                    name="anestesi" value="{{ $data->anestesi }}"> --}}
                            </div>
                        </div>
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Penata Anestesi</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm text-uppercase" id="p_anestesi"
                                    name="p_anestesi" value="{{ $data->p_anestesi }}">
                            </div>
                        </div>
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Anak</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm text-uppercase" id="anak"
                                    name="anak" value="{{ $data->anak }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card my-2">
            <div class="card-body m-3">
                <div class="row">
                    <div class="col">
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Jam Puasa</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm text-uppercase" id="jam_puasa"
                                    name="jam_puasa" value="{{ $data->jam_puasa }}">
                            </div>
                        </div>
                    </div>
                    <div class="col ms-auto">
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Jam Kedatangan</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm text-uppercase"
                                    id="jam_kedatangan" name="jam_kedatangan" value="{{ $data->jam_kedatangan }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card my-2">
            <div class="card-body m-3">
                <div class="row">
                    <div class="col">
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Lab</label>
                            </div>
                            <div class="col-sm-5">
                                <select name="lab" class="form-control form-control-sm text-uppercase">
                                    <option value="">-- Pilih Ketersediaan Dokumen --</option>
                                    @foreach ($docs as $doc)
                                        <option value="{{ $doc }}"
                                            @if ($doc == $data->lab) selected @endif>
                                            {{ $doc }}</option>
                                    @endforeach
                                </select>
                                {{-- <input type="text" class="form-control form-control-sm text-uppercase" id="lab"
                                    name="lab" value="{{ $data->lab }}"> --}}
                            </div>
                        </div>
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">RO</label>
                            </div>
                            <div class="col-sm-5">
                                <select name="ro" class="form-control form-control-sm text-uppercase">
                                    <option value="">-- Pilih Ketersediaan Dokumen --</option>
                                    @foreach ($docs as $doc)
                                        <option value="{{ $doc }}"
                                            @if ($doc == $data->ro) selected @endif>
                                            {{ $doc }}</option>
                                    @endforeach
                                </select>
                                {{-- <input type="text" class="form-control form-control-sm text-uppercase" id="ro"
                                    name="ro"> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col ms-auto">
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">CT-Scan</label>
                            </div>
                            <div class="col-sm-5">
                                <select name="ct_scan" class="form-control form-control-sm text-uppercase">
                                    <option value="">-- Pilih Ketersediaan Dokumen --</option>
                                    @foreach ($docs as $doc)
                                        <option value="{{ $doc }}"
                                            @if ($doc == $data->ct_scan) selected @endif>
                                            {{ $doc }}</option>
                                    @endforeach
                                </select>
                                {{-- <input type="text" class="form-control form-control-sm text-uppercase" id="ct_scan"
                                    name="ct_scan" value="{{ $data->ct_scan }}"> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card my-2">
            <div class="card-body m-3">
                <div class="row">
                    <div class="col">
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Tanggal Konsul IPD</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm text-uppercase" id="tgl_ipd"
                                    name="tgl_ipd" value="{{ $data->tgl_ipd }}">
                            </div>
                        </div>

                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Tanggal Konsul Jantung</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm text-uppercase"
                                    id="tgl_jantung" name="tgl_jantung" value="{{ $data->tgl_jantung }}">
                            </div>
                        </div>

                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Tanggal Konsul Anasthesi</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm text-uppercase"
                                    id="tgl_anasthesi" name="tgl_anasthesi" value="{{ $data->tgl_anasthesi }}">
                            </div>
                        </div>

                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Tanggal Konsul Lain2</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm text-uppercase" id="tgl_lain"
                                    name="tgl_lain" value="{{ $data->tgl_lain }}">
                            </div>
                        </div>

                    </div>
                    <div class="col ms-auto">
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Hasil Konsul IPD</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm text-uppercase" id="hasil_ipd"
                                    name="hasil_ipd" value="{{ $data->hasil_ipd }}">
                            </div>
                        </div>

                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Hasil Konsul Jantung</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm text-uppercase"
                                    id="hasil_jantung" name="hasil_jantung" value="{{ $data->hasil_jantung }}">
                            </div>
                        </div>

                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Hasil Konsul Anasthesi</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm text-uppercase"
                                    id="hasil_anasthesi" name="hasil_anasthesi" value="{{ $data->hasil_anasthesi }}">
                            </div>
                        </div>

                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Hasil Konsul Lain2</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm text-uppercase" id="hasil_lain"
                                    name="hasil_lain" value="{{ $data->hasil_lain }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card my-2">
            <div class="card-body m-3">
                <div class="row">
                    <div class="row d-flex justify-content-start align-items-center">
                        <div class="col-sm-4">
                            <label for="colFormLabel" class="col-form-label">Pembahasan Kesiapan Kelengkapan
                                Tindakan</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control form-control-sm text-uppercase" id="pkkt"
                                name="pkkt" value="{{ $data->pkkt }}">
                        </div>
                    </div>
                    <div class="row d-flex justify-content-start align-items-center">
                        <div class="col-sm-4">
                            <label for="colFormLabel" class="col-form-label">Verifikasi Persiapan Operasi</label>
                        </div>
                        <div class="col-sm-5">
                            {{-- <input type="text" class="form-control form-control-sm text-uppercase" id="verifikasi"
                                name="verifikasi" value="{{ $data->verifikasi }}"> --}}
                                <select name="verifikasi" class="form-control form-control-sm required">
                                    <option value="sudah" {{ $data->verifikasi == 'sudah' ? 'selected' : '' }}>Sudah</option>
                                    <option value="belum" {{ $data->verifikasi == 'belum' ? 'selected' : '' }}>Belum</option>
                                </select>                                
                        </div>
                    </div>
                    <div class="row d-flex justify-content-start align-items-center">
                        <div class="col-sm-4">
                            <label for="colFormLabel" class="col-form-label">Mengingatkan Tim H-1</label>
                        </div>
                        <div class="col-sm-5">
                            <select name="pengingat" class="form-control form-control-sm required">
                                <option value="sudah" {{ $data->pengingat == 'sudah' ? 'selected' : '' }}>Sudah</option>
                                <option value="belum" {{ $data->pengingat == 'belum' ? 'selected' : '' }}>Belum</option>
                            </select>                            
                            {{-- <input type="text" class="form-control form-control-sm text-uppercase" id="pengingat"
                                name="pengingat" value="{{ $data->pengingat }}"> --}}
                        </div>
                    </div>
                    <div class="row d-flex justify-content-start align-items-center">
                        <div class="col-sm-4">
                            <label for="colFormLabel" class="col-form-label">Keterangan</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control form-control-sm text-uppercase" id="keterangan"
                                name="keterangan" value="{{ $data->keterangan }}">
                        </div>
                    </div>
                    {{-- <div class="col">
                    </div>
                    <div class="col ms-auto">
                    </div> --}}
                </div>
            </div>
        </div>

        <div class="card my-2">
            <div class="card-body m-3">
                <div class="row">
                    <div class="row d-flex justify-content-start align-items-center">
                        <div class="col-sm-2">
                            <label for="colFormLabel" class="col-form-label">Status Operasi</label>
                        </div>
                        <div class="col-sm-2">
                            <select name="status" class="form-control form-control-sm text-uppercase">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}" @if ($status == $data->status) selected @endif>
                                        {{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-end align-items-center col-sm ms-auto">
                            <div class="mx-2">
                                <a class="btn btn-danger px-3" href = "{{ route('schedule.index') }}">Batal</a>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil elemen input
            const dateInput = document.querySelector('#tgl_operasi');
            const roomInput = document.querySelector('#ruang_operasi');
            const timeSelect = document.querySelector('#jam_operasi');
            const editId = document.querySelector('#edit-id') ? document.querySelector('#edit-id').value : null;

            // Fungsi untuk mengambil jam yang tersedia
            function fetchAvailableTimes() {
                const date = dateInput.value;
                const room = roomInput.value;

                // Jika salah satu belum dipilih, kosongkan dropdown
                if (!date || !room) {
                    timeSelect.innerHTML =
                        '<option value="">Pilih tanggal dan ruang operasi terlebih dahulu</option>';
                    return;
                }

                // Kirim permintaan AJAX untuk mengambil waktu yang tersedia
                let url = `/get-available-times?tgl_operasi=${date}&ruang_operasi=${room}`;
                if (editId) {
                    url += `&id=${editId}`; // Jika di halaman edit, tambahkan ID untuk pengecekan yang lebih spesifik
                }

                console.log('Fetching available times from URL:', url); // Debugging statement

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        console.log('Available times:', data); // Debugging statement
                        timeSelect.innerHTML = '<option value="">Pilih Jam</option>';
                        data.forEach(time => {
                            timeSelect.innerHTML += `<option value="${time}">${time}</option>`;
                        });
                    })
                    .catch(error => console.error('Error:', error));
            }

            // Tambahkan event listener untuk kedua input (tanggal dan ruang operasi)
            dateInput.addEventListener('change', fetchAvailableTimes);
            roomInput.addEventListener('change', fetchAvailableTimes);

            // Jika halaman edit, langsung jalankan fetch untuk mendapatkan waktu yang tersedia
            if (editId) {
                fetchAvailableTimes();
            }
        });
    </script> --}}


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil elemen input
            const dateInput = document.querySelector('#tgl_operasi');
            const roomInput = document.querySelector('#ruang_operasi');
            const timeSelect = document.querySelector('#jam_operasi');
            const doctorSelect = document.querySelector('#dokter_id');
            const editId = document.querySelector('#edit-id') ? document.querySelector('#edit-id').value : null;

            // Fungsi untuk mengambil jam yang tersedia
            function fetchAvailableTimes() {
                const date = dateInput.value;
                const room = roomInput.value;

                // Jika salah satu belum dipilih, kosongkan dropdown
                if (!date || !room) {
                    timeSelect.innerHTML =
                        '<option value="">Pilih tanggal dan ruang operasi terlebih dahulu</option>';
                    return;
                }

                // Kirim permintaan AJAX untuk mengambil waktu yang tersedia
                let url = `/get-available-times?tgl_operasi=${date}&ruang_operasi=${room}`;
                if (editId) {
                    url +=
                        `&edit_id=${editId}`; // Jika di halaman edit, tambahkan ID untuk pengecekan yang lebih spesifik
                }

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        timeSelect.innerHTML = '<option value="">Pilih Jam</option>';
                        data.forEach(time => {
                            timeSelect.innerHTML += `<option value="${time}">${time}</option>`;
                        });

                        // Tetapkan nilai default dari jadwal yang sedang diedit
                        const currentTime = document.querySelector('#jam_operasi').dataset.selected;
                        if (currentTime) {
                            const option = timeSelect.querySelector(`option[value="${currentTime}"]`);
                            if (option) option.selected = true;
                        }

                        // Panggil fetchAvailableDoctors setelah jam operasi tersedia
                        fetchAvailableDoctors();
                    });
            }

            // Fungsi untuk mengambil dokter yang tersedia
            function fetchAvailableDoctors() {
                const date = dateInput.value;
                const room = roomInput.value;
                const time = timeSelect.value;
                const selectedDoctorId = doctorSelect.dataset.selected; // Ambil nilai dari atribut data-selected

                if (!date || !room || !time) {
                    doctorSelect.innerHTML =
                        '<option value="">Pilih tanggal, ruangan, dan jam operasi terlebih dahulu</option>';
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
                                `<option value="${doctor.id}" ${doctor.id == selectedDoctorId ? 'selected' : ''}>
                    ${doctor.nama_dokter}
                </option>`;
                        });

                        // Kosongkan data-selected setelah digunakan
                        doctorSelect.dataset.selected = '';
                    })
                    .catch(error => console.error("Error fetching doctors:", error));
            }


            // Tambahkan event listener untuk kedua input (tanggal dan ruang operasi)
            dateInput.addEventListener('change', fetchAvailableTimes);
            roomInput.addEventListener('change', fetchAvailableTimes);
            timeSelect.addEventListener('change', fetchAvailableDoctors);

            // Panggil fungsi awal
            fetchAvailableTimes();
        });
    </script>


    {{-- <script>
        const dateInput = document.querySelector('#tgl_operasi');
        const roomInput = document.querySelector('#ruang_operasi');
        const timeInput = document.querySelector('#jam_operasi');
        const timeSelect = document.querySelector('#jam_operasi');
        const doctorSelect = document.querySelector('#dokter_id');
        // Ambil ID jadwal dari URL
        const editId = window.location.pathname.split('/').slice(-2, -1)[0];

        // AJAX untuk halaman edit
        function fetchAvailableTimes() {
            const date = dateInput.value;
            const room = roomInput.value;
            // const timeSelect = document.querySelector('#jam_operasi');

            if (!date || !room) {
                timeSelect.innerHTML = '<option value="">Pilih tanggal dan ruang operasi terlebih dahulu</option>';
                return;
            }

            // Fetch data
            fetch(`/get-available-times?tgl_operasi=${date}&ruang_operasi=${room}&edit_id=${editId}`)
                .then(response => response.json())
                .then(data => {
                    timeSelect.innerHTML = '<option value="">Pilih Jam</option>';
                    data.forEach(time => {
                        timeSelect.innerHTML += `<option value="${time}">${time}</option>`;
                    });

                    // Tetapkan nilai default dari jadwal yang sedang diedit
                    const currentTime = document.querySelector('#jam_operasi').dataset.selected;
                    if (currentTime) {
                        const option = timeSelect.querySelector(`option[value="${currentTime}"]`);
                        if (option) option.selected = true;
                    }
                });
        }

        // Tambahkan event listener
        document.querySelector('#tgl_operasi').addEventListener('change', fetchAvailableTimes);
        document.querySelector('#ruang_operasi').addEventListener('change', fetchAvailableTimes);

        // Panggil fungsi awal
        fetchAvailableTimes();

        function fetchAvailableDoctors() {
            const date = dateInput.value;
            const room = roomInput.value;
            const time = timeInput.value;
            // const editId = editIdInput.value; // Pastikan ada input tersembunyi untuk schedule_id

            if (!date || !room || !time) {
                doctorSelect.innerHTML =
                    '<option value="">Pilih tanggal, ruangan, dan jam operasi terlebih dahulu</option>';
                return;
            }

            fetch(
                    `/get-available-doctors?tgl_operasi=${date}&ruang_operasi=${room}&jam_operasi=${time}&schedule_id=${editId}`)
                .then(response => response.json())
                .then(data => {
                    doctorSelect.innerHTML = '<option value="">Pilih Dokter</option>';
                    data.forEach(doctor => {
                        doctorSelect.innerHTML +=
                            `<option value="${doctor.id}">${doctor.nama_dokter}</option>`;
                    });
                });
        }
        fetchAvailableDoctors();
    </script> --}}



@endsection
