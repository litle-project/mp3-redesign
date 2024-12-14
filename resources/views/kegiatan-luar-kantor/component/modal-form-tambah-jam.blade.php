<!-- Modal Atasan Langsung -->
<div class="modal fade" id="showModalTambahJam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Jam</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('master-data.kegiatan-luar-kantor.tambah-jam',$data->id)}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="" class="fw-bolder">Tambahan Jam</label>
                        <select name="tambahan_jam" class="form-select" id="">
                            <option value="1">1 Jam</option>
                            <option value="2">2 Jam</option>
                            <option value="3">3 Jam</option>
                            <option value="4">4 Jam</option>
                            <option value="5">5 Jam</option>
                            <option value="6">6 Jam</option>
                            <option value="7">7 Jam</option>
                            <option value="8">8 Jam</option>
                            <option value="9">9 Jam</option>
                            <option value="10">10 Jam</option>
                            <option value="11">11 Jam</option>
                            <option value="12">12 Jam</option>
                        </select>
                    </div>


                    <div class="form-group mb-2">
                        <label for="" class="fw-bolder">Keterangan</label>
                        <textarea name="keterangan" class="form-control" id="" cols="30" rows="3"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Tutup</button>
                    <button type="submit" class="btn btn-primary">Ajukan</button>
                </div>
            </form>
        </div>
    </div>
</div>
