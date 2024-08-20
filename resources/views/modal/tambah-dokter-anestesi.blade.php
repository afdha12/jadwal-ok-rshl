<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('dokter-anestesi.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Jadwal Anestesi</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="textTanggal" class="form-label">Tanggal</label>
                            <input type="text" class="form-control" id="tanggal" name="tanggal">
                        </div>
                        <div class="mb-3">
                            <label for="textNamaDokter" class="form-label">Dokter Anestesi</label>
                            {{-- <input type="text" class="form-control" id="nama_dokter" name="nama_dokter"> --}}
                            <select name="nama_dokter" id="nama_dokter" class="form-control required">
                                @foreach ($operators as $operator)
                                    <option value="{{ $operator->nama_dokter }}">{{ $operator->nama_dokter }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>