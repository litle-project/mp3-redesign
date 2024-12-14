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
                    <form action="{{ route('lembur.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for=""><strong>Nomor Perintah Lembur</strong></label>
                                    <input type="text" name="nomor_perintah_lembur"
                                        class="form-control @error('nomor_perintah_lembur') is-invalid @enderror"
                                        placeholder="">

                                    @error('nomor_perintah_lembur')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for=""><strong>Perihal Lembur</strong></label>
                                    <input type="text" name="perihal_lembur"
                                        class="form-control @error('perihal_lembur') is-invalid @enderror"
                                        placeholder="">

                                    @error('perihal_lembur')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for=""><strong>Rencana Output Kerja Lembur</strong></label>
                                    <input type="text" name="rencana_output_kerja_lembur"
                                        class="form-control @error('rencana_output_kerja_lembur') is-invalid @enderror"
                                        placeholder="">

                                    @error('rencana_output_kerja_lembur')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for=""><strong>Dari Jam</strong></label>
                                    <input type="time" name="dari_jam" id="dari_jam"
                                        class="form-control @error('dari_jam') is-invalid @enderror" placeholder=""
                                        oninput="getTotalHari()">

                                    @error('dari_jam')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for=""><strong>Sampai Jam</strong></label>
                                    <input type="time" name="sampai_jam" id="sampai_jam"
                                        class="form-control @error('sampai_jam') is-invalid @enderror" placeholder=""
                                        oninput="getTotalHari()">

                                    @error('sampai_jam')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for=""><strong>Total Waktu Lembur</strong></label>
                                    <input type="text" name="total_jam" id="total_jam" readonly
                                        class="form-control @error('total_jam') is-invalid @enderror" placeholder="">

                                    @error('total_jam')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <small id="detail_over_night"></small>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for=""><strong>Personil Yang Ditugaskan</strong></label>
                                    <select class="form-select js-example-basic-multiple" name="user_id[]" id=""
                                        multiple="multiple">
                                        @if (Auth::user()->name == 'kadisnav')
                                        @foreach ($users as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                        @else
                                        @foreach (Auth::user()->bawahan() as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                        @endif

                                    </select>
                                    @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for=""><strong>Tanggal Lembur</strong></label>
                                    <input type="date" name="tanggal_lembur" id="tanggal_lembur"
                                        class="form-control @error('tanggal_lembur') is-invalid @enderror"
                                        placeholder="">

                                    @error('tanggal_lembur')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for=""><strong>Keterangan</strong></label>
                                    <textarea class="form-control" name="keterangan" id="" cols="30"
                                        rows="2"></textarea>
                                    @error('keterangan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <label for=""><strong>Dokumen</strong></label>
                                <div class="form-group increment" id="increment-document">
                                    <div class="input-group">
                                        <input class="form-control {{ $errors->has('dokumen') ? 'is-invalid' : '' }}"
                                            type="file" name="dokumen[]">

                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-primary btn-add"
                                                id="btn-add-document">
                                                <i class="fas fa-plus-square"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="clone invisible" id="invisible-document">
                                    <div class="parent" id="parent-document">
                                        <div class="input-group mt-3">
                                            <input
                                                class="form-control {{ $errors->has('dokumen') ? 'is-invalid' : '' }}"
                                                type="file" name="dokumen[]">

                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-outline-danger btn-remove"
                                                    id="btn-remove-document">
                                                    <i class="fas fa-minus-square"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="form-group mb-3">
                                    <label for=""><strong>Dokumen</strong></label>
                                    <input type="file" class="form-control" name="dokumens[]" required multiple="true">

                                    @error('dokumen')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div> --}}
                        </div>
                </div>




                <div class="mt-2">
                    <button class="btn btn-success">
                        <i class="fa fa-save"></i>
                        Simpan
                    </button>
                    <a href="{{route('lembur.index')}}" class="btn btn-danger">
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
    $('#sampai_jam').on('change', function () {
        let dari_jam = $('#dari_jam').val()
        let sampai_jam = $('#sampai_jam').val()
        var startTime = moment(dari_jam, 'hh:mm');
        var endTime = moment(sampai_jam, 'hh:mm');
        let duration = endTime.diff(startTime, 'minutes');

        if (duration < 0) {
            let startTime2 = moment('2000-01-01 ' + dari_jam, 'YYYY-MM-DD hh:mm');
            let endTime2 = moment('2000-01-02 ' + sampai_jam, 'YYYY-MM-DD hh:mm');
            let overduration = endTime2.diff(startTime2, 'minutes');
            duration = overduration
            $('#detail_over_night').text('Today ' + dari_jam + ' - Tomorrow ' + sampai_jam);

        } else {
            duration = duration
            $('#detail_over_night').text('Today ' + dari_jam + ' - Today ' + sampai_jam);


        }
        $('#total_jam').val(duration)
    })

</script>

<script>
    $(document).ready(function () {
        // Documents
        $("#btn-add-document").click(function () {
            let markup = $("#invisible-document").html();
            $("#increment-document").append(markup);
        });

        $("body").on("click", "#btn-remove-document", function () {
            $(this).parents("#parent-document").remove();
        });

    })

</script>
@endpush
