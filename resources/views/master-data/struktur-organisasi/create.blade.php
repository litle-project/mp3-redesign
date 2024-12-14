@extends('layouts.app')

@push('styles')

@endpush

@section('content')
<div class="page-content">
    <div class="row animate__animated  animate__fadeIn">
        <div class="col-lg-6">
            <form method="POST" action="{{ route('master-data.struktur-organisasi.store') }}">
                @csrf
                <div class="card  animate__animated  animate__fadeIn" id="">
                    <div class="card-header justify-content-between d-flex align-items-center">
                        <h4 class="card-title">{{$page_title}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="name"><strong>Nama Struktur</strong></label>
                                    
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for=""><strong>Nama Pegawai</strong></label>
                                    
                                    <select class="form-select @error('user_id') is-invalid @enderror" name="user_id" id="">
                                        <option selected disabled>Pilih Pegawai</option>
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}" {{(old('user_id') == $user->id ? 'selected' : '')}}>{{$user->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('user_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label>Struktur Atasan</label>
                                    <select class="form-control" name="parent_id">
                                        <option selected value="" disabled>Pilih Struktur Atasan</option>
                                        @foreach ($strukturs as $struktur)
                                            <option value="{{ $struktur->id }}" {{ (old('parent_id') == $struktur->id) ? 'selected' : '' }}>{{ $struktur->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
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