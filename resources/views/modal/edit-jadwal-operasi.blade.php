@foreach ($data as $data)
    <form id="editForm" action="{{ route('schedule.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal fade" id="editJadwal{{ $data->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Dokter Anestesi</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- <input type="hidden" id="dokterId"> --}}
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
                                {{-- <input type="text" class="form-control" id="jam_operasi" name="jam_operasi"
                                    value="{{ $data->jam_operasi }}"> --}}
                                <div class="input-group">
                                    <input type="text" class="form-control text-uppercase" id="jam_operasi"
                                        name="jam_operasi" value="{{ $data->jam_operasi }}">
                                    <input class="input-group-text col-2" type="text" value="s.d."
                                        aria-label="Disabled input example" disabled readonly>
                                    <input type="text" class="form-control text-uppercase" id="jam_operasi"
                                        name="jam_operasi2" value="{{ $data->jam_operasi2 }}">
                                </div>
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
                                        {{-- <option value="{{ $operator->id }}"
                                            @if ($operator->id == $data->operator) selected @endif>{{ $operator->nama_dokter }}</option> --}}
                                        @if (old('operator', $data->operator) == $operator->nama_dokter)
                                            <option value="{{ $operator->nama_dokter }}" selected>
                                                {{ $operator->nama_dokter }}</option>
                                        @else
                                            <option value="{{ $operator->nama_dokter }}">{{ $operator->nama_dokter }}
                                            </option>
                                        @endif
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
                                            @if ($ruang_operasi == $data->ruang_operasi) selected @endif>{{ $ruang_operasi }}
                                        </option>
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
                                            @if ($status == $data->status) selected @endif>{{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endforeach
