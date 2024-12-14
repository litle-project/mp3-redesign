@extends('layouts.app')

<style>
    .head-title {
        font-family: sans-serif;
        font-size: 40px;
        color: #0f2e33;
        margin-bottom: 0;

    }

    .btn-perintah {
        width: 200;
        height: 56px;
    }

</style>

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-12">
                <div class="card animate_animated  animate_fadeIn">
                    <div class="card-header justify-content-between d-flex align-items-center">
                        <div class="float-start">
                            <p class=" fw-bolder head-title"> <b>{{ $page_title }}</b></p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <p class="tx-black" style="display: inline;">Download :</p>
                                <div id="buttons" style="padding: 10px; margin-bottom: 10px; width: 100%; border-radius:5px; display:inline;"></div>
                            </div>
                            <div class="col-8">
                                <form action="" method="get" class="d-flex flex-row-reverse bd-highlight mb-2">
                                    <div class="p-1 bd-highlight">
                                        <button class="btn float-end fw-bold text-white" type="submit" style="margin-top: 17px !important; width: 124px; background:#001A88"> FILTER </button>
                                    </div>
                                    <div class="p-1 bd-highlight">
                                        <select class="form-select" name="select_period" id="selectPeriod" style="margin-top: 17px !important;">
                                            <option value="hari" {{ Request::get('select_period') == 'hari' ? 'selected' : '' }} >Hari</option>
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
                                    <div class="p-1 bd-highlight">
                                        <select class="form-select" name="type_absensi" style="margin-top: 17px !important;">
                                            <option value="Work From Office" {{ Request::get('type_absensi') == 'Work From Office' ? 'selected' : '' }}>Work From Office</option>
                                            <option value="Work From Home" {{ Request::get('type_absensi') == 'Work From Home' ? 'selected' : '' }}>Work From Home</option>
                                            <option value="Work From Instalation" {{ Request::get('type_absensi') == 'Work From Instalation' ? 'selected' : '' }}>Work From Instalation</option>
                                            <option value="Kegiatan Luar Kantor" {{ Request::get('type_absensi') == 'Kegiatan Luar Kantor' ? 'selected' : '' }}>Kegiatan Luar Kantor</option>
                                            <option value="Dinas Luar Kota" {{ Request::get('type_absensi') == 'Dinas Luar Kota' ? 'selected' : '' }}>Dinas Luar Kota</option>
                                            <option value="Lembur" {{ Request::get('type_absensi') == 'Lembur' ? 'selected' : '' }}>Lembur</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-12">
                            @include('components.flash-message')
                        </div>

                        <table class="table-striped datatables mt-1" id="data-table" style="font-size: 16px">
                            <thead style="border-radius: 10px;">
                                <tr class="tr-head" style="border-radius: 10px; background:#001A88!important">
                                    <th style="border-top-left-radius: 10px;border-bottom-left-radius: 10px;" width="1%">No</th>
                                    <th>Timestamp</th>
                                    <th>Type Absensi</th>
                                    <th>Jenis Absensi</th>
                                    <th>Nama Pegawai</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absensi as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->timestamp}}</td>
                                    <td>{{$item->type_absensi}}</td>
                                    <td>{{$item->jenis_absensi}}</td>
                                    <td>{{$item->user->name}}</td>
                                    <td class="text-center">
                                        @if ($item->status_absensi == 'Tepat Waktu')
                                        <span class="badge bg-primary">{{$item->status_absensi}}</span>
                                        @else
                                        <span class="badge bg-danger">{{$item->status_absensi}}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>
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
            title: 'Laporan Absensi',
            className: 'btn btn-success btn-sm btn-corner',
            titleAttr: 'Download as Excel'
        }, {
            extend: 'csv',
            text: '<i class="fas fa-file-csv"></i>&nbsp; CSV',
            title: 'Laporan Absensi',
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
