@extends('layouts.app')


@push('styles')
<style>
    .card-1 {
        --animate-duration: 0.5s;
    }

    .card-2 {
        --animate-duration: 0.8s;
    }

    .card-3 {
        --animate-duration: 1.1s;
    }

    .card-4 {
        --animate-duration: 1.4s;
    }

    .card-4 {
        --animate-duration: 1.7s;
    }

    a {
        color: inherit;
    }

    a:hover {
        color: inherit;
        text-decoration: none;
        cursor: pointer;
    }

    .card__one {
        transition: transform .5s;
        cursor: pointer;
    }

    .card__one::after {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        transition: opacity 2s cubic-bezier(.165, .84, .44, 1);
        box-shadow: 0 8px 17px 0 rgba(0, 0, 0, .2), 0 6px 20px 0 rgba(0, 0, 0, .15);
        content: '';
        opacity: 0;
        z-index: -1;
    }

    .card__one:hover,
    .card__one:focus {
        transform: scale3d(1.036, 1.036, 1);
        -webkit-box-shadow: -1px -1px 16px -4px rgba(0, 0, 0, 0.53);
        -moz-box-shadow: -1px -1px 16px -4px rgba(0, 0, 0, 0.53);
        box-shadow: -1px -1px 16px -4px rgba(0, 0, 0, 0.53);


    }

    .text-grey {
        font-size: 14px;
        color: #858585;
    }

</style>



@endpush

@section('content')
<div class="page-content" style="">
    <div class="container-fluid">
        <h4>Management Data Pegawai</h4>
        <hr>
        <div class="row ">
            <div class="col-lg-3">
                <a href="{{route('master-data.user.index')}}">
                    <div class="card shadow-lg card__one animate__animated  animate__fadeInUp card-2">
                        <div class="card-body">
                            <div class="d-flex">
                                <img class="" height="50" src="{{asset('mp3/images/icon/users.png')}}" alt="">
                                <div class="ms-2 mt-1">
                                    <span class="fw-bold fs-6  d-block ">Data Pegawai</span>
                                    <span class="d-block text-grey">
                                        Master data pegawai
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="{{route('master-data.pangkat.index')}}">
                    <div class="card shadow-lg card__one animate__animated  animate__fadeInUp card-2">
                        <div class="card-body">
                            <div class="d-flex">
                                <img class="" height="50" src="{{asset('images/icon/pangkat.png')}}" alt="">
                                <div class="ms-2 mt-1">
                                    <span class="fw-bold fs-6  d-block ">Data Pangkat</span>
                                    <span class="d-block text-grey">
                                        Master data pangkat
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            {{-- <div class="col-lg-3">
                <a href="{{route('master-data.struktur-organisasi.index')}}">
                    <div class="card shadow-lg card__one animate__animated  animate__fadeInUp card-3">
                        <div class="card-body">
                            <div class="d-flex">
                                <img class="" height="50" src="{{asset('mp3/images/icon/role.png')}}" alt="">
                                <div class="ms-2 mt-1">
                                    <span class="fw-bold fs-6  d-block ">List Role</span>
                                    <span class="d-block text-grey">
                                        List data role for user
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div> --}}
            {{-- <div class="col-lg-3 d-none">
                <a href="{{route('master-data.struktur-organisasi.index')}}">
                    <div class="card shadow-lg card__one animate__animated  animate__fadeInUp card-3">
                        <div class="card-body">
                            <div class="d-flex">
                                <img class="" height="50" src="{{asset('mp3/images/icon/role.png')}}" alt="">
                                <div class="ms-2 mt-1">
                                    <span class="fw-bold fs-6  d-block ">Struktur Organisasi</span>
                                    <span class="d-block text-grey">
                                        List data role for user
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div> --}}
            <div class="col-lg-3">
                <a href="{{route('master-data.cuti.index')}}">
                    <div class="card shadow-lg card__one animate__animated  animate__fadeInUp card-3">
                        <div class="card-body">
                            <div class="d-flex">
                                <img class="" height="50" src="{{asset('mp3/images/icon/role.png')}}" alt="">
                                <div class="ms-2 mt-1">
                                    <span class="fw-bold fs-6  d-block ">Cuti</span>
                                    <span class="d-block text-grey">
                                        Master data cuti
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div> <!-- end row-->
        <h4>Master Setup Awal</h4>
        <hr>
        <div class="row ">
            <div class="col-lg-3">
                <a href="{{route('master-data.setup-jam-kerja.index')}}">
                    <div class="card shadow-lg card__one animate__animated  animate__fadeInUp card-3">
                        <div class="card-body">
                            <div class="d-flex">
                                <img class="" height="50" src="{{asset('mp3/images/icon/clock.png')}}" alt="">
                                <div class="ms-2 mt-1">
                                    <span class="fw-bold fs-6  d-block ">Jam Kerja</span>
                                    <span class="d-block text-grey">
                                        Master jam kerja
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="{{route('master-data.setup-shift.index')}}">
                    <div class="card shadow-lg card__one animate__animated  animate__fadeInUp card-3">
                        <div class="card-body">
                            <div class="d-flex">
                                <img class="" height="50" src="{{asset('mp3/images/icon/shift.png')}}" alt="">
                                <div class="ms-2 mt-1">
                                    <span class="fw-bold fs-6  d-block ">Shift dan Instalasi</span>
                                    <span class="d-block text-grey">
                                        Master shift dan instalasi
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="{{route('master-data.instalasi.index')}}">
                    <div class="card shadow-lg card__one animate__animated  animate__fadeInUp card-3">
                        <div class="card-body">
                            <div class="d-flex">
                                <img class="" height="50" src="{{asset('mp3/images/icon/repair.png')}}" alt="">
                                <div class="ms-2 mt-1">
                                    <span class="fw-bold fs-6  d-block ">Instalasi</span>
                                    <span class="d-block text-grey">
                                        Master instalasi
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="{{route('master-data.libur-nasional.index')}}">
                    <div class="card shadow-lg card__one animate__animated  animate__fadeInUp card-3">
                        <div class="card-body">
                            <div class="d-flex">
                                <img class="" height="50" src="{{asset('images/icon/dates.png')}}" alt="">
                                <div class="ms-2 mt-1">
                                    <span class="fw-bold fs-6  d-block ">Libur Nasional</span>
                                    <span class="d-block text-grey">
                                        Master libur nasional
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div> <!-- end row-->

        {{-- <div class="row">
            <div class="col-lg-3">
                <a href="{{route('master-data.koordinat-kantor.index')}}">
                    <div class="card shadow-lg card__one animate__animated  animate__fadeInUp card-3">
                        <div class="card-body">
                            <div class="d-flex">
                                <img class="" height="50" src="{{asset('mp3/images/icon/land.png')}}" alt="">
                                <div class="ms-2 mt-1">
                                    <span class="fw-bold fs-6  d-block ">Koordinat Kantor</span>
                                    <span class="d-block text-grey">
                                        Master koordinat kantor
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div> --}}
    </div>
    <!-- container-fluid -->
</div>
@endsection
