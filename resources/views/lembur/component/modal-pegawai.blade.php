<!-- Modal Atasan Langsung -->
<div class="modal fade" id="showModalPegawai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Pegawai</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        @foreach ($data->Users as $p)
        <div class="row">
            <div class="col-lg-3">
                <span class="d-block fw-bolder text-muted">NIK</span>
                <span class="d-block fs-5">{{$p->nik ?? 'N/A'}}</span>
            </div>
            <div class="col-lg-3 mb-3 ">
                <span class="d-block fw-bolder text-muted">NAMA</span>
                <span class="d-block fs-5">{{$p->name ?? 'N/A'}}</span>

            </div>
            <div class="col-lg-3 mb-3">
                <span class="d-block fw-bolder text-muted">TELEPON</span>
                <span class="d-block fs-5">{{$p->nomor_telepon ?? 'N/A'}}</span>

            </div>
            <div class="col-lg-3 mb-3">
                <span class="d-block fw-bolder text-muted">EMAIL</span>
                <span class="d-block fs-5">{{$p->email ?? 'N/A'}}</span>
            </div>
            
          </div>
          @endforeach
      </div>
    </div>
  </div>
</div>

