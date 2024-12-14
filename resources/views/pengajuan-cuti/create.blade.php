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
                        <div class="alert alert-warning w-50">
                            Anda tidak memiliki atasan langsung
                        </div>
                    @else
                        <div class="alert alert-warning w-50">
                            <span class="fs-5 mb-4 d-block">Atasan Langsung : {{Auth::user()->role_atasan_name}}</span>
                        </div>
                    @endif
                    <hr>

                    <form action="{{ route('pengajuan-cuti.store') }}" method="post">
                        @csrf

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for=""><strong>Perihal Cuti</strong></label>
                                    <input type="text" name="perihal_cuti" class="form-control @error('perihal_cuti') is-invalid @enderror" placeholder="">

                                    @error('perihal_cuti')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for=""><strong>Tanggal Mulai Cuti</strong></label>
                                    <input type="date"  name="tanggal_mulai_cuti" id="tanggal_mulai_cuti"
                                        class="form-control @error('tanggal_mulai_cuti') is-invalid @enderror"
                                        placeholder="">

                                    @error('tanggal_mulai_cuti')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for=""><strong>Tanggal Selesai Cuti</strong></label>
                                    <input type="date" name="tanggal_selesai_cuti" id="tanggal_selesai_cuti"
                                        class="form-control @error('tanggal_selesai_cuti') is-invalid @enderror"
                                        placeholder="" oninput="getTotalHari()">

                                    @error('tanggal_selesai_cuti')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for=""><strong>Total Hari Cuti</strong></label>
                                    <input type="number" name="total_hari_cuti" id="total_hari_cuti"  class="form-control @error('total_hari_cuti') is-invalid @enderror" placeholder="">

                                    @error('total_hari_cuti')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">

                                <div class="form-group mb-3">
                                    <label for=""><strong>Nomor Telepon Darurat</strong></label>
                                    <input type="number" name="nomor_telepon_darurat"
                                        class="form-control @error('nomor_telepon_darurat') is-invalid @enderror"
                                        placeholder="">

                                    @error('nomor_telepon_darurat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for=""><strong>Alamat Pemohon</strong></label>
                                    <textarea class="form-control" name="alamat_pemohon" id="" cols="30"
                                        rows="2"></textarea>
                                    @error('alamat_pemohon')
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
                            <a href="{{route('pengajuan-cuti.index')}}" class="btn btn-danger">
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
