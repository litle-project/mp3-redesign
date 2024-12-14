@extends('layouts.app')

@push('styles')
<style>
    .btn-absensi{
        border-radius: 20px;
    }
    .apexcharts-legend {
        border: 1px solid rgb(83, 83, 83);
        background-color: #f0f0f0;
        border-radius: 20px;
        padding: 10px !important;
        display: flex !important; 
        justify-content: space-around !important;
    }
    .nav-tabs-custom .nav-item .nav-link.active {
        color: white !important;
        background: #038edc !important;
    }
    .punch-info {
        margin-bottom: 20px;
    }
    .punch-hours {
        align-items: center;
        background-color: #f9f9f9;
        border: 5px solid #e3e3e3;
        border-radius: 50%;
        display: flex;
        font-size: 18px;
        height: 9rem;
        justify-content: center;
        margin: 0 auto;
        width: 9rem;
    }
    .punch-det {
        background-color: #f9f9f9;
        border: 1px solid #e3e3e3;
        border-radius: 4px;
        margin-bottom: 20px;
        padding: 10px 15px;
    }
    .stats-box {
        background-color: #f9f9f9;
        border: 1px solid #e3e3e3;
        margin-bottom: 15px;
        margin-top: 10px;
        padding: 5px;
    }
    .rounded20{
        border-radius: 10px;
    }
    .stats-info {
        border: 1px solid #e5e5e5;
        padding: 15px;
        /* margin-top: 20px; */
        text-align: center;
    }
</style>
@endpush

@section('content')
<div class="page-content" style="">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-5">
                <div class="card shadow-lg card__one animate__animated  animate__fadeInUp card-2">
                    <div class="card-header text-center bg-mp3" style="border-radius: 20px 20px 0px  0px;">
                        <h5 class="fw-bolder text-white mb-0">ABSENSI {{ $page_title }} <br><small>({{ date('Y-m-d') }})</small></h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="absensi" class="fw-bolder form-label">Absensi :</label>

                            <select name="absensi" id="filter_absensi" class="form-select" onchange="getValueSelectFilter()">
                                <option value="" disabled selected> --- Pilih Absensi --- </option>
                                <option name="mulai" value="mulai">Mulai</option>
                                <option name="selesai" value="selesai">Selesai</option>
                            </select>
                        </div>

                        <div class="punch-info">
                            <div class="punch-hours">
                                <span class="lama_kerja">-</span>
                            </div>
                        </div>
                        <button class="btn btn-lg btn-success btn-absensi d-block mx-auto disabled" style="font-size: 16px;" id="button-absensi" onclick="confirmAbsensi('{{ Auth::user()->id }}')">ABSENSI MASUK</button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <div class="card shadow-lg card__one animate__animated  animate__fadeInUp card-2">
                    <div class="card-header text-center bg-mp3" style="border-radius: 20px 20px 0px  0px;">
                        <h5 class="fw-bolder text-white mb-2 mt-2">INFORMASI ABSENSI</h5>
                    </div>
                    <div class="card-body">
                        <div class="punch-det" id="belum_masuk">
                            <div class="alert alert-danger text-center mt-2" id="bg-alert">
                                <h5 id="message-alert">Anda belum absen masuk</h5>
                            </div>
                        </div>
                        <div class="punch-det">
                            <div class="row">
                                <div class="col-6">
                                    <h6 class="mb-1 mt-1 fw-bold">Jam Mulai: </h6>
                                    <span class="mt-0" id="waktu_mulai">-</span>
                                </div>
                                <div class="col-6">
                                    <h6 class="mb-1 mt-1 fw-bold">Jam Pulang: </h6>
                                    <span class="mt-0" id="waktu_selesai">-</span>
                                </div>
                            </div>
                        </div>

                        <div class="statistics">
                            <div class="row mb-0 mt-0">
                                <div class="col-md-12 col-12 text-center">
                                    <div class="stats-info rounded20 bg-mp3">
                                        <p>Hari Ini <strong><span class="lama_kerja">-</span> / <small id="jam_kerja">8 jam</small></strong></p>
                                        <div class="progress">
                                            <div class="progress-bar bg-primary" role="progressbar"  id="persentase_jamkerja" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row mt-0">
                                <div class="col-md-6 col-6 text-center">
                                    <div class="stats-box rounded20 bg-mp3">
                                        <p class="mb-1">Istirahat</p>
                                        <h6 class="text-white" id="istirahat">1 jam</h6>
                                    </div>
                                </div>
                                <div class="col-md-6 col-6 text-center">
                                    <div class="stats-box rounded20 bg-mp3">
                                        <p class="mb-1">Overtime</p>
                                        <h6 class="text-white" id="overtime">0 jam</h6>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 d-none">
                <div class="card shadow-lg card__one animate__animated  animate__fadeInUp card-2">
                    <div class="card-header justify-content-between d-flex align-items-center bg-mp3" style="border-radius: 20px 20px 0px 0px">
                        <h5 class="fw-bolder text-white">Persentase Kedisiplinan</h5>
                            <a href="{{ route('absensi.work-from-office.index') }}"  class="btn btn-sm btn-soft-warning">Refresh <i class="mdi mdi-arrow-right align-middle"></i></a>
                    </div><!-- end card header --> 
                    <div class="card-body">                                        
                        <div id="chart" class="apex-charts"></div> 
                        <hr>
                        <div class="row ps-0 pb-0 pt-4 text-lg-center text-sm-left">
                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                        <h5><strong>NAMA PEGAWAI</strong></h5>
                                        <p>Sahri Ramadan</p>
                                    </div>
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                        <h5><strong>NIP</strong></h5>
                                        <p>07374845</p>
                                    </div>
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                        <h5><strong>NIP</strong></h5>
                                        <p>07374845</p>
                                    </div>
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                        <h5><strong>SHIFT</strong></h5>
                                        <p>Shift 2</p>
                                    </div>
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                        <h5><strong>STATUS PEGAWAI</strong></h5>
                                        <p>ASN</p>
                                    </div>
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                        <h5><strong>STATUS PEGAWAI</strong></h5>
                                        <p>ASN</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end card-->
            </div><!-- end col -->
        </div>
    </div>
</div>
<!-- end page title -->
@endsection

@push('scripts')
    <!-- apexcharts -->
    <script src="{{ asset('backend/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- piecharts init -->
    <script src="{{ asset('backend/js/pages/apexcharts-pie.init.js') }}"></script>
    <script>
        function confirmAbsensi(userId) {
            let jenisAbsensi = $("#filter_absensi").val()
            alertify.confirm("APAKAH ANDA YAKIN ?", function () {
                //Post Data Absen Masuk 
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '/api/absensi',
                    data: {
                        'user_id': userId,
                        'jenis_absensi' : jenisAbsensi,
                        'type_absensi' : 'Lembur'
                    },
                    success: function(data) {
                        if (data.data.jenis_absensi == 'mulai') {
                            Swal.fire({
                                title: 'Success !',
                                icon: 'success',
                                html: 'Absensi mulai Anda telah Berhasil dicatat ke dalam sistem pada jam '+data.data.datetime+'. Selamat Bekerja, semoga hari Anda menyenangkan',
                                confirmButtonText: 'Ok',
                                showClass: {
                                    popup: 'animate__animated animate__zoomIn'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__zoomOut'
                                }
                                }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    location.reload();
                                    console.log(data);
                                }
                            });
                        }else if(data.data.jenis_absensi == 'selesai'){
                            Swal.fire({
                                title: 'Success !',
                                icon: 'success',
                                html: 'Absensi Selesai Anda telah Berhasil dicatat ke dalam sistem pada jam '+data.data.datetime+'. Hati-Hati di Jalan!',
                                confirmButtonText: 'Ok',
                                showClass: {
                                    popup: 'animate__animated animate__zoomIn'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__zoomOut'
                                }
                                }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    location.reload();
                                    console.log(data);
                                }
                            });
                        }
                    }
                });
            }, function () {
                alertify.error("Cancel")
            }).set('labels', {
                ok: 'IYA',
                cancel: 'TIDAK',
            }).set({
                title: `<img height="60px" src="{{asset('images/background/modisLogo.png')}}">`
            })
        }

        getDataAbsen({{ Auth::user()->id }})
        setInterval(function() {
            getDataAbsen({{ Auth::user()->id }})
        }, 60000);

        function getDataAbsen(userId) {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/api/get-absensi/lembur',
                data: {
                    'user_id': userId,
                },
                success: function(data) {
                    if (data.data.jenis_absensi == 'mulai') {
                        $("select  option[value='mulai']").attr('disabled', 'disabled');
                        $("select  option[value='mulai']").text('Mulai (Disabled)');
                        
                        $('#sudah_masuk').removeClass('d-none');
                        $('#belum_masuk').addClass('d-none');
                        $('#message-alert').text('Anda belum absen');
                        $('#bg-alert').removeClass('alert-success');
                        $('#bg-alert').addClass('alert-danger');

                        // WAKTU ABSEN
                        $('#waktu_mulai').text(moment(data.data.timestamp).format('HH : mm : ss'));

                        $('.lama_kerja').text(data.lama_kerja);
                        $('#jam_kerja').text(data.jam_kerja + ' ' + 'jam');
                        $('#persentase_jamkerja').width(data.persentase_jamkerja + '%');
                        // $('#overtime').text(data.overtime);
                        // $('#tanggal_masuk').text(moment(data.data.timestamp).format('DD-MMMM-YYYY'));
                        // $('#status_absen').text(data.data.status_absensi + ' ('+data.data.jenis_absensi+')');
                        // $('#istirahat').text(data.istirahat + ' ' + 'jam');
                    } else if(data.data.jenis_absensi == 'selesai') {
                        $('#filter_absensi').attr('disabled', true)
                        $('#sudah_masuk').removeClass('d-none');
                        $('#belum_masuk').removeClass('d-none');
                        $('#message-alert').text('Anda sudah melakukan absensi');
                        $('#bg-alert').removeClass('alert-danger');
                        $('#bg-alert').addClass('alert-success');
                        $('#bg-alert').removeClass('alert-danger');
                        $('#bg-alert').addClass('alert-success');

                        // WAKTU ABSEN
                        $('#waktu_selesai').text(moment(data.data.timestamp).format('HH : mm : ss'));
                        if (data.waktu_mulai == '-') {
                            $('#waktu_mulai').text('-');
                        }else{
                            $('#waktu_mulai').text(moment(data.waktu_mulai).format('HH : mm : ss'));
                        }

                        $('.lama_kerja').text(0);
                        $('#jam_kerja').text(0 + ' ' + 'jam');
                        $('#persentase_jamkerja').width(0 + '%');
                        // $('#overtime').text(0);
                        // $('#date').text(moment().format('DD MMMM YYYY', data.data.timestamp));
                        // $('#status_absen').text(data.status_absen);
                        // $('#istirahat').text(data.istirahat + ' ' + 'jam');
                    } 

                    if (data.data.status_absensi == 'Tepat Waktu') {
                        $('#status_absen').addClass('text-success');
                        $('#status_absen').removeClass('text-danger');
                    } else {
                        $('#status_absen').removeClass('text-success');
                        $('#status_absen').addClass('text-danger');
                    }
                }
            })
        }

        function getValueSelectFilter(){
            let val = $("#filter_absensi").val()

            if (val == 'mulai') {
                $('#button-absensi').text('ABSENSI MULAI')
                $('#button-absensi').removeClass('btn-danger')
                $('#button-absensi').removeClass('disabled')
                $('#button-absensi').addClass('btn-success')
            }else if (val == 'selesai') {
                $('#button-absensi').text('ABSENSI SELESAI')
                $('#button-absensi').removeClass('btn-success')
                $('#button-absensi').removeClass('disabled')
                $('#button-absensi').addClass('btn-danger')
            }
        }   
    </script>
    <script>
    var options = {
          series: [44, 55],
          chart: {
          width: 380,
          type: 'pie',
        },
        labels: ['Tepat Waktu', 'Terlambat' ],
        colors: ['#3EC70B', '#F24C4C'],
        legend: {
            position: 'top'
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                width: 320
                }
                
            }
        }],
        
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    
    chart.render();
    // $('.apexcharts-legend').removeClass('position-right')
    // $('.apexcharts-legend').addClass('')
    </script>
@endpush

