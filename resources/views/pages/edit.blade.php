@extends('components.layout')

@section('title', 'Dashboard')

@section('content')

    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-body m-2">
                    <form action="{{ route('schedule.update', $data->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Tanggal Operasi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="tgl_operasi" name="tgl_operasi"
                                    value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_operasi)->format('d-m-Y') }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Jam Operasi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="jam_operasi" name="jam_operasi"
                                    value="{{ $data->jam_operasi }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Nama Pasien</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_pasien" name="nama_pasien"
                                    value="{{ $data->nama_pasien }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Usia</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="usia" name="usia"
                                    value="{{ $data->usia }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">No. CM</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="no_cm" name="no_cm"
                                    value="{{ $data->no_cm }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Diagnosa</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="diagnosa" name="diagnosa"
                                    value="{{ $data->diagnosa }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Tindakan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="tindakan" name="tindakan"
                                    value="{{ $data->tindakan }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Operator</label>
                            <div class="col-sm-8">
                                <select name="operator" class="form-control">
                                    @foreach ($operators as $operator)
                                        <option value="{{ $operator->nama_dokter }}">{{ $operator->nama_dokter }}</option>
                                        {{-- <option value="{{ $operator }}"
                                            @if ($operator == $data->operator) selected @endif>{{ $operator }}</option> --}}
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Ruang Operasi</label>
                            <div class="col-sm-8">
                                <select name="ruang_operasi" class="form-control">
                                    @foreach ($optionKamar as $ruang_operasi)
                                        <option value="{{ $ruang_operasi }}"
                                            @if ($ruang_operasi == $data->ruang_operasi) selected @endif>{{ $ruang_operasi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Jaminan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="jaminan" name="jaminan"
                                    value="{{ $data->jaminan }}">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Profilaksis</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="profilaksis" name="profilaksis"
                                    value="{{ $data->profilaksis }}">
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Status</label>
                            <div class="col-sm-8">
                                <select name="status" class="form-control">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status }}"
                                            @if ($status == $data->status) selected @endif>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <table class="table table-borderless">
                            <tr>
                                <td class="text-center"><a class="btn btn-danger mt-2"
                                        href = "{{ route('schedule.index') }}">Batal</a></td>
                                <td class="text-center"><button type="submit" class="btn btn-success mt-2">Ubah</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
