@extends('layouts.app')


@section('content')
<div class="page-content">
    <div class="row animate__animated  animate__fadeIn">
        <div class="col-lg-6">
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
                    <form action="{{ route('master-data.setup-shift.store') }}" method="post">
                        @csrf

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label for=""><strong>Nama Shift</strong></label>
                                    <input type="text" name="nama_shift"
                                        class="form-control @error('nama_shift') is-invalid @enderror" placeholder="">

                                    @error('nama_shift')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for=""><strong>Instalasi</strong></label>
                                    
                                    <select class="form-select @error('instalasi_id') is-invalid @enderror" name="instalasi_id" id="">
                                        <option selected disabled>Pilih Instalasi</option>
                                        @foreach ($instalasis as $instalasi)
                                            <option value="{{$instalasi->id}}" {{(old('instalasi_id') == $instalasi->id ? 'selected' : '')}}>{{$instalasi->nama_instalasi}}</option>
                                        @endforeach
                                    </select>

                                    @error('instalasi_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for=""><strong>Nama Pegawai</strong></label>
                                    <select
                                        class="form-select js-example-basic-multiple @error('user_id') is-invalid @enderror"
                                        name="user_id[]" multiple="multiple">
                                        @foreach ($users as $user)
                                        <option value="{{$user->id}}"
                                            {{ (old('user_id') == $user->id ? 'selected' : '') }}>{{$user->name}}
                                        </option>
                                        @endforeach
                                    </select>

                                    @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for=""><strong>Jam Masuk</strong></label>
                                            <input type="time" name="jam_masuk" class="form-control @error('jam_masuk') is-invalid @enderror" placeholder="">
        
                                            @error('jam_masuk')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for=""><strong>Jam Pulang</strong></label>
                                            <input type="time" name="jam_pulang" class="form-control @error('jam_pulang') is-invalid @enderror" placeholder="">
        
                                            @error('jam_pulang')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for=""><strong>Keterangan</strong></label>
                                    <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="" cols="30" rows="5"></textarea>

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
@endpush
