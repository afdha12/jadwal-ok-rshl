@extends('components.layout')

@section('title', 'Dashboard')

@section('content')

    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-body m-2">
                    <form action="{{ route('schedule.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Tanggal Operasi</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="tgl_operasi" name="tgl_operasi">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Jam Operasi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="jam_operasi" name="jam_operasi">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Nama Pasien</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_pasien" name="nama_pasien">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Usia</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="usia" name="usia">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">No. CM</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="no_cm" name="no_cm">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Diagnosa</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="diagnosa" name="diagnosa">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Tindakan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="tindakan" name="tindakan">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Operator</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="operator" name="operator">
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Ruang Operasi</label>
                            <div class="col-sm-8">
                                <select name="ruang_operasi" class="form-control">
                                    <option value="Kamar 1">Kamar 1</option>
                                    <option value="Kamar 2">Kamar 2</option>
                                    <option value="Kamar 3">Kamar 3</option>
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
