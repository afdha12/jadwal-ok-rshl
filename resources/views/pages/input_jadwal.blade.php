@extends('components.layout')

@section('title', 'Input Jadwal Operasi')

@section('content')

    <div class="d-flex justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-body m-2">
                    <form action="{{ route('schedule.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">Tanggal Operasi</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control required text-uppercase" id="tgl_operasi" name="tgl_operasi">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">Jam Operasi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control required text-uppercase" id="jam_operasi" name="jam_operasi">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">Nama Pasien</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control required text-uppercase" id="nama_pasien" name="nama_pasien">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">Usia</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control required text-uppercase" id="usia" name="usia">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">No. CM</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control required text-uppercase" id="no_cm" name="no_cm">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">Diagnosa</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control required text-uppercase" id="diagnosa" name="diagnosa">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">Tindakan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control required text-uppercase" id="tindakan" name="tindakan">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">Operator</label>
                            <div class="col-sm-8">
                                {{-- <input type="text" class="form-control required text-uppercase" id="operator" name="operator"> --}}
                                <select name="operator" class="form-control required">
                                    @foreach ($operators as $operator)
                                        <option value="{{ $operator }}">{{ $operator }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">Ruang Operasi</label>
                            <div class="col-sm-8">
                                <select name="ruang_operasi" class="form-control required text-uppercase">
                                    @foreach ($optionKamar as $ruang_operasi)
                                        <option value="{{ $ruang_operasi }}">{{ $ruang_operasi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">Jaminan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control required text-uppercase" id="jaminan" name="jaminan">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">Keterangan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control required text-uppercase" id="profilaksis" name="profilaksis">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="colFormLabel" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-8">
                                <select name="status" class="form-control required text-uppercase">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <table class="table table-borderless">
                            <tr>
                                <td class="text-center"><a class="btn btn-danger mt-2" href = "{{ route('schedule.index') }}">Batal</a></td>
                                <td class="text-center"><button type="submit" class="btn btn-success mt-2">Simpan</button></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
