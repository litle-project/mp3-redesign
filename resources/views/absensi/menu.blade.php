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

    .card:hover {
        transform: scale(1.02) !important;
    }
    .stats-box {
        background-color: #f7f7f7;
        border: 1px solid #e3e3e3;
        padding: 5px;
    }
    .rounded20{
        border-radius: 10px;
    }
    a.disabled {
       pointer-events: none;
       cursor: default;
    }
    .bg-disabled{
        background-color: #e2e5e8 !important;
        color: black !important;
    }

</style>
@endpush

@section('content')
<div class="page-content" style="">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-8 col-xl-8 mb-3">
                <p class=" fw-bolder head-title text-uppercase"> <b>{{$page_title}}</b></p>
                <span>Status : {{$shift}}</span>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-2">
                <div class="stats-box text-center p-4 rounded20 mb-2">
                    <h6 class="text-dark tx-digital" id="timeRealtime">-</h6>
                </div>
            </div>
            <hr>

            @if ($shift == 'Jam Kerja Kantor')
            <div class="col-lg-4">
                <a href="{{route('absensi.work-from-office.index')}}">
                    <div class="card shadow-lg card__one animate__animated  animate__fadeInUp card-2" style="height: 14.5rem">
                        <div class="card-body mx-auto" style="padding-top:40px">
                            <img class="img d-block mx-auto" height="100" src="{{asset('mp3/images/icon/office1.png')}}" alt="">
                            <div class="ms-2 mt-1 text-center">
                                <span class="fw-bold  d-block" style="font-size: 24px; padding-top: 10px;">Work From Office</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @else
            <div class="col-lg-4">
                <a href="#">
                    <div class="card shadow-lg bg-disabled card__one animate__animated  animate__fadeInUp card-2" style="height: 14.5rem;">
                        <div class="card-body mx-auto" style="padding-top:40px">
                            <img class="img d-block mx-auto" height="100" src="{{asset('mp3/images/icon/office1.png')}}" alt="">
                            <div class="ms-2 mt-1">
                                <span class="fw-bold d-block" style="font-size: 24px; padding-top: 10px;">Work From Office</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endif

            @if ($shift == 'Jam Kerja Kantor')
            <div class="col-lg-4">
                <a href="{{route('absensi.work-from-home.index')}}">
                    <div class="card shadow-lg card__one animate__animated  animate__fadeInUp card-2" style="height: 14.5rem">
                        <div class="card-body mx-auto" style="padding-top:40px">
                            <img class="img d-block mx-auto" height="100" src="{{asset('mp3/images/icon/house.png')}}" alt="">
                            <div class="ms-2 mt-1">
                                <span class="fw-bold d-block" style="font-size: 24px; padding-top: 10px;">Work From Home</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @else
            <div class="col-lg-4">
                <a href="#">
                    <div class="card shadow-lg bg-disabled card__one animate__animated  animate__fadeInUp card-2" style="height: 14.5rem">
                        <div class="card-body mx-auto" style="padding-top:40px">
                            <img class="img d-block mx-auto" height="100" src="{{asset('mp3/images/icon/house.png')}}" alt="">
                            <div class="ms-2 mt-1">
                                <span class="fw-bold d-block" style="font-size: 24px; padding-top: 10px;">Work From Home</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endif

            @if ($shift == 'Shift Instalation')
            <div class="col-lg-4" id="absensi-instalation">
                <a href="{{route('absensi.work-from-instalation.index')}}">
                    <div class="card shadow-lg card__one animate__animated  animate__fadeInUp card-2" style="height: 14.5rem">
                        <div class="card-body mx-auto" style="padding-top:40px">
                            <img class="img d-block mx-auto" height="100" src="{{asset('mp3/images/icon/office1.png')}}" alt="">
                            <div class="ms-2 mt-1 text-center">
                                <span class="fw-bold d-block" style="font-size: 22px; padding-top: 10px;">Work From Instalation</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @else
            <div class="col-lg-4" id="absensi-instalation">
                <a href="#">
                    <div class="card shadow-lg bg-disabled card__one animate__animated  animate__fadeInUp card-2" style="height: 14.5rem">
                        <div class="card-body mx-auto" style="padding-top:40px">
                            <img class="img d-block mx-auto" height="100" src="{{asset('mp3/images/icon/office1.png')}}" alt="">
                            <div class="ms-2 mt-1 text-center">
                                <span class="fw-bold d-block" style="font-size: 22px; padding-top: 10px;">Work From Instalation</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endif
        </div> <!-- end row-->

        <div class="row ">
            @if ($shift == 'Kegiatan Luar Kantor')
            <div class="col-lg-4">
                <a href="{{route('absensi.kegiatan-luar-kantor.index')}}">
                    <div class="card shadow-lg card__one animate__animated  animate__fadeInUp card-2" style="height: 14.5rem">
                        <div class="card-body mx-auto" style="padding-top:40px">
                            <img class="img d-block mx-auto" height="100" src="{{asset('mp3/images/icon/skyscraper.png')}}" alt="">
                            <div class="ms-2 mt-1">
                                <span class="fw-bold d-block" style="font-size: 24px; padding-top: 10px;">Kegiatan Luar Kantor</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @else
            <div class="col-lg-4">
                <a href="#">
                    <div class="card shadow-lg bg-disabled card__one animate__animated  animate__fadeInUp card-2" style="height: 14.5rem">
                        <div class="card-body mx-auto" style="padding-top:40px">
                            <img class="img d-block mx-auto" height="100" src="{{asset('mp3/images/icon/skyscraper.png')}}" alt="">
                            <div class="ms-2 mt-1">
                                <span class="fw-bold d-block" style="font-size: 24px; padding-top: 10px;">Kegiatan Luar Kantor</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endif

            @if ($shift == 'Dinas Luar Kota')
            <div class="col-lg-4">
                <a href="{{route('absensi.dinas-luar-kota.index')}}">
                    <div class="card shadow-lg card__one animate__animated  animate__fadeInUp card-2" style="height: 14.5rem">
                        <div class="card-body mx-auto" style="padding-top:40px">
                            <img class="img d-block mx-auto" height="100" src="{{asset('mp3/images/icon/architecture-and-city.png')}}" alt="">
                            <div class="ms-2 mt-1">
                                <span class="fw-bold d-block" style="font-size: 24px; padding-top: 10px;">Dinas Luar Kota</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @else
            <div class="col-lg-4">
                <a href="#">
                    <div class="card shadow-lg bg-disabled card__one animate__animated  animate__fadeInUp card-2" style="height: 14.5rem">
                        <div class="card-body mx-auto" style="padding-top:40px">
                            <img class="img d-block mx-auto" height="100" src="{{asset('mp3/images/icon/architecture-and-city.png')}}" alt="">
                            <div class="ms-2 mt-1">
                                <span class="fw-bold d-block" style="font-size: 24px; padding-top: 10px;">Dinas Luar Kota</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endif

            {{-- @if ($shift == 'Lembur') --}}
            <div class="col-lg-4">
                <a href="{{route('absensi.lembur.index')}}">
                    <div class="card shadow-lg card__one animate__animated  animate__fadeInUp card-2" style="height: 14.5rem">
                        <div class="card-body mx-auto" style="padding-top:40px">
                            <img class="img d-block mx-auto" height="100" src="{{asset('mp3/images/icon/skyscraper.png')}}" alt="">
                            <div class="ms-2 mt-1">
                                <span class="fw-bold  d-block" style="font-size: 24px; padding-top: 10px;">Lembur</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            {{-- @else
            <div class="col-lg-4">
                <a href="#">
                    <div class="card shadow-lg bg-disabled card__one animate__animated  animate__fadeInUp card-2" style="height: 14.5rem">
                        <div class="card-body mx-auto" style="padding-top:40px">
                            <img class="img d-block mx-auto" height="100" src="{{asset('mp3/images/icon/skyscraper.png')}}" alt="">
                            <div class="ms-2 mt-1">
                                <span class="fw-bold  d-block" style="font-size: 24px; padding-top: 10px;">Lembur</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endif --}}
        </div> <!-- end row-->
    </div>
    <!-- container-fluid -->
</div>
@endsection

@push('scripts')
    <script>
        timeNow();
        setInterval(() => {
             timeNow();
            }, 1000);
        function timeNow() {
            let now = moment().format('HH : mm : ss');
            $('#timeRealtime').text(now);
        }
    </script>
@endpush
