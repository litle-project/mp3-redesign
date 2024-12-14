<!-- Modal Atasan Langsung -->
<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tindak Lanjut KADISNAV</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('persetujuan-cuti.kadisnav',$data->id)}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="" class="fw-bolder">Persetujuan Cuti Kadisnav</label>
                        <select name="status" class="form-select" id="">
                            <option value="Disetujui">Disetujui</option>
                            <option value="Ditolak">Ditolak</option>
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
