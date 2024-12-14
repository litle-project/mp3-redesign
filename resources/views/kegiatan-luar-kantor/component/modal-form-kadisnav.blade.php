<!-- Modal Atasan Langsung -->
<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tindak Lanjut Atasan Langsung</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('master-data.kegiatan-luar-kantor.approval-kadisnav',$data->id)}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="" class="fw-bolder">Persetujuan</label>
                        <select name="persetujuan" class="form-select" id="">
                            <option value="Setuju">Setuju</option>
                            <option value="Tolak">Tolak</option>
                        </select>
                    </div>


                    <div class="form-group mb-2">
                        <label for="" class="fw-bolder">Arahan</label>
                        <textarea name="arahan" class="form-control" id="" cols="30" rows="3"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tindak Lanjut</button>
                </div>
            </form>
        </div>
    </div>
</div>
