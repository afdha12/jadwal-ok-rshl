@extends('components.layout')

@section('title', 'Input Jadwal Operasi')

@section('content')

    <form action="{{ route('schedule.store') }}" method="POST">
        @csrf
        <div class="d-flex justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-body m-3">
                        <div class="row mb-3 d-flex justify-content-between">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">Tanggal Operasi</label>
                            <div class="col-sm-8">
                                <input type="date"
                                    class="form-control required text-uppercase @error('tgl_operasi') is-invalid @enderror"
                                    id="tgl_operasi" name="tgl_operasi">
                                @error('tgl_operasi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 d-flex justify-content-between">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">Jam Operasi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control text-uppercase" id="jam_operasi"
                                    name="jam_operasi">
                            </div>
                        </div>
                        <div class="row mb-3 d-flex justify-content-between">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">Nama Pasien</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control required text-uppercase @error('nama_pasien') is-invalid @enderror"
                                    id="nama_pasien" name="nama_pasien">
                                @error('nama_pasien')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 d-flex justify-content-between">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">Usia</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="number" class="form-control required @error('age') is-invalid @enderror"
                                        id="age" name="age" aria-label="age" aria-describedby="basic-addon1">
                                    {{-- <input type="text" class="form-control" placeholder="Username" aria-label="Username"
                                        aria-describedby="basic-addon1"> --}}
                                    {{-- <span class="input-group-text" id="basic-addon1">thn</span> --}}
                                    <select class="input-group-text" id="satuan_usia" name="satuan_usia">
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
                        <div class="row mb-3 d-flex justify-content-between">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">No. CM</label>
                            <div class="col-sm-8">
                                <input type="number"
                                    class="form-control required text-uppercase @error('no_cm') is-invalid @enderror"
                                    id="no_cm" name="no_cm">
                                @error('no_cm')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 d-flex justify-content-between">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">Diagnosa</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control required text-uppercase @error('diagnosa') is-invalid @enderror"
                                    id="diagnosa" name="diagnosa">
                                @error('diagnosa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 d-flex justify-content-between">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">Tindakan</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control required text-uppercase @error('tindakan') is-invalid @enderror"
                                    id="tindakan" name="tindakan">
                                @error('tindakan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 d-flex justify-content-between">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">Operator</label>
                            <div class="col-sm-8">
                                {{-- <input type="text" class="form-control required text-uppercase" id="operator" name="operator"> --}}
                                <select name="operator" class="form-control required">
                                    @foreach ($operators as $operator)
                                        <option value="{{ $operator->nama_dokter }}">{{ $operator->nama_dokter }}</option>
                                    @endforeach
                                </select>
                                @error('operator')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 d-flex justify-content-between">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">Ruang Operasi</label>
                            <div class="col-sm-8">
                                <select name="ruang_operasi" class="form-control required text-uppercase">
                                    @foreach ($optionKamar as $ruang_operasi)
                                        <option value="{{ $ruang_operasi }}">{{ $ruang_operasi }}</option>
                                    @endforeach
                                </select>
                                @error('ruang_operasi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 d-flex justify-content-between">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">Jaminan</label>
                            <div class="col-sm-8">
                                <input type="text"
                                    class="form-control required text-uppercase @error('jaminan') is-invalid @enderror"
                                    id="jaminan" name="jaminan">
                                @error('jaminan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 d-flex justify-content-between">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">Keterangan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control text-uppercase" id="profilaksis"
                                    name="profilaksis">
                            </div>
                        </div>
                        <div class="row mb-5 d-flex justify-content-between">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-8">
                                <select name="status" class="form-control text-uppercase">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a class="btn btn-danger px-3" href = "{{ route('schedule.index') }}">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>


                        {{-- <table class="table table-borderless">
                            <tr>
                                <td class="text-center"><a class="btn btn-danger mt-2"
                                    href = "{{ route('schedule.index') }}">Batal</a></td>
                                    <td class="text-center"><button type="submit"
                                        class="btn btn-success mt-2">Simpan</button></td>
                                    </tr>
                                </table> --}}
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
