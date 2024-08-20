@foreach ($data as $data)
    <form id="editForm" action="{{ route('dokter.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal fade" id="editDokter{{ $data->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Dokter</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="textNamaDokter" class="form-label">Dokter Anestesi</label>
                            <input type="text" class="form-control" id="nama_dokter" name="nama_dokter">
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
