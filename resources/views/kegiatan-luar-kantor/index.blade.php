@extends('layouts.app')

@push('styles')
<style>
    .circle-yellow {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 1px solid;
        background-color: #FFFF00;
    }

    .circle-red {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 1px solid;
        background-color: #ff0000;
    }

    .circle-green {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 1px solid;
        background-color: #00FF00;
    }

</style>
@endpush
@section('content')
<div class="page-content">
    <!-- end page title -->
    <div class="row animate__animated  animate__fadeIn">
        <div class="col-lg-12">
            <div class="card shadow-lg">
                <div class="card-header justify-content-between d-flex align-items-center">
                    <p class=" fw-bolder head-title text-uppercase"> <b>{{$page_title}}</b></p>
            </div>
            <div class="card-body">
                <div class="col-12">
                    @include('components.flash-message')
                </div>
                <div class="d-flex flex-row-reverse bd-highlight mb-2">
                    <div class="p-1 bd-highlight">
                        <div class="wd-100p">
                             <a href="{{route('master-data.kegiatan-luar-kantor.create')}}" class="btn  fw-bold text-white " style="margin-top:17px;background-color: #001A88 !important;"> Buat Kegiatan <i
                             class="fa fa-plus"></i></a>
                         </div>
                     </div>
                     <form action="" method="get" class="d-flex flex-row-reverse bd-highlight mb-2">
                         <div class="p-1 bd-highlight">
                        <button class="btn float-end fw-bold text-white" type="submit" style="margin-top: 17px !important; width: 124px; background:#001A88"> FILTER </button>
                    </div>
                    <div class="p-1 bd-highlight">
                        <select class="form-select" name="select_period" id="selectPeriod" style="margin-top: 17px !important;">
                            <option value="bulan" {{ Request::get('select_period') == 'bulan' ? 'selected' : '' }} >Bulan</option>
                            <option value="tahun" {{ Request::get('select_period') == 'tahun' ? 'selected' : '' }} >Tahun</option>
                        </select>
                    </div>
                    <div class="p-1 bd-highlight d-none" id="selectYear">
                        <select class="form-select " name="select_year"  style="margin-top: 17px !important;">
                        @for ($x=date("Y"); $x>2000; $x--)
                                <option value="{{ $x }}" {{ Request::get('select_year') == $x ? 'selected' : '' }} >{{ $x }}</option>
                        @endfor
                        </select>
                    </div>
                    <div class="p-1 bd-highlight d-none" id="selectMonth">
                        <select class="form-select " name="select_month"  style="margin-top: 17px !important;">
                            <option value="all" {{ Request::get('select_month') == 'all' ? 'selected' : '' }}>All</option>
                            <option value="01" {{ Request::get('select_month') == '01' ? 'selected' : '' }}>Januari</option>
                            <option value="02" {{ Request::get('select_month') == '02' ? 'selected' : '' }}>Februari</option>
                            <option value="03" {{ Request::get('select_month') == '03' ? 'selected' : '' }}>Maret</option>
                            <option value="04" {{ Request::get('select_month') == '04' ? 'selected' : '' }}>April</option>
                            <option value="05" {{ Request::get('select_month') == '05' ? 'selected' : '' }}>Mei</option>
                            <option value="06" {{ Request::get('select_month') == '06' ? 'selected' : '' }}>Juni</option>
                            <option value="07" {{ Request::get('select_month') == '07' ? 'selected' : '' }}>Juli</option>
                            <option value="08" {{ Request::get('select_month') == '08' ? 'selected' : '' }}>Agustus</option>
                            <option value="09" {{ Request::get('select_month') == '09' ? 'selected' : '' }}>September</option>
                            <option value="10" {{ Request::get('select_month') == '10' ? 'selected' : '' }}>Oktober</option>
                            <option value="11" {{ Request::get('select_month') == '11' ? 'selected' : '' }}>November</option>
                            <option value="12" {{ Request::get('select_month') == '12' ? 'selected' : '' }}>Desember</option>
                        </select>
                    </div>
                    <div class="p-1 bd-highlight">
                        <input class="form-control" type="date" value="{{ date('Y-m-d', strtotime(Request::get('select_date') ?? 'today')) }}" name="select_date" id="selectDate" style="margin-top: 17px !important;">
                    </div>
                </form>
            </div>
                {{-- <div class="d-flex flex-row-reverse bd-highlight mb-2">
                    <div class="p-1 bd-highlight">
                       <div class="wd-100p">
                            <a href="{{route('master-data.kegiatan-luar-kantor.create')}}" class="btn  fw-bold text-white " style="margin-top:17px;margin-left:20px;background-color: #001A88 !important;"> Buat Kegiatan <i
                            class="fa fa-plus"></i></a>
                        </div>
                    </div>
                </div> --}}
                <table class="table-striped datatables" id="data-table" style="font-size: 16px">
                    <thead>
                        <tr class="tr-head">
                            <th style="border-top-left-radius: 10px;border-bottom-left-radius: 10px;" width="1%">No</th>
                            <th>Nomor Surat</th>
                            <th>Perihal</th>
                            <th>Pemohon</th>
                            <th>Personil</th>
                            <th>Tanggal Kegiatan</th>
                            <th>Total jam</th>
                            <th>Entitas Dituju</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                <a
                                    href="{{route('master-data.kegiatan-luar-kantor.review',$item->id)}}">{{$item->nomor_surat}}</a>
                                @if (($item->approvalTerakhir()->role_to_name ?? null) ==
                                (Auth::user()->roles->first()->name ?? null))
                                <span class="noti-dotnya bg-danger float-end" style="position: inherit"> ! </span>
                                @endif
                            </td>
                            <td>{{$item->perihal}}</td>
                            <td>{{$item->user->name}}</td>
                            <td>
                                @if ($item->personilDinas->count() == 0)
                                -
                                @else
                                {{$item->personilDinas->count()}} Orang
                                @endif
                            </td>
                            <td>{{date('Y-m-d',strtotime($item->created_at))}}</td>
                            <td>
                                @if ($item->tambahWaktuApproveByPersonil())
                                <span style="text-decoration: line-through;">
                                    {{$item->total_jam}}
                                </span>
                                <span>
                                    {{$item->total_jam+$item->tambahWaktuApproveByPersonil()->tambahan_jam}}
                                </span>
                                <span
                                    class="fw-bolder fs-6 text-success">+{{$item->tambahWaktuApproveByPersonil()->tambahan_jam}}
                                    Jam</span>
                                @else
                                {{$item->total_jam}}
                                @endif
                            </td>
                            <td>{{$item->entitas}}</td>
                            <td>
                                @if ($item->status == 'Disetujui')
                                <div class="circle-green"></div>
                                @elseif($item->status == 'Ditolak')
                                <div class="circle-red"></div>
                                @else
                                <div class="circle-yellow"></div>
                                @endif
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- end row -->

</div> <!-- container-fluid -->
</div>
@endsection

@push('scripts')
<script src="{{ asset('backend/libs/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables/buttons.flash.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('backend/libs/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables/buttons.print.min.js') }}"></script>
<script>
    var table = $('#data-table').DataTable({});
    
    var buttons = new $.fn.dataTable.Buttons(table, {
        buttons: [
        // {
        //     extend: 'pdfHtml5',
        //     title: 'Laporan-Parkiran',
        //     orientation: 'potrait',
        //     pageSize: 'A4',
        //     className: 'btn btn-danger btn-sm btn-corner',
        //     text: '<i class="fas fa-file-pdf"></i>&nbsp; PDF',
        //     titleAttr: 'Download as PDF',
        //     customize: function (doc) {
        //         doc.content.splice(0, 0, {
        //             margin: [0, 0, 0, 12],
        //             alignment: 'center',
        //             image: getBase64Image(myGlyph),
        //             width: 140,
        //             height: 40,
        //         });
        //     }
        // }, 
        // {
        //     extend: 'pdfHtml5',
        //     itle: 'Laporan Absensi',
        //     orientation: 'potrait',
        //     pageSize: 'A4',
        //     className: 'btn btn-danger btn-sm btn-corner',
        //     text: '<i class="fas fa-file-pdf"></i>&nbsp; PDF',
        //     titleAttr: 'Download as PDF',
        // },
        {
            extend: 'excelHtml5',
            text: '<i class="fas fa-file-excel"></i>&nbsp; EXCEL',
            title: 'Laporan Lembur',
            className: 'btn btn-success btn-sm btn-corner',
            titleAttr: 'Download as Excel'
        }, {
            extend: 'csv',
            text: '<i class="fas fa-file-csv"></i>&nbsp; CSV',
            title: 'Laporan Lembur',
            className: 'btn btn-info btn-sm btn-corner',
            titleAttr: 'Download as Csv'
        }, ],
    }).container().appendTo($('#buttons'));


    $('#selectPeriod').on('change', function () {
        val = $(this).val();
        if (val == 'hari') {
            $('#selectDate').removeClass('d-none');
            $('#selectMonth').addClass('d-none');
            $('#selectYear').addClass('d-none');
        } else if(val = 'bulan') {
            $('#selectDate').addClass('d-none');
            $('#selectMonth').removeClass('d-none');
            $('#selectYear').removeClass('d-none');
        } else if(val == 'tahun'){
            $('#selectYear').removeClass('d-none');
            $('#selectMonth').removeClass('d-none');
            $('#selectDate').addClass('d-none');
        }
    });
</script>
@endpush
