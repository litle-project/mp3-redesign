@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">

<style>
    .animated-bounce {
        animation: bounceInDown;
        /* referring directly to the animation's @keyframe declaration */
        animation-duration: 2s;
        /* don't forget to set a duration! */
    }
    .font-number-lg {
        font-size: 40px !important;
    }

    .font-number-md {
        font-size: 20px !important;
    }

    .custome-position {
        position: relative;
        top: 60px;
        left: 0;
        right: 0;
        bottom: 0;
    }

    .custome-position-2 {
        position: relative;
        top: 50px;
        left: 0;
        right: 0;
        bottom: 0;
    }

    .border-radius {
        border-radius: 20px;
    }

    .img-home {
        border-radius: 20px;
        max-width: 80vh;
        min-width: 50vh;
    }

    .grootech-section-x .content-x {
        padding: 30px 0px !important;
    }

    .pb-70 {
        padding-bottom: 70px;
    }

    .carousel-control-prev {
        opacity: 1 !important;
        left: 50px;
        background: none;
        width: 50px;
        top: 43rem;
    }

    .carousel-control-next {
        opacity: 1 !important;
        right: 50px;
        background: none;
        width: 30px;
        top: 43rem;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 40px;
        outline: black;
    }

    .carousel-control-next-icon:after {
        content: 'Next';
        font-size: 18px;
        color: #000;
    }

    .carousel-control-prev-icon:after {
        content: 'Prev';
        font-size: 18px;
        color: #000;
    }


    .slicker>.slick-prev:before,
    .slicker>.slick-next:before {
        font-size: 40px;
        line-height: 1;
        opacity: 1;
        /* color: #000; */
        /* background-color: #fff; */
        -webkit-font-smoothing: antialiased;
        /* -moz-osx-font-smoothing: grayscale; */
    }

    .slicker>.slick-next {
        right: 0px !important;
        width: 60px;
    }

    .slicker>.slick-prev {
        left: -10px !important;
        z-index: 1;
        width: 60px;
        background: none;
    }

    .text-left {
        text-align: left;
    }

    .page-item.active .page-link {
        background-color: #2B7EC4 !important;
        color: #fff !important;
    }

    .page-link {
        padding: 0.375rem 1rem !important;
    }

    .fluid-img {
        width: 100% !important;
        height: auto !important;
        text-align: center;
    }

    .fluid-img-carousel {
        width: 100% !important;
        height: auto !important;
        text-align: center;
    }

</style>
@endpush

@section('content')
<div class="page-content" style="">
    <div class="container-fluid">
        <div class="row d-flex justify-content-between">
            <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xl-8">
                <p class="fw-bolder text-uppercase">Berita dan Pengumuman</p>
            </div>
            <div class="col-12 col-sm-12 col-md-5 col-lg-4 col-xl-4">
                <div class="text-lg-end text-sm-start">
                    <span>{{ $dateNowID }}</span>
                </div>
            </div>
            <hr>
        </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-5">
            <div class="row">
                <div class="col-12">
                    <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($beritas as $key => $item)
                            <div class="carousel-item {{ ($key == 0 ? 'active' : '') }}">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="card">
                                            <img class="img-fluid" style="border-radius: 20px 20px 0px 0px;" alt="100%x280" src="{{ $item->gambar }}">
                                            <div class="card-body">
                                                {{-- <small>{{ date('D, d M Y', strtotime($item->created_at)) }} | Admin</small> --}}
                                                <small>{{ \Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('dddd, D MMMM Y') }} | Admin</small>
                                                <h4 class="card-title mt-2">{{ $item->judul }}</h4>
                                                <p class="card-text mt-3">{{ $item->isi }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a class="btn btn-primary mb-3 mr-3" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                    <i class="fa fa-arrow-left"></i>
                </a>
                <a class="btn btn-primary mb-3 " href="#carouselExampleIndicators2" role="button" data-slide="next">
                    <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-7">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="card animated-bounce" style="border-radius: 10px !important; background:#0070D2;">
                        <div class="card-body d-flex flex-column gap-3">
                            <h6 class="text-white">Total Pegawai</h6>
                            <div class="d-flex flex-wrap justify-content-between p-2" style="border: 1px white solid; border-radius: 15px; background-color: rgb(255 255 255 / 0.2);">
                                <div class="d-flex gap-1 align-items-center pt-1">
                                    <span class="text-white fw-bolder font-number-lg">{{ $pns }}</span>
                                    <span class="text-white mt-1" style="font-weight: 500; font-size:16px;">PNS</span>
                                </div>

                                <div class="d-flex gap-1 align-items-center pt-1">
                                    <span class="text-white fw-bolder font-number-lg">{{ $PPnPN }}</span>
                                    <span class="text-white mt-1" style="font-weight: 500; font-size:16px;">PPnPN</span>
                                </div>
                            </div>
                            <div class="d-flex gap-3">
                                <div class="d-flex flex-column w-100 p-2" style="border: 1px white solid; border-radius: 15px; background-color: rgb(255 255 255 / 0.2);">
                                    <div class="d-flex justify-content-center py-1">
                                        <img src="{{asset('mp3/images/icon/Man.svg')}}">
                                    </div>
                                    <span class="text-white text-center fw-bolder" style="font-size:24px;">{{ $male }}</span>
                                    <span class="text-white text-center fw-bold" style="font-size:16px;"> Pegawai Pria</span>
                                </div>
                                <div class="d-flex flex-column w-100 p-2" style="border: 1px white solid; border-radius: 15px; background-color: rgb(255 255 255 / 0.2);">
                                    <div class="d-flex justify-content-center py-1">
                                        <img src="{{asset('mp3/images/icon/Woman.svg')}}">
                                    </div>
                                    <span class="text-white text-center fw-bolder" style="font-size:24px;">{{ $female }}</span>
                                    <span class="text-white text-center fw-bold" style="font-size:16px;"> Pegawai Wanita</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="card animated-bounce py-2" style="border-radius: 10px !important;">
                        <div class="card-body d-flex flex-column gap-3">
                            <h6>Total Pegawai Bekerja di Kantor Hari Ini</h6>
                            <div class="d-flex flex-column gap-3">
                                <div class="d-flex gap-3 align-items-center p-3" style="border: 1px solid #0070D2; border-radius: 15px; color: #0070D2; background-color: rgb(0 112 210 / 0.2);">
                                    <img src="{{asset('mp3/images/icon/Man-blue.svg')}}">
                                    <span class="fw-bolder" style="font-size: 36px;">{{ $male_dikantor }}</span>
                                    <span style="font-weight: 500; font-size:16px;"> Pegawai Pria</span>
                                </div>
                                <div class="d-flex gap-3 align-items-center p-3" style="border: 1px solid #0070D2; border-radius: 15px; color: #0070D2; background-color: rgb(0 112 210 / 0.2);">
                                    <img src="{{asset('mp3/images/icon/Woman-blue.svg')}}" alt="">
                                    <span class="fw-bolder" style="font-size: 36px;">{{ $female_dikantor }}</span>
                                    <span style="font-weight: 500; font-size:16px;"> Pegawai Wanita</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="card animated-bounce py-2" style="border-radius: 10px !important;">
                        <div class="card-body d-flex flex-column gap-3">
                            <h6>Total Pegawai Bekerja di Instalasi Hari Ini</h6>
                            <div class="d-flex flex-column gap-3">
                                <div class="d-flex gap-3 align-items-center p-3" style="border: 1px solid #0070D2; border-radius: 15px; color: #0070D2; background-color: rgb(0 112 210 / 0.2);">
                                    <img src="{{asset('mp3/images/icon/Man-blue.svg')}}">
                                    <span class="fw-bolder" style="font-size: 36px;">{{ $male_instalasi }}</span>
                                    <span style="font-weight: 500; font-size:16px;"> Pegawai Pria</span>
                                </div>
                                <div class="d-flex gap-3 align-items-center p-3" style="border: 1px solid #0070D2; border-radius: 15px; color: #0070D2; background-color: rgb(0 112 210 / 0.2);">
                                    <img src="{{asset('mp3/images/icon/Woman-blue.svg')}}" alt="">
                                    <span class="fw-bolder" style="font-size: 36px;">{{ $female_instalasi }}</span>
                                    <span style="font-weight: 500; font-size:16px;"> Pegawai Wanita</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="card animated-bounce py-2" style="border-radius: 10px !important;">
                        <div class="card-body d-flex flex-column gap-3">
                            <h6>Total Pegawai Cuti Hari Ini</h6>
                            <div class="d-flex flex-column gap-3">
                                <div class="d-flex gap-3 align-items-center p-3" style="border: 1px solid #0070D2; border-radius: 15px; color: #0070D2; background-color: rgb(0 112 210 / 0.2);">
                                    <img src="{{asset('mp3/images/icon/Man-blue.svg')}}">
                                    <span class="fw-bolder" style="font-size: 36px;">{{ $male_cuti }}</span>
                                    <span style="font-weight: 500; font-size:16px;"> Pegawai Pria</span>
                                </div>
                                <div class="d-flex gap-3 align-items-center p-3" style="border: 1px solid #0070D2; border-radius: 15px; color: #0070D2; background-color: rgb(0 112 210 / 0.2);">
                                    <img src="{{asset('mp3/images/icon/Woman-blue.svg')}}" alt="">
                                    <span class="fw-bolder" style="font-size: 36px;">{{ $female_cuti }}</span>
                                    <span style="font-weight: 500; font-size:16px;"> Pegawai Wanita</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="card animated-bounce py-2" style="border-radius: 10px !important;">
                        <div class="card-body d-flex flex-column gap-3">
                            <h6>Total Pegawai Dinas Luar Kota Hari Ini</h6>
                            <div class="d-flex flex-column gap-3">
                                <div class="d-flex gap-3 align-items-center p-3" style="border: 1px solid #0070D2; border-radius: 15px; color: #0070D2; background-color: rgb(0 112 210 / 0.2);">
                                    <img src="{{asset('mp3/images/icon/Man-blue.svg')}}">
                                    <span class="fw-bolder" style="font-size: 36px;">{{ $male_dinas }}</span>
                                    <span style="font-weight: 500; font-size:16px;"> Pegawai Pria</span>
                                </div>
                                <div class="d-flex gap-3 align-items-center p-3" style="border: 1px solid #0070D2; border-radius: 15px; color: #0070D2; background-color: rgb(0 112 210 / 0.2);">
                                    <img src="{{asset('mp3/images/icon/Woman-blue.svg')}}" alt="">
                                    <span class="fw-bolder" style="font-size: 36px;">{{ $female_dinas }}</span>
                                    <span style="font-weight: 500; font-size:16px;"> Pegawai Wanita</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="card animated-bounce py-2" style="border-radius: 10px !important; background-color: #FF6C6C">
                        <div class="card-body d-flex flex-column gap-3">
                            <span class="text-white" style="font-size:14px;">Total Pegawai Tidak Melakukan Absensi Hari Ini</span>
                            <div class="d-flex flex-column gap-3">
                                <div class="d-flex gap-3 align-items-center p-3" style="border: 1px solid white; border-radius: 15px; background-color: rgb(255 255 255 / 0.2);">
                                    <img src="{{asset('mp3/images/icon/Man.svg')}}">
                                    <span class="text-white fw-bolder" style="font-size: 36px;">{{ $male_tidak_absen }}</span>
                                    <span class="text-white" style="font-weight: 500; font-size:16px;"> Pegawai Pria</span>
                                </div>
                                <div class="d-flex gap-3 align-items-center p-3" style="border: 1px solid white; border-radius: 15px; background-color: rgb(255 255 255 / 0.2);">
                                    <img src="{{asset('mp3/images/icon/Woman.svg')}}" alt="">
                                    <span class="text-white fw-bolder" style="font-size: 36px;">{{ $female_tidak_absen }}</span>
                                    <span class="text-white" style="font-weight: 500; font-size:16px;"> Pegawai Wanita</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- end page title -->
@endsection

@push('scripts')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endpush
