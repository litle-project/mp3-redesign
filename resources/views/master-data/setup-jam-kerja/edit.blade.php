@extends('layouts.app')

@push('styles')

@endpush

@section('content')
<div class="page-content">
    <div class="row animate__animated  animate__fadeIn">
        <div class="col-lg-6">
            <form action="{{ route('master-data.setup-jam-kerja.update', $setup_jam->id) }}" method="POST">
                @method('patch')
                @csrf
                <div class="card animate__animated  animate__fadeIn" id="">
                    <div class="card-header justify-content-between d-flex align-items-center">
                        <h4 class="card-title">{{$page_title}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label for=""><strong>Instalasi</strong></label>
                                    
                                    <select class="form-select @error('instalasi_id') is-invalid @enderror" name="instalasi_id" id="">
                                        <option selected disabled>Pilih Instalasi</option>
                                        @foreach ($instalasis as $instalasi)
                                            <option value="{{$instalasi->id}}" {{((($setup_jam->instalasi_id ?? '') == $instalasi->id) ? 'selected' : '')}}>{{$instalasi->nama_instalasi}}</option>
                                        @endforeach
                                    </select>

                                    @error('instalasi_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for=""><strong>Jam Masuk</strong></label>
                                            <input type="time" name="jam_masuk" class="form-control @error('jam_masuk') is-invalid @enderror" placeholder="" value="{{$setup_jam->jam_masuk}}">
        
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
                                            <input type="time" name="jam_pulang" class="form-control @error('jam_pulang') is-invalid @enderror" placeholder="" value="{{$setup_jam->jam_pulang}}">
        
                                            @error('jam_pulang')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for=""><strong>Jam Istirahat</strong></label>
                                            <input type="time" name="jam_keluar_istirahat" class="form-control @error('jam_keluar_istirahat') is-invalid @enderror" placeholder=""value="{{$setup_jam->jam_keluar_istirahat}}">
        
                                            @error('jam_keluar_istirahat')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for=""><strong>Jam Selesai Istirahat</strong></label>
                                            <input type="time" name="jam_masuk_istirahat" class="form-control @error('jam_masuk_istirahat') is-invalid @enderror" placeholder="" value="{{$setup_jam->jam_masuk_istirahat}}">
        
                                            @error('jam_masuk_istirahat')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for=""><strong>Keterangan</strong></label>
                                    <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="" cols="30" rows="5">{{$setup_jam->keterangan}}</textarea>

                                    @error('keterangan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-success" type="submit">
                                <i class="fa fa-save"></i>
                                Simpan
                            </button>
                            <a href="{{route('master-data.setup-jam-kerja.index')}}" class="btn btn-danger" type="submit">
                                <i class="fa fa-arrow-left"></i>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush