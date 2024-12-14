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
                    <div class="col-12">
                        @include('components.flash-message')
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <span class="d-block fs-5">{{$data->nomor_surat}}</span>

                        </div>
                         <div class="col-lg-6">
                            <div class="float-end">

                                    @if (($data->approvalTerakhir()->role_to_name ?? null) == (Auth::user()->roles->first()->name ?? null))
                                        <button class="btn btn-lg btn-dark " data-bs-toggle="modal" data-bs-target="#showModal">TINDAK LANJUT</button>
                                    @else
                                        @if ($data->status=='Disetujui')
                                            <span class="text-success fs-3">{{$data->status}}</span>
                                        @elseif($data->status=='Ditolak')
                                            <span class="text-danger fs-3">{{$data->status}}</span>
                                        @else
                                            <span class="text-warning fs-3">{{$data->status}}</span>
                                        @endif
                                    @endif
                                    @if (in_array(Auth::user()->id,$data->personilDinas->pluck('pegawai_id')->toArray()))
                                        @if ($data->status=='Disetujui')

                                            {{-- JIKA TIDAK ADA TAMBAHAN WAKTU WAITIK BISA AJUKAN --}}
                                            @if ($data->tambahWaktuKuWait->count() == 0)
                                                <button class="btn d-block btn-primary" data-bs-toggle="modal" data-bs-target="#showModalTambahJam">
                                                    <i class="fa fa-clock"></i>
                                                    AJUKAN TAMBAH JAM</button>
                                            @endif
                                        @endif
                                    @endif

                            </div>
                        </div>


                        {{-- TIMELINE --}}
                        {{-- @include('pengajuan-cuti.component.review-timeline') --}}

                        {{-- INFO PERCUTIAN --}}
                        {{-- @include('pengajuan-cuti.component.info-status-cuti') --}}

                        {{-- DETAIL PENGAJUAN CUTI --}}
                        <div class="col-lg-12 mt-2">
                            <hr>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <span class="text-muted d-block fs-6 ">Perihal Kegiatan</span>
                                    <span class="text-default fw-bolder d-block fs-6">{{$data->perihal}}</span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <span class="text-muted d-block fs-6 ">Personil Yang Ditugaskan</span>
                                    @if ($data->personil_yang_ditugaskan == 'Diri Sendiri')
                                        <span class="text-default fw-bolder d-block fs-6">{{$data->personil_yang_ditugaskan}}</span>
                                    @else
                                        <ul>
                                            @foreach ($data->personilDinas as $pd)
                                                <li>{{$pd->user->name}}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                                <div class="col-lg-3">
                                    <span class="text-muted d-block fs-6 ">Urgensi</span>
                                    <span class="text-default fw-bolder d-block fs-6">{{$data->urgensi}}</span>
                                </div>

                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-2">
                                    <span class="text-muted d-block fs-6 ">Jam Mulai Kegiatan</span>
                                    <span class="text-default fw-bolder d-block fs-6">{{$data->jam_mulai_kegiatan}}</span>
                                </div>
                                <div class="col-lg-2">
                                    <span class="text-muted d-block fs-6 ">Jam Selesai Kegiatan</span>
                                    @if ($data->tambahWaktuApproveByPersonil())
                                        <span class="text-default fw-bolder  fs-6" style="text-decoration: line-through;">{{$data->jam_selesai_kegiatan}}</span>
                                        |
                                        <span class="text-default fw-bolder  fs-6">{{$data->tambahWaktuSelesai()}}</span>
                                        (<span class="fw-bolder fs-6 text-success">+{{$data->tambahWaktuApproveByPersonil()->tambahan_jam}} Jam</span>)
                                    @else
                                    <span class="text-default fw-bolder  fs-6">{{$data->jam_selesai_kegiatan}}</span>
                                    @endif
                                </div>

                                @if ($data->status == 'Disetujui')
                                    <div class="col-lg-8">
                                        <span class="text-muted d-block fs-6 ">Pengajuan Tambahan Jam</span>
                                        <i class="fa fa-check text-success"></i> Disetujui
                                        |
                                        <i class="fa fa-times text-danger"></i> Ditolak
                                        |
                                        <i class="fa fa-clock text-warning"></i> Menunggu Approval Atasan Langsung

                                        <ul class="fw-bolder mt-2">
                                                @foreach ($data->tambahWaktuPerluAksi as $item)
                                                    <li>
                                                        <form action="{{route('master-data.kegiatan-luar-kantor.tambah-jam-approve',$item->id)}}" method="POST">
                                                            @csrf
                                                            {{$item->user->name}} |
                                                                <input type="number" min="0" name="tambahan_jam" value="{{$item->tambahan_jam}}" max="12"> Jam
                                                            | {{$item->keterangan}} |
                                                            <button class="btn btn-sm btn-success" type="submit"><i class="fa fa-check"></i></button>
                                                            <a href="{{route('master-data.kegiatan-luar-kantor.tambah-jam-reject',$item->id)}}">
                                                                <button class="btn btn-sm btn-danger" type="button"><i class="fa fa-times"></i></button>
                                                            </a>
                                                        </form>
                                                    </li>
                                                @endforeach
                                                @foreach ($data->tambahWaktuPemilikData as $item)
                                                    <li>{{Auth::user()->name}} | <span class="text-success">{{$item->tambahan_jam}} jam</span> | {{$item->keterangan}} |
                                                        @if ($item->status == 'pending')
                                                            <span class="text-warning"><i class="fa fa-clock "></i></span>
                                                        @elseif ($item->status == 'done')
                                                            <span class="text-success"><i class="fa fa-check "></i></span>
                                                        @elseif ($item->status == 'reject')
                                                            <span class="text-danger"><i class="fa fa-times "></i></span>
                                                        @else
                                                        @endif
                                                    </li>
                                                @endforeach
                                                @foreach ($data->tambahWaktuKu as $item)
                                                    <li>{{Auth::user()->name}} | <span class="text-success">{{$item->tambahan_jam}} jam</span> | {{$item->keterangan}} |
                                                        @if ($item->status == 'pending')
                                                            <span class="text-warning"><i class="fa fa-clock "></i></span>
                                                        @elseif ($item->status == 'done')
                                                            <span class="text-success"><i class="fa fa-check "></i></span>
                                                        @elseif ($item->status == 'reject')
                                                            <span class="text-danger"><i class="fa fa-times "></i></span>
                                                        @else
                                                        @endif
                                                    </li>
                                                @endforeach



                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <span class="text-muted d-block fs-6 ">Entitas Yang Dituju</span>
                                    <span class="text-default fw-bolder d-block fs-6">{{$data->entitas}}</span>
                                </div>
                                <div class="col-lg-8">
                                    <span class="text-muted d-block fs-6 ">Alamat Entitas</span>
                                    <span class="text-default fw-bolder d-block fs-6">{{$data->entitas_alamat}}</span>
                                </div>

                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-8">
                                    <span class="text-muted d-block fs-6 ">Dokumen Pendukung</span>
                                    <ul>
                                        @foreach ($data->dokumenPendukung as $dp)
                                            <li>
                                                <a href="{{asset('dokumen-kegiatan-luar-kantor/'.$dp->file_name)}}" target="_blank">{{$dp->file_name}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
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
                        @if (count($data->approval))
                        @include('kegiatan-luar-kantor.component.persetujuan')
                        @endif
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

    {{-- FILTER MODAL TINDAK LANJUT --}}
    @if (($data->approvalTerakhir()->position ?? null) =='Atasan Langsung')
        @include('kegiatan-luar-kantor.component.modal-form-atasan-langsung')
    @elseif (($data->approvalTerakhir()->position ?? null) =='Kepala Distrik Navigasi')
        @include('kegiatan-luar-kantor.component.modal-form-kadisnav')
        @endif

    @include('kegiatan-luar-kantor.component.modal-form-tambah-jam')
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
