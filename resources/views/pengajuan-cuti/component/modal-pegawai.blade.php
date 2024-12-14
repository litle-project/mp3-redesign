<!-- Modal Atasan Langsung -->
<div class="modal fade" id="showModalPegawai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-3 " style="border: 1px solid #000; border-radius:10px;">
                    <div class="row">
                        <div class="col-3">
                            <div class="row">
                                <div class="col-12 text-center p-2 ms-2" style="border: 1px solid #000;border-radius:10px;">
                                    <span class="fw-bolder text-muted">Foto Profil</span>
                                    <hr class="text-dark mt-2 mb-3">
                                    <img src="{{ asset('img/users/'.($user->foto ?? 'user.png')) }}" width="110px" class="image img d-block mx-auto mb-2" />
                                </div>
                            </div>
                        </div>
                        <div class="col-9 ps-5">
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <span class="d-block fw-bolder text-muted">NIP</span>
                                    <span class="d-block fs-5">{{$data->Users->nip ?? 'N/A'}}</span>
                                </div>
                                <div class="col-lg-6">
                                    <span class="d-block fw-bolder text-muted">NAMA</span>
                                    <span class="d-block fs-5">{{$data->Users->name ?? 'N/A'}}</span>
                                </div>
                            </div>
                            <hr class="text-dark mt-2 mb-3">
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <span class="d-block fw-bolder text-muted">TELEPON</span>
                                    <span class="d-block fs-5">{{$data->Users->nomor_telepon ?? 'N/A'}}</span>
                                </div>
                                <div class="col-lg-6">
                                    <span class="d-block fw-bolder text-muted">EMAIL</span>
                                    <span class="d-block fs-5">{{$data->Users->email ?? 'N/A'}}</span>
                                </div>
                            </div>
                            <hr class="text-dark mt-2 mb-3">
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <span class="d-block fw-bolder text-muted">Jenis Kelamin</span>
                                    <span class="d-block fs-5">{{$data->Users->jenis_kelamin ?? 'N/A'}}</span>
                                </div>
                                <div class="col-lg-6">
                                    <span class="d-block fw-bolder text-muted">Status Pegawai</span>
                                    <span class="badge bg-danger">{{ $data->Users->status_pegawai }}</span>
                                </div>
                            </div>
                        </div>
                        <hr class="text-dark mt-2 mb-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <span class="d-block fw-bolder text-muted">NIK</span>
                                        <span class="d-block fs-5">{{$data->Users->nik ?? 'N/A'}}</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <span class="d-block fw-bolder text-muted">Tempat Lahir</span>
                                        <span class="d-block fs-5">{{ $data->Users->tempat_lahir }}</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <span class="d-block fw-bolder text-muted">Tanggal Lahir</span>
                                        <span class="d-block fs-5">{{ $data->Users->tanggal_lahir }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="text-dark mt-2 mb-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <span class="d-block fw-bolder text-muted">NPWP</span>
                                        <span class="d-block fs-5">{{ $data->Users->npwp }}</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <span class="d-block fw-bolder text-muted">Role</span>
                                        <span class="d-block fs-5">{{ $data->Users->roles->first()->name }}</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <span class="d-block fw-bolder text-muted">Pangkat</span>
                                        <span class="d-block fs-5">{{$data->Users->Pangkats->nama_pangkat ?? 'N/A'}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="text-dark mt-2 mb-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <span class="d-block fw-bolder text-muted">Alamat KTP</span>
                                        <span class="d-block fs-5">{{ $data->Users->alamat_ktp }}</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="d-block fw-bolder text-muted">Alamat Tinggal</span>
                                        <span class="d-block fs-5">{{ $data->Users->alamat_tinggal }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
