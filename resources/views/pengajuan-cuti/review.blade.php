@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="{{asset('mp3/libs/swiper/swiper-bundle.min.css')}}">
<link rel="stylesheet" href="{{asset('mp3/css/hori.min.css')}}">
<style>
     .hori-timeline .event-list::before {
        background-color: #70BF44 !important;
    }

    .hori-timeline .event-list:after {
        width: 30px !important;
        height: 30px !important;
        background-color: #0BB97A !important;
        border: 5px solid #fff;
        border-radius: 50%;
        top: -7px !important;
        left: 11% !important;
        -webkit-transform: translateX(-50%);
        transform: translateX(-50%);
        display: block;
    }
</style>
@endpush

@section('content')
<div class="page-content">
    <div class="row animate__animated  animate__fadeIn">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header justify-content-between d-flex align-items-center">
                    <h4 class="card-title">{{$page_title}}</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-lg-6">
                            <p class="fs-5">{{$data->nomor_permohonan}}</p>


                        </div>
                        <div class="col-lg-6">
                            <div class="float-end">
                                @if ($data->status=='Disetujui')
                                    <span class="text-success fs-3">{{$data->status}}</span>
                                @elseif($data->status=='Ditolak')
                                    <span class="text-danger fs-3">{{$data->status}}</span>
                                @else
                                    <span class="text-warning fs-3">{{$data->status}}</span>
                                @endif
                                 @if ($data->status == 'Disetujui')
                                    <a href="{{route('pengajuan-cuti.surat-izin-pdf',$data->id)}}"><button class="btn btn-lg btn-outline-danger"><i class="fa fa-file-pdf"></i> Surat Izin Cuti</button></a>
                                @endif

                                @if (($data->persetujuanTerakhir()->role_to_name ?? null) == (Auth::user()->roles->first()->name ?? null))
                                    <button class="btn btn-lg btn-dark " data-bs-toggle="modal" data-bs-target="#showModal">TINDAK LANJUT</button>
                                @endif
                            </div>
                        </div>

                        {{-- TIMELINE --}}
                            @include('pengajuan-cuti.component.review-timeline')
                        <div class="row">
                            <div class="col-3">
                                <button class="btn btn-lg btn-outline-dark" data-bs-toggle="modal" data-bs-target="#showModalPegawai"><i class="fa fa-eye"> </i> DATA PEGAWAI</button>
                            </div>
                        </div>
                        {{-- INFO PERCUTIAN --}}
                        @include('pengajuan-cuti.component.info-status-cuti')

                        {{-- DETAIL PENGAJUAN CUTI --}}
                        <div class="col-lg-12 mt-2">
                            <hr>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <span class="text-muted d-block fs-6 ">Perihal Cuti</span>
                                    <span class="text-default fw-bolder d-block fs-6">{{$data->perihal_cuti}}</span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <span class="text-muted d-block fs-6 ">Tanggal Mulai Cuti</span>
                                    <span class="text-default fw-bolder d-block fs-6">{{$data->tanggal_mulai_cuti}}</span>
                                </div>
                                <div class="col-lg-4">
                                    <span class="text-muted d-block fs-6 ">Tanggal Selesai Cuti</span>
                                    <span class="text-default fw-bolder d-block fs-6">{{$data->tanggal_selesai_cuti}}</span>
                                </div>
                                <div class="col-lg-4">
                                    <span class="text-muted d-block fs-6 ">Total Hari Cuti</span>
                                    <span class="text-default fw-bolder d-block fs-6">{{$data->total_hari_cuti}}</span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <span class="text-muted d-block  fs-6 ">Alamat Pemohon Ketika Cuti</span>
                                    <span class="text-default fw-bolder d-block fs-6">{{$data->alamat_pemohon}}</span>
                                </div>
                                <div class="col-lg-8">
                                    <span class="text-muted d-block fs-6 ">Nomor Telepon Darurat (Bisa Dihubungi Ketika Cuti)</span>
                                    <span class="text-default fw-bolder d-block fs-6">{{$data->nomor_telepon_darurat}}</span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <span class="text-muted d-block fs-6 ">Keterangan</span>
                                    <span class="text-default fw-bolder d-block fs-6">{{$data->keterangan}}</span>
                                </div>
                            </div>
                        </div>


                        {{-- PERSETUJUAN CUTI --}}
                        @include('pengajuan-cuti.component.persetujuan-cuti')
                    </div>


                </div>
            </div>
        </div>
    </div>

    <!-- end row -->

</div> <!-- container-fluid -->
</div>
@endsection

@push('modals')
@include('pengajuan-cuti.component.modal-pegawai')

{{-- FILTER MODAL TINDAK LANJUT --}}
@if (($data->persetujuanTerakhir()->position ?? null) =='Atasan Langsung')
    @include('pengajuan-cuti.component.modal-form-atasan-langsung')
@elseif (($data->persetujuanTerakhir()->position ?? null) =='Kabag Tata Usaha')
    @include('pengajuan-cuti.component.modal-form-kabagtu')
@elseif (($data->persetujuanTerakhir()->position ?? null) =='Kepala Distrik Navigasi')
    @include('pengajuan-cuti.component.modal-form-kadisnav')
@endif

@endpush

@push('scripts')

<!-- timeline init -->
<script src="{{asset('mp3/libs/swiper/swiper-bundle.min.js')}}"></script>
<script src="{{asset('mp3/js/pages/timeline.init.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.js-example-basic-multiple').select2();
    });
</script>

<script>
   function calcBusinessDays(dDate1, dDate2) { // input given as Date objects
    var iWeeks, iDateDiff, iAdjust = 0;
    if (dDate2 < dDate1) return -1; // error code if dates transposed
    var iWeekday1 = dDate1.getDay(); // day of week
    var iWeekday2 = dDate2.getDay();
    iWeekday1 = (iWeekday1 == 0) ? 7 : iWeekday1; // change Sunday from 0 to 7
    iWeekday2 = (iWeekday2 == 0) ? 7 : iWeekday2;
    if ((iWeekday1 > 5) && (iWeekday2 > 5)) iAdjust = 1; // adjustment if both days on weekend
    iWeekday1 = (iWeekday1 > 5) ? 5 : iWeekday1; // only count weekdays
    iWeekday2 = (iWeekday2 > 5) ? 5 : iWeekday2;

    // calculate differnece in weeks (1000mS * 60sec * 60min * 24hrs * 7 days = 604800000)
    iWeeks = Math.floor((dDate2.getTime() - dDate1.getTime()) / 604800000)

    if (iWeekday1 < iWeekday2) { //Equal to makes it reduce 5 days
        iDateDiff = (iWeeks * 5) + (iWeekday2 - iWeekday1)
    } else {
        iDateDiff = ((iWeeks + 1) * 5) - (iWeekday1 - iWeekday2)
    }

    iDateDiff -= iAdjust // take into account both days on weekend

    return (iDateDiff + 1); // add 1 because dates are inclusive
    }
    function getTotalHari(){
        var rawDate1 = $('#tanggal_mulai_cuti').val();
        var rawDate2 = $('#tanggal_selesai_cuti').val();
        // var date1 = date('d-m-Y', strtotime(rawDate1));
        // var date2 = date('d-m-Y', strtotime(rawDate2));
        // const diffTime = abs(date2 - date1);
        // const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        // var date1 = new Date(rawDate1);
        // var date2 = new Date(rawDate2);
        // var diffDays = date2.getDate() - date1.getDate();

        // // console.log(diffTime + " milliseconds");
        // console.log(diffDays + " days");
        console.log(new Date(rawDate1),new Date(rawDate2));

        let totalDay = calcBusinessDays(new Date(rawDate1),new Date(rawDate2));
        $('#total_hari_cuti').val(totalDay);

    }
</script>
@endpush
