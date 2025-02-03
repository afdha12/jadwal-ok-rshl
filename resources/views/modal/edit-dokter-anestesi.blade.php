@foreach ($data as $data)
    <form id="editForm" action="{{ route('dokter-anestesi.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal fade" id="editDokter{{ $data->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Dokter Anestesi</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- <input type="hidden" id="dokterId"> --}}
                        <div class="mb-3">
                            <label for="textTanggal" class="form-label">Tanggal</label>
                            <input type="text" class="form-control" id="tanggal" name="tanggal"
                                value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tanggal)->format('d-m-Y') }}">
                        </div>
                        <div class="mb-3">
                            <label for="textNamaDokter" class="form-label">Dokter Anestesi</label>
                            {{-- <input type="text" class="form-control" id="nama_dokter" name="nama_dokter"> --}}
                            <select name="dokter_id" id="dokter_id" class="form-control required">
                                @foreach ($operators as $operator)
                                    <option value="{{ $operator->id }}" @if ($operator->id == $data->dokter_id) selected @endif>
                                        {{ $operator->nama_dokter }}</option>
                                @endforeach
                                {{-- @foreach ($operators as $operator)
                                    @if (old('dokter_id', $data->nama_dokter) == $operator->nama_dokter)
                                        <option value="{{ $operator->nama_dokter }}" selected>
                                            {{ $operator->nama_dokter }}</option>
                                    @else
                                        <option value="{{ $operator->nama_dokter }}">{{ $operator->nama_dokter }}
                                        </option>
                                    @endif
                                @endforeach --}}
                            </select>
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
