<div class="col-lg-12 mt-2">
    <h2 class="fw-bolder">PESETUJUAN CUTI</h2>
    <div class="">
        @foreach ($data->persetujuanCutiDone as $pcd)
            @if ($pcd->position == 'Kabag Tata Usaha')
                <div class="card" style="border:solid 1px black;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <span class="text-muted d-block ">{{date('d F Y',strtotime($pcd->timestamp))}} || {{date('H:i',strtotime($pcd->timestamp))}} </span>
                                <span class="text-dark d-block fs-6 text-default fw-bolder ">{{$pcd->title}}</span>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-lg-3">
                                <span class="text-muted d-block ">Pertimbangan Disiplin</span>
                                <span
                                    class="text-dark d-block fs-6 text-default fw-bolder ">{{$pcd->PersetujuanCutiDetail->pertimbangan_disiplin ?? '-'}}</span></span>
                            </div>
                            <div class="col-lg-9">
                                <span class="text-muted d-block ">Keterangan Permasalahan</span>
                                <span
                                    class="text-dark d-block fs-6 text-default fw-bolder ">{{$pcd->PersetujuanCutiDetail->pertimbangan_disiplin_keterangan ?? '-'}}</span>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-lg-3">
                                <span class="text-muted d-block ">Pekerjaan Terhambat Akibat cuti</span>
                                <span
                                    class="text-dark d-block fs-6 text-default fw-bolder ">{{$pcd->PersetujuanCutiDetail->pekerjaan_terhambat ?? '-'}}</span></span>
                            </div>
                            <div class="col-lg-9">
                                <span class="text-muted d-block ">Keterangan Pekerjaan Terhambat</span>
                                <span
                                    class="text-dark d-block fs-6 text-default fw-bolder ">{{$pcd->PersetujuanCutiDetail->pekerjaan_terhambat_keterangan ?? '-'}}</span>
                            </div>
                            <div class="col-lg-8 mt-2">
                                <span class="text-muted d-block ">Solusi Bagi Pekerjaan Tersebut</span>
                                <span
                                    class="text-dark d-block fs-6 text-default fw-bolder ">{{$pcd->PersetujuanCutiDetail->pekerjaan_terhambat_solusi ?? '-'}}</span>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-8 ">
                                <span class="text-muted d-block ">Pelaksana Harian</span>
                                <span
                                    class="text-dark d-block fs-6 text-default fw-bolder ">{{$pcd->PersetujuanCutiDetail->penunjukkan_pelaksana_harian ?? '-'}}</span>
                                <span
                                    class="text-dark d-block fs-6 text-default fw-bolder ">{{$pcd->PersetujuanCutiDetail->userDitunjuk->name??null}}</span>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-8 ">
                                <span class="text-muted d-block ">Keterangan</span>
                                <span
                                    class="text-dark d-block fs-6 text-default fw-bolder ">{{$pcd->PersetujuanCutiDetail->keterangan ?? '-'}}</span>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                {{-- JIKA ROLE TO NAME KOSONG ADALAH APPROVAL DARI KADISNAV --}}
                @elseif($pcd->role_to_name == '')
                <div class="card" style="border:solid 1px black;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <span class="text-muted d-block ">{{date('d F Y',strtotime($pcd->timestamp))}} || {{date('H:i',strtotime($pcd->timestamp))}} </span>
                                <span class="text-dark d-block fs-6 text-default fw-bolder ">{{$pcd->title}}</span>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-8 ">
                                <span class="text-muted d-block ">Arahan</span>
                                <span
                                    class="text-dark d-block fs-6 text-default fw-bolder ">{{$pcd->PersetujuanCutiDetail->arahan ?? '-'}}</span>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            @else
                <div class="card" style="border:solid 1px black;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <span class="text-muted d-block ">{{date('d F Y',strtotime($pcd->timestamp))}} || {{date('H:i',strtotime($pcd->timestamp))}} </span>
                                <span class="text-dark d-block fs-6 text-default fw-bolder ">{{$pcd->title}}</span>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-lg-3">
                                <span class="text-muted d-block ">Pertimbangan Disiplin</span>
                                <span
                                    class="text-dark d-block fs-6 text-default fw-bolder ">{{$pcd->PersetujuanCutiDetail->pertimbangan_disiplin ?? '-'}}</span></span>
                            </div>
                            <div class="col-lg-9">
                                <span class="text-muted d-block ">Keterangan Permasalahan</span>
                                <span
                                    class="text-dark d-block fs-6 text-default fw-bolder ">{{$pcd->PersetujuanCutiDetail->pertimbangan_disiplin_keterangan ?? '-'}}</span>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-lg-3">
                                <span class="text-muted d-block ">Permasalah Administrasi </span>
                                <span
                                    class="text-dark d-block fs-6 text-default fw-bolder ">{{$pcd->PersetujuanCutiDetail->permasalahan_administrasi_akibatcuti ?? '-'}}</span></span>
                            </div>
                            <div class="col-lg-9">
                                <span class="text-muted d-block ">Keterangan Permasalah Administrasi</span>
                                <span
                                    class="text-dark d-block fs-6 text-default fw-bolder ">{{$pcd->PersetujuanCutiDetail->permasalahan_administrasi_akibatcuti_keterangan ?? '-'}}</span>
                            </div>
                        </div>
                        <hr>

                        <hr>
                        <div class="row">
                            <div class="col-lg-8 ">
                                <span class="text-muted d-block ">Keterangan</span>
                                <span
                                    class="text-dark d-block fs-6 text-default fw-bolder ">{{$pcd->PersetujuanCutiDetail->keterangan ?? '-'}}</span>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            @endif

        @endforeach

    </div>
</div>
