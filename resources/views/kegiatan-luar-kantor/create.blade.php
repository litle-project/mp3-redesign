@extends('layouts.app')


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
                    @if (Auth::user()->role_atasan_name =='')
                        <div class="alert alert-warning w-100">
                            Anda tidak memiliki atasan langsung
                        </div>
                    @else
                        <div class="alert alert-warning w-100 row">
                            <div class="col-lg-6">
                                <span class="fs-5 mb-4 d-block">Atasan Langsung : {{Auth::user()->role_atasan_name}}</span>
                            </div>
                            <div class="col-lg-6">
                                <span class="fs-5 mb-4 d-block">Bawahan : {{implode(',',Auth::user()->bawahanName())}}</span>

                            </div>


                        </div>
                    @endif
                    <hr>

                    <form action="{{ route('master-data.kegiatan-luar-kantor.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for=""><strong>Perihal Kegiatan</strong></label>
                                    <input type="text" name="perihal" class="form-control @error('perihal') is-invalid @enderror" placeholder="">

                                    @error('perihal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-2">
                                    <label for="" class="fw-bolder">Personil yang ditugaskan :</label>
                                    <div class="row">
                                        <div class="col-lg-12 mb-1">
                                            <input class="" type="radio" id="DiriSendiri" name="personil_yang_ditugaskan" value="Diri Sendiri">
                                            <label for="DiriSendiri">Diri Sendiri</label>
                                        </div>
                                        @if (count(Auth::user()->bawahan()))
                                        <div class="col-lg-12">
                                            <input class="" type="radio" id="PilihPersonil" name="personil_yang_ditugaskan" value="Pilih Personil">
                                            <label for="PilihPersonil">Pilih Personil</label>
                                            <div class="ps-4">
                                                <div class="form-group">
                                                    <select name="personil_id[]" class="form-select" id="" multiple>
                                                        <option value=""></option>
                                                        @foreach (Auth::user()->bawahan() as $item)
                                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <small class="text-danger">*Tekan ctrl+klik untuk memilih lebih dari satu</small>
                                                </div>
                                            </div>
                                        </div>
                                         @endif
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="" class="fw-bolder">Urgensi :</label>
                                    <div class="row">
                                        <div class="col-lg-4 mb-1">
                                            <input class="" type="radio" id="TidakMendesak" name="urgensi" value="Tidak Mendesak">
                                            <label for="TidakMendesak">Tidak Mendesak</label>
                                        </div>
                                        <div class="col-lg-4 mb-1">
                                            <input class="" type="radio" id="Penting" name="urgensi" value="Penting">
                                            <label for="Penting">Penting</label>
                                        </div>
                                        <div class="col-lg-4 mb-1">
                                            <input class="" type="radio" id="SangatPenting" name="urgensi" value="Sangat Penting">
                                            <label for="SangatPenting">Sangat Penting</label>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group mb-3 row">
                                    <div class="col-lg-6">
                                        <label for=""><strong>Jam Mulai Kegiatan</strong></label>
                                        <input type="time" name="jam_mulai_kegiatan" class="form-control @error('jam_mulai_kegiatan') is-invalid @enderror" placeholder="">

                                        @error('jam_mulai_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                    <div class="col-lg-6">
                                        <label for=""><strong>Jam Selesai Kegiatan</strong></label>
                                        <input type="time" name="jam_selesai_kegiatan" class="form-control @error('jam_selesai_kegiatan') is-invalid @enderror" placeholder="">

                                        @error('jam_selesai_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>

                                </div>



                            </div>
                            <div class="col-lg-6">

                                <div class="form-group mb-3">
                                    <label for=""><strong>Entitas Yang Dituju</strong></label>
                                    <input type="text" name="entitas"
                                        class="form-control @error('entitas') is-invalid @enderror"
                                        placeholder="">

                                    @error('entitas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for=""><strong>Alamat Entitas</strong></label>
                                    <textarea class="form-control" name="entitas_alamat" id="" cols="30"
                                        rows="2"></textarea>
                                    @error('entitas_alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for=""><strong>Dokumen Pendukung</strong></label>
                                    <input class="form-control" name="dokumen_pendukung[]" type="file" multiple>
                                    @error('dokumen_pendukung[]')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for=""><strong>Keterangan</strong></label>
                                    <textarea class="form-control" name="keterangan" id="" cols="30"
                                        rows="3"></textarea>
                                    @error('keterangan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>




                        <div class="mt-2">
                            <button class="btn btn-success">
                                <i class="fa fa-save"></i>
                                Simpan
                            </button>
                            <a href="{{route('master-data.setup-shift.index')}}" class="btn btn-danger">
                                <i class="fa fa-arrow-left"></i>
                                Kembali
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- end row -->

</div> <!-- container-fluid -->
</div>
@endsection

@push('scripts')
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
