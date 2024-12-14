@extends('layouts.app')

@push('styles')
<style>
.circle-yellow
{
  width: 20px;
  height: 20px;
  border-radius: 50%;
  border: 1px solid;
  background-color: #FFFF00;
}
.circle-red
{
  width: 20px;
  height: 20px;
  border-radius: 50%;
  border: 1px solid;
  background-color: #ff0000;
}
.circle-green
{
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
                <div class="card-header  align-items-center">
                    <p class=" fw-bolder head-title text-uppercase"> <b>{{$page_title}}</b></p>
                    <div class="col-lg-12 mt-2">
                        @if (Auth::user()->name == 'Admin' || Auth::user()->name == 'kadisnav')
                        <div class="badge fs-5 d-none" style="background-color: #001A88 !important;height: 8vh;">
                            <span class="fs-3 fw-bolder d-block mt-2">{{$total_jam}} <small>Jam</small></span>
                        </div>
                        @else
                        <div class="badge fs-5 " style="background-color:#001A88 !important;height: 8vh;">
                            <span class="fs-3 fw-bolder d-block mt-2">{{$total_jam}} <small>Jam</small></span>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-row-reverse bd-highlight mb-2">
                        <div class="p-1 bd-highlight">
                            @if ($user_count > 0 || strtolower(Auth::user()->name == 'kadisnav') || Auth::user()->name == 'Admin')
                            <a href="{{route('lembur.create')}}" class="btn float-end fw-bold text-white mt-3" style="background-color: #001A88 !important;"> PERINTAHKAN LEMBUR <i class="fa fa-plus"></i></a>
                            @endif
                        </div> 
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
                        </form>
                    </div>
                    <div class="col-12">
                        @include('components.flash-message')
                    </div>
                    <table class="table-striped datatables" id="data-table" style="font-size: 16px">
                        <thead>
                            <tr class="tr-head">
                                <th style="border-top-left-radius: 10px;border-bottom-left-radius: 10px;" width="1%">No</th>
                                <th>Nomor Perintah Lembur</th>
                                <th>Perihal Lembur</th>
                                <th>Tanggal Lembur</th>
                                <th>Total Waktu Lembur</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lemburs as $data)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td><a href="{{route('lembur.review', $data->id)}}">{{$data->nomor_perintah_lembur}}</a></td>
                                <td>{{$data->perihal_lembur}}</td>
                                <td>{{$data->tanggal_lembur}}</td>
                                <td>{{$data->jam_terakhir}} jam</td>
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