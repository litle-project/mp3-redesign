@extends('layouts.app')

@push('styles')
<style>
    #mapContainer>div{
        border-radius: 10px !important;
    }
</style>
@endpush

@section('content')
<div class="page-content">
    @if (Auth::user()->id == $user->id)
    <div class="row animate__animated  animate__fadeIn">
        <div class="col-lg-12">
            <div class="card" style="border-radius:15px;">
                <div class="card-header" style="border-radius:15px 15px 0px 0px;">
                    <h3 class="card-title text-dark">Edit Password</h3>
                </div>
                <form action="{{ route('master-data.users.change-password') }}" method="POST">
                    @method('patch')
                    @csrf
                    <div class="card-body">

                        @include('components.flash-message')

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="password">Password Lama</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" value="{{ old('password') }}" placeholder="Password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="new_password">Password Baru</label>
                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                        id="new_password" name="new_password" value="{{ old('new_password') }}"
                                        placeholder="New Password">
                                    @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer" style="border-radius:0px 0px 15px 15px;">
                        <button type="submit" class="btn btn-warning ms-2">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    <div class="row animate__animated  animate__fadeIn">
        <div class="col-lg-12">
            <form action="{{ route('user-setting.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf

                {{-- <div class="card  animate__animated  animate__fadeIn" id="">
                    <div class="card-header justify-content-between d-flex align-items-center">
                        <h4 class="card-title">{{$page_title}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group d-flex">
                            <div class="row ms-1">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="role" class="fw-bolder">User Role :</label>

                                        <select name="role" id="role" class="form-select select2 @error('role') is-invalid @enderror" required>
                                            <option value="">----</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role }}" {{ (($user->getRoleNames()[0] ?? '') == $role) ? 'selected' : '' }}>{{ $role }}</option>
                                            @endforeach
                                        </select>
                                        
                                        @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="card  animate__animated  animate__fadeIn" id="">
                    <div class="card-header">
                        <h4 class="card-title">{{$page_title}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="username"><strong>UserId</strong></label>
                                    
                                    <input type="text" name="username" id="username" value="{{ $user->username ?? '' }}" class="form-control @error('username') is-invalid @enderror" placeholder="">
                                    
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="name"><strong>Nama Pegawai</strong></label>
                                    
                                    <input type="text" name="name" id="name" value="{{ $user->name ?? '' }}" class="form-control @error('name') is-invalid @enderror" placeholder="">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for=""><strong>NIP</strong></label>
                                    
                                    <input type="text" name="nip" value="{{ $user->nip ?? '' }}" class="form-control @error('nip') is-invalid @enderror" placeholder="">
                                
                                    @error('nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for=""><strong>Jenis Kelamin</strong></label>
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="radio" id="laki-laki" value="laki-laki" name="jenis_kelamin" {{ (($user->jenis_kelamin ?? '') == 'laki-laki') ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="laki-laki">Laki-Laki</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="radio" id="perempuan" value="perempuan" name="jenis_kelamin" {{ (($user->jenis_kelamin ?? '') == 'perempuan') ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="perempuan">Perempuan</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-6 col-xl-6"> 
                                        <div class="form-group mb-3">
                                            <label class="form-label" for=""><strong>Status Pegawai</strong></label>
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="radio" id="asn" value="ASN" name="status_pegawai" {{ (($user->status_pegawai ?? '') == 'ASN') ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="asn">ASN</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="radio" id="ppnpn" value="PPnPN" name="status_pegawai" {{ (($user->status_pegawai ?? '') == 'PPnPN') ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="ppnpn">PPnPN</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for=""><strong>Tempat Lahir</strong></label>
                                            
                                            <input type="text" name="tempat_lahir" value="{{ $user->tempat_lahir ?? '' }}" class="form-control @error('tempat_lahir') is-invalid @enderror" placeholder="">
                                        
                                            @error('tempat_lahir')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for=""><strong>Tanggal Lahir</strong></label>
                                            
                                            <input type="date" name="tanggal_lahir" value="{{ $user->tanggal_lahir ?? date('Y-m-d') }}" class="form-control @error('tanggal_lahir') is-invalid @enderror" placeholder="">
                                        
                                            @error('tanggal_lahir')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="form-label" for="alamat_tinggal"><strong>Alamat Tempat Tinggal</strong></label>
                                   
                                    <textarea name="alamat_tinggal" id="alamat_tinggal" rows="5" class="form-control @error('alamat_tinggal') is-invalid @enderror">{{ $user->alamat_tinggal ?? '' }}</textarea>
                                
                                    @error('alamat_tinggal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="form-label" for=""><strong>Pangkat</strong></label>
                                    
                                    <select class="form-select" name="pangkat_id" id="">
                                        <option disabled selected>Pilih Pangkat</option>
                                        @foreach ($pangkats as $pangkat)
                                            <option value="{{$pangkat->id}}" {{($user->pangkat_id == $pangkat->id ? 'selected' : '')}}>{{$pangkat->nama_pangkat}}</option>
                                        @endforeach
                                    </select>
                                
                                    @error('pangkat_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class=" animate__animated  animate__fadeIn" id="formInternalUser">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for=""><strong>Nomor KTP</strong></label>
                                        
                                        <input type="text" name="nik" value="{{ $user->nik ?? '' }}" class="form-control @error('nik') is-invalid @enderror" placeholder="">
                                        
                                        @error('nik')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label" for="alamat_ktp"><strong>Alamat Sesuai KTP</strong></label>
                                       
                                        <textarea name="alamat_ktp" id="alamat_ktp" rows="5" class="form-control @error('alamat_ktp') is-invalid @enderror">{{ $user->alamat_ktp ?? '' }}</textarea>
                                    
                                        @error('alamat_ktp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                   
                                    <div class="form-group mb-3">
                                        <label class="form-label" for=""><strong>Nomor NPWP</strong></label>
                                        
                                        <input type="text" name="npwp" value="{{ $user->npwp ?? '' }}" class="form-control @error('npwp') is-invalid @enderror" placeholder="">
                                        
                                        @error('npwp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                   
                                    <div class="form-group mb-3">
                                        <label class="form-label" for=""><strong>Alamat Email</strong></label>
                                      
                                        <input type="email" name="email" value="{{ $user->email ?? '' }}" class="form-control @error('email') is-invalid @enderror" placeholder="">
                                    
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label class="form-label" for=""><strong>Nomor Telepon Seluler</strong></label>
                                        
                                        <input type="text" name="nomor_telepon" value="{{ $user->nomor_telepon ?? '' }}" class="form-control @error('nomor_telepon') is-invalid @enderror" placeholder="">
                                    
                                        @error('nomor_telepon')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label class="form-label" for=""><strong>Foto Pegawai </strong></label><br>
                                        
                                        <img src="{{ asset('img/users/'.($user->foto ?? 'user.png')) }}" width="110px" class="image img d-block mx-auto" />
                                        
                                        <input type="file" name="foto" class="form-control mt-2" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card  animate__animated  animate__fadeIn" id="">
                    <div class="card-header" style="border-radius:15px 15px 0px 0px;">
                        <h3 class="card-title text-dark">Koordinat Tempat Tinggal</h3>
                    </div>
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for=""><strong>Latitude</strong></label>
                                            
                                            <input class="form-control @error('latitude') is-invalid @enderror" step="any" type="number" name="latitude" id="latitude" placeholder="input latitude" value="{{ $user->latitude ?? '' }}">
            
                                            @error('latitude')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for=""><strong>Longitude</strong></label>
                                            
                                            <input class="form-control @error('longitude') is-invalid @enderror" step="any" type="number" name="longitude" id="longitude" placeholder="input longitude" value="{{ $user->longitude ?? '' }}">
            
                                            @error('longitude')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12" style="border-radius: 10px; border:1px solid #e0e2e7;">
                                        <div class=" animate__animated  animate__fadeIn" id="formInternalUser">
                                            <div id="here-maps" class="form-group mb-3 text-center">
                                                <label class="form-label mt-1" for=""><strong>Pin Location</strong></label>
                                                <div style="height: 21.5rem; border-radius: 10px; border:1px solid #e0e2e7;" id="mapContainer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <button class="btn btn-success" type="submit">
                                <i class="fa fa-save"></i>
                                Simpan
                            </button>
                            {{-- <a href="{{route('master-data.user.index')}}" class="btn btn-danger" type="submit">
                                <i class="fa fa-arrow-left"></i>
                                Kembali
                            </a> --}}
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    window.action = "submit"
    window.hereApiKey = "{{ env('HERE_API_KEY') }}"
</script>
<script src="{{ asset('js/here.js') }}"></script>
@endpush