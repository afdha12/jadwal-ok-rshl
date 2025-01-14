@extends('components.layout')

@section('title', 'Input Jadwal Operasi')

@section('content')

    <div class="row d-flex justify-content-center align-items-center m-3">
        <h3>Tambah Jadwal Operasi Baru</h3>
    </div>
    <form action="{{ route('schedule.store') }}" method="POST">
        @csrf
        <div class="card my-2">
            <div class="card-body m-3">
                <div class="row">
                    <div class="col">
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label required">Tanggal Operasi</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="date"
                                    class="form-control form-control-sm text-uppercase @error('tgl_operasi') is-invalid @enderror"
                                    id="tgl_operasi" name="tgl_operasi" required>
                                @error('tgl_operasi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label required">Ruang Operasi</label>
                            </div>
                            <div class="col-sm-5">
                                <select name="ruang_operasi" id="ruang_operasi" class="form-control form-control-sm"
                                    required>
                                    @foreach ($optionKamar as $room)
                                        <option value="{{ $room }}">{{ $room }}</option>
                                    @endforeach
                                </select>
                                @error('ruang_operasi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col ms-auto">
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label required">Jam Operasi</label>
                            </div>
                            <div class="col-sm-5">
                                <div class="input-group input-group-sm">
                                    <select name="jam_operasi" id="jam_operasi"
                                        class="form-control form-control-sm required">
                                        <option value="">-- Pilih jam --</option>
                                    </select>
                                    {{-- <input type="text" class="form-control form-control-sm text-uppercase"
                                        id="jam_operasi" name="jam_operasi"> --}}
                                    <input class="input-group-text col-2" type="text" value="s.d."
                                        aria-label="Disabled input example" disabled readonly>
                                    <input type="text" class="form-control form-control-sm" id="jam_operasi2"
                                        name="jam_operasi2">
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
                                <label for="colFormLabel" class="col-form-label required">No. CM</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="number"
                                    class="form-control form-control-sm required text-uppercase @error('no_cm') is-invalid @enderror"
                                    id="no_cm" name="no_cm">
                                @error('no_cm')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label required">Nama Pasien</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text"
                                    class="form-control form-control-sm required text-uppercase @error('nama_pasien') is-invalid @enderror"
                                    id="nama_pasien" name="nama_pasien">
                                @error('nama_pasien')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label required">Usia</label>
                            </div>
                            <div class="col-sm-5">
                                <div class="input-group input-group-sm">
                                    <input type="number"
                                        class="form-control form-control-sm required @error('usia') is-invalid @enderror"
                                        id="usia" name="usia" aria-label="usia" aria-describedby="basic-addon1">
                                    {{-- <input type="text" class="form-control form-control-sm" placeholder="Username" aria-label="Username"
                                                aria-describedby="basic-addon1"> --}}
                                    {{-- <span class="input-group-text" id="basic-addon1">thn</span> --}}
                                    <select class="input-group-text" id="s_usia" name="s_usia">
                                        <option value="Tahun">thn</option>
                                        <option value="Bulan">bln</option>
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
                                <label for="colFormLabel" class="col-form-label required">BB</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm text-uppercase" id="bb"
                                    name="bb">
                            </div>
                        </div>
                    </div>

                    <div class="col ms-auto">
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label required">Diagnosa</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text"
                                    class="form-control form-control-sm required text-uppercase @error('diagnosa') is-invalid @enderror"
                                    id="diagnosa" name="diagnosa">
                                @error('diagnosa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label required">Jaminan</label>
                            </div>
                            <div class="col-sm-5">
                                <select name="jaminan" class="form-control form-control-sm required">
                                    <option value="">-- Pilih Jaminan --</option>
                                    @foreach ($penjamin as $kelas)
                                        <option value="{{ $kelas }}">{{ $kelas }}
                                        </option>
                                    @endforeach
                                </select>
                                {{-- <input type="text"
                                    class="form-control form-control-sm required text-uppercase @error('jaminan') is-invalid @enderror"
                                    id="jaminan" name="jaminan"> --}}
                                @error('jaminan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label required">Tindakan</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text"
                                    class="form-control form-control-sm required text-uppercase @error('tindakan') is-invalid @enderror"
                                    id="tindakan" name="tindakan">
                                @error('tindakan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                                <label for="colFormLabel" class="col-form-label required">Operator</label>
                            </div>
                            <div class="col-sm-5">
                                {{-- <input type="text" class="form-control form-control-sm required text-uppercase" id="operator" name="operator"> --}}
                                <select name="dokter_id" id="dokter_id" class="form-control form-control-sm required">
                                    <option value="">-- Pilih Operator --</option>
                                    {{-- @foreach ($operators as $operator)
                                        <option value="{{ $operator->id }}">{{ $operator->nama_dokter }}
                                        </option>
                                    @endforeach --}}
                                </select>
                                @error('operator')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Asisten</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm text-uppercase" id="asisten"
                                    name="asisten">
                            </div>
                        </div>
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Instrumentator</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm text-uppercase"
                                    id="instrumentator" name="instrumentator">
                            </div>
                        </div>
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Sirkulasi</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm text-uppercase" id="sirkulasi"
                                    name="sirkulasi">
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
                                        <option value="{{ $operator->nama_dokter }}">{{ $operator->nama_dokter }}
                                        </option>
                                    @endforeach
                                </select>
                                {{-- <input type="text" class="form-control form-control-sm text-uppercase" id="anestesi"
                                    name="anestesi"> --}}
                            </div>
                        </div>
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Penata Anestesi</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm text-uppercase" id="p_anestesi"
                                    name="p_anestesi">
                            </div>
                        </div>
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Anak</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm text-uppercase" id="anak"
                                    name="anak">
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
                                    name="jam_puasa">
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
                                    id="jam_kedatangan" name="jam_kedatangan">
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
                                <select name="lab" class="form-control form-control-sm">
                                    <option value="">-- Pilih Ketersediaan Dokumen --</option>
                                    @foreach ($docs as $doc)
                                        <option value="{{ $doc }}">{{ $doc }}</option>
                                    @endforeach
                                </select>
                                {{-- <input type="text" class="form-control form-control-sm text-uppercase" id="lab"
                                    name="lab"> --}}
                            </div>
                        </div>
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">RO</label>
                            </div>
                            <div class="col-sm-5">
                                <select name="ro" class="form-control form-control-sm">
                                    <option value="">-- Pilih Ketersediaan Dokumen --</option>
                                    @foreach ($docs as $doc)
                                        <option value="{{ $doc }}">{{ $doc }}</option>
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
                                <select name="ct_scan" class="form-control form-control-sm">
                                    <option value="">-- Pilih Ketersediaan Dokumen --</option>
                                    @foreach ($docs as $doc)
                                        <option value="{{ $doc }}">{{ $doc }}</option>
                                    @endforeach
                                </select>
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
                                    name="tgl_ipd">
                            </div>
                        </div>

                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Tanggal Konsul Jantung</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm text-uppercase"
                                    id="tgl_jantung" name="tgl_jantung">
                            </div>
                        </div>

                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Tanggal Konsul Anasthesi</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm text-uppercase"
                                    id="tgl_anasthesi" name="tgl_anasthesi">
                            </div>
                        </div>

                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Tanggal Konsul Lain2</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm text-uppercase" id="tgl_lain"
                                    name="tgl_lain">
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
                                    name="hasil_ipd">
                            </div>
                        </div>

                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Hasil Konsul Jantung</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm text-uppercase"
                                    id="hasil_jantung" name="hasil_jantung">
                            </div>
                        </div>
                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Hasil Konsul Anasthesi</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm text-uppercase"
                                    id="hasil_anasthesi" name="hasil_anasthesi">
                            </div>
                        </div>

                        <div class="row d-flex justify-content-start align-items-center">
                            <div class="col-sm-4">
                                <label for="colFormLabel" class="col-form-label">Hasil Konsul Lain2</label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm text-uppercase" id="hasil_lain"
                                    name="hasil_lain">
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
                                name="pkkt">
                        </div>
                    </div>
                    <div class="row d-flex justify-content-start align-items-center">
                        <div class="col-sm-4">
                            <label for="colFormLabel" class="col-form-label">Verifikasi Persiapan Operasi</label>
                        </div>
                        <div class="col-sm-5">
                            <select name="verifikasi" class="form-control form-control-sm required">
                                <option value="sudah">Sudah</option>
                                <option value="belum">Belum</option>
                            </select>
                            {{-- <input type="text" class="form-control form-control-sm text-uppercase" id="verifikasi"
                                name="verifikasi"> --}}
                        </div>
                    </div>
                    <div class="row d-flex justify-content-start align-items-center">
                        <div class="col-sm-4">
                            <label for="colFormLabel" class="col-form-label">Mengingatkan Tim H-1</label>
                        </div>
                        <div class="col-sm-5">
                            <select name="pengingat" class="form-control form-control-sm required">
                                <option value="sudah">Sudah</option>
                                <option value="belum">Belum</option>
                            </select>
                            {{-- <input type="text" class="form-control form-control-sm text-uppercase" id="pengingat"
                                name="pengingat"> --}}
                        </div>
                    </div>
                    <div class="row d-flex justify-content-start align-items-center">
                        <div class="col-sm-4">
                            <label for="colFormLabel" class="col-form-label">Keterangan</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control form-control-sm text-uppercase" id="keterangan"
                                name="keterangan">
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
                                    <option value="{{ $status }}">{{ $status }}</option>
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

        {{-- <div>

            <div class="row d-flex justify-content-start align-items-center">
                <div class="col-sm-4">
                    <label for="colFormLabel" class="col-form-label">Keterangan</label>
                </div>
                <div class="col-sm-5">
                    <input type="text" class="form-control form-control-sm text-uppercase" id="profilaksis"
                        name="profilaksis">
                </div>
            </div>

            <table class="table table-borderless">
                <tr>
                    <td class="text-center"><a class="btn btn-danger mt-2"
                            href = "{{ route('schedule.index') }}">Batal</a></td>
                    <td class="text-center"><button type="submit" class="btn btn-success mt-2">Simpan</button></td>
                </tr>
            </table>
        </div> --}}
    </form>

    <script>
        const dateInput = document.querySelector('#tgl_operasi');
        const roomInput = document.querySelector('#ruang_operasi');
        const timeInput = document.querySelector('#jam_operasi');
        const timeSelect = document.querySelector('#jam_operasi');
        const doctorSelect = document.querySelector('#dokter_id');

        // Fungsi untuk mengambil waktu tersedia pada halaman input
        function fetchAvailableTimesForInput() {
            const date = dateInput.value;
            const room = roomInput.value;

            if (!date || !room) {
                timeSelect.innerHTML = '<option value="">Pilih tanggal dan ruang operasi terlebih dahulu</option>';
                return;
            }

            fetch(`/get-available-times?tgl_operasi=${date}&ruang_operasi=${room}`)
                .then(response => response.json())
                .then(data => {
                    timeSelect.innerHTML = '<option value="">Pilih Jam</option>';
                    data.forEach(time => {
                        timeSelect.innerHTML += `<option value="${time}">${time}</option>`;
                    });
                });
        }

        function fetchAvailableDoctors() {
            const date = dateInput.value;
            const room = roomInput.value;
            const time = timeInput.value;

            if (!date || !room || !time) {
                doctorSelect.innerHTML =
                    '<option value="">Pilih tanggal, ruangan, dan jam operasi terlebih dahulu</option>';
                return;
            }

            fetch(`/get-available-doctors?tgl_operasi=${date}&ruang_operasi=${room}&jam_operasi=${time}`)
                .then(response => response.json())
                .then(data => {
                    doctorSelect.innerHTML = '<option value="">Pilih Dokter</option>';
                    data.forEach(doctor => {
                        doctorSelect.innerHTML +=
                            `<option value="${doctor.id}">${doctor.nama_dokter}</option>`;
                    });
                });
        }

        // Tambahkan event listener untuk halaman input
        dateInput.addEventListener('change', fetchAvailableTimesForInput);
        roomInput.addEventListener('change', fetchAvailableTimesForInput);
        dateInput.addEventListener('change', fetchAvailableDoctors);
        roomInput.addEventListener('change', fetchAvailableDoctors);
        timeInput.addEventListener('change', fetchAvailableDoctors);

    </script>

@endsection
