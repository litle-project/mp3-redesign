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
                            <p class=" fw-bolder head-title"> <b>DINAS LUAR KOTA</b></p>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="d-flex flex-row-reverse bd-highlight mb-2">
                            <div class="p-1 bd-highlight">
                                @if ($user_count > 0 || Auth::user()->name == 'kadisnav' || Auth::user()->name ==
                                'Admin')
                                <a href="{{ route('dinas-luar-kota.create') }}"
                                    class="btn float-end fw-bold btn-perintah" style=" background:#001A88">
                                    <p style="margin-top: 10px; color:white">PERINTAHKAN DINAS</p>
                                </a>
                                @endif
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

                        <div class="col-12">
                            @include('components.flash-message')
                        </div>

                        <table class="table-striped datatables mt-1" id="data-table" style="font-size: 16px">
                            <thead style="border-radius: 10px;">
                                <tr class="tr-head" style="border-radius: 10px; background:#001A88!important">
                                    <th style="border-top-left-radius: 10px;border-bottom-left-radius: 10px;"
                                        width="1%">No</th>
                                    <th>Nomor Surat</th>
                                    <th>Perihal Dinas</th>
                                    <th>Tanggal Mulai Dinas</th>
                                    <th>Total Hari Dinas</th>
                                    <th>Kota/Kabupaten</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dinas_luar_kota as $dinas)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        @if ($notif == 'ON')
                                        <span class="noti-dotnya bg-danger float-end" style="position: inherit"> !
                                        </span>
                                        @endif
                                        <a href="{{route('dinas-luar-kota.show',$dinas->id)}}">{{$dinas->no_surat}}</a>
                                    </td>

                                    <td>{{$dinas->perihal_dinas}}</td>
                                    <td>{{$dinas->tanggal_mulai_dinas}}</td>
                                    <td>{{ $dinas->getTotalHariDinas($dinas->tanggal_mulai_dinas, $dinas->tanggal_selesai_dinas). ' Hari' }}
                                    </td>
                                    <td>{{$dinas->kota_kedinasan}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>


    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal  fade" id="modal-perintah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Perintahkan Dinas</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label class="fw-bold" for="">Perihal</label>
                        <input type="text" name="perihal" class="form-control" id="perihal">
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="fw-bold" for="tanggal_mulai_dinas">Tanggal Mulai Dinas</label>
                                <input type="text" name="tanggal_mulai_dinas" class="form-control"
                                    id="tanggal_mulai_dinas">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="fw-bold" for="tanggal_selesai_dinas">Tanggal Selesai Dinas</label>
                                <input type="text" name="tanggal_selesai_dinas" class="form-control"
                                    id="tanggal_selesai_dinas">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="fw-bold" for="">Kota Kedinasan</label>
                        <div class="col-6">
                            <div class="form-group">
                                <select name="provinsi" class="form-select" id="select_provinsi"
                                    onChange="getDataKota()">
                                    <option value="" selected disabled>--Pilih Provinsi Kedinasan--</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <select name="kota_kedinasan" class="form-select" id="select_kota_kedinasaan">
                                    <option value="" selected disabled>--Pilih Kota Kedinasan--</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold" for="alamat_kedinasan">Alamat Kedinasan</label>
                        <input type="text" name="alamat_kedinasan" class="form-control" id="alamat_kedinasan">
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group mb-3 ">
                                <label class="form-label" for=""><strong>Latitude</strong></label>

                                <input class="form-control" step="any" type="number" name="latitude" id="latitude"
                                    placeholder="input latitude" value="{{old('latitude')}}">
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group mb-3 ">
                                <label class="form-label" for=""><strong>Longitude</strong></label>

                                <input class="form-control" step="any" type="number" name="longitude" id="longitude"
                                    placeholder="input longitude" value="{{old('longitude')}}">
                            </div>
                        </div>

                        <div class="col-12" style="border-radius: 10px; border:1px solid #e0e2e7;">
                            <div class=" animate__animated  animate__fadeIn" id="formInternalUser">
                                <div id="here-maps" class="form-group mb-3 text-center">
                                    <label class="form-label mt-1" for=""><strong>Pin Location</strong></label>

                                    <div style="height: 21.5rem; border-radius: 10px; border:1px solid #e0e2e7;"
                                        id="mapContainer"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" onclick="addRencana()" class="btn text-white"
                        style="background:#001A88">Lanjut</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
    <!-- End Button trigger modal -->
    @endsection

    @push('scripts')
    <script>
        $('#btn-perintah').on('click', function () {
            $('#modal-perintah').modal('toggle');
        });

        getDataProvinsi();
        async function getDataProvinsi() {
            let resp = await axios.get('https://dev.farizdotid.com/api/daerahindonesia/provinsi');

            let provinsi = resp.data.provinsi;
            provinsi.forEach(data => {
                $('#select_provinsi').append(`<option value="${data.id}">${data.nama}</option>`);
            });
        }
        async function getDataKota() {
            let getProvinsi = $('#select_provinsi').val();
            $('#select_kota_kedinasaan').empty();
            $('#select_kota_kedinasaan').append(
                `<option value="" selected disabled>--Pilih Kota Kedinasan--</option>`);

            if (getProvinsi != null || getProvinsi != '') {
                let resp = await axios.get('https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=' +
                    getProvinsi);

                let kota = resp.data.kota_kabupaten;
                kota.forEach(data => {
                    $('#select_kota_kedinasaan').append(`<option value="${data.id}">${data.nama}</option>`);
                });
            }
        }

    </script>

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
