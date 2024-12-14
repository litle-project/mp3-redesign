<!-- Modal Atasan Langsung -->
<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tindak Lanjut Atasan Langsung</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('persetujuan-cuti.atasan-langsung',$data->id)}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="" class="fw-bolder">Persetujuan Cuti Atasan Langsung</label>
                        <select name="status" class="form-select" id="">
                            <option value="Disetujui">Disetujui</option>
                            <option value="Ditolak">Ditolak</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="" class="fw-bolder">Pertimbangan Atas Disiplin dan Kinerja Pegawai
                            Bersangkutan</label>
                        <div class="row">
                            <div class="col-lg-2">
                                <input class="" type="radio" id="Baik" name="pertimbangan_disiplin" value="Baik">
                                <label for="Baik">Baik</label>
                            </div>
                            <div class="col-lg-2">
                                <input class="" type="radio" id="Cukup" name="pertimbangan_disiplin" value="Cukup">
                                <label for="Cukup">Cukup</label>
                            </div>
                            <div class="col-lg-2">
                                <input class="" type="radio" id="Bermasalah" name="pertimbangan_disiplin"
                                    value="Bermasalah">
                                <label for="Bermasalah">Bermasalah</label>
                            </div>
                            <div class="col-lg-6">
                                <textarea name="pertimbangan_disiplin_keterangan" class="form-control" id="" cols="30" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="" class="fw-bolder">Pekerjaan Terhambat Akibat Cut</label>
                        <div class="row">
                            <div class="col-lg-12 mb-1">
                                <input class="" type="radio" id="Ada" name="pekerjaan_terhambat" value="Ada">
                                <label for="Ada">Ada</label>
                                <div class="ps-4">
                                    <div class="form-group">
                                        <label for="" cla>Keterangan</label>
                                        <textarea name="pekerjaan_terhambat_keterangan" class="form-control" cols="30"
                                            rows="2"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="fw-bolder">Solusi Bagi Pekerjaan Tersebut</label>
                                        <textarea name="pekerjaan_terhambat_solusi" class="form-control" cols="30"
                                            rows="2"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <input class="" type="radio" id="TidakAda" name="pekerjaan_terhambat" value="Tidak Ada">
                                <label for="TidakAda">Tidak Ada</label>
                            </div>

                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="" class="fw-bolder">Penunjukkan Pelaksana Harian</label>
                        <div class="row">
                            <div class="col-lg-12 mb-1">
                                <input class="" type="radio" id="Perlu" name="penunjukkan_pelaksana_harian"
                                    value="Perlu">
                                <label for="Perlu">Perlu</label>
                                <div class="ps-4">
                                    <div class="form-group">
                                        <select name="penunjukkan_pelaksana_harian_id" class="form-control" id="">
                                            <option value="">--- PILIH PEGAWAI PENGGANTI</option>
                                            @foreach ($users as $p)
                                            <option value="{{$p->id}}">{{$p->name}}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <input class="" type="radio" id="TidakPerlu" name="penunjukkan_pelaksana_harian"
                                    value="Tidak Perlu">
                                <label for="TidakPerlu">Tidak Perlu</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="" class="fw-bolder">Keterangan</label>
                        <textarea name="keterangan" class="form-control" id="" cols="30" rows="3"></textarea>
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
