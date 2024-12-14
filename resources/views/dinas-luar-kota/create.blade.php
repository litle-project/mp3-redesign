@extends('layouts.app')

@push('styles')
<style>
    #mapContainer>div{
        border-radius: 10px !important;
    }
    .document {
        width: 100%;
        height: 14rem;
        overflow-y: scroll;
        padding-right: .5rem;
        margin-bottom: 1rem;
    }
</style>
@endpush

@section('content')
<div class="page-content">
    <div class="row animate__animated  animate__fadeIn">
        <div class="col-lg-12">
            <form method="POST" action="{{ route('dinas-luar-kota.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card  animate__animated  animate__fadeIn" id="">
                    <div class="card-header" style="border-radius:15px 15px 0px 0px;">
                        <h3 class="card-title text-dark">Perintahkan Dinas</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group mb-3">
                                            <label for=""><strong>Nama Pegawai</strong></label>
                                            
                                            <select class="form-select multiple-select @error('user_id') is-invalid @enderror" name="user_id[]" multiple="multiple">
                                                @foreach ($users as $user)
                                                    <option value="{{$user->id}}" {{ (old('user_id') == $user->id ? 'selected' : '') }}>{{$user->name}}</option>
                                                @endforeach
                                            </select>
        
                                            @error('user_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="fw-bold" for="">Perihal</label>
                                            
                                            <input type="text" name="perihal" class="form-control @error('perihal') is-invalid @enderror" id="perihal" value="{{ old('perihal') }}">
                                            
                                            @error('perihal')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="fw-bold" for="tanggal_mulai_dinas">Tanggal Mulai Dinas</label>
                                                    
                                                    <input type="date" name="tanggal_mulai_dinas" class="form-control @error('tanggal_mulai_dinas') is-invalid @enderror" id="tanggal_mulai_dinas" >
                                                    
                                                    @error('tanggal_mulai_dinas')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="fw-bold" for="tanggal_selesai_dinas">Tanggal Selesai Dinas</label>
                                                    
                                                    <input type="date" name="tanggal_selesai_dinas" class="form-control @error('tanggal_selesai_dinas') is-invalid @enderror" id="tanggal_selesai_dinas">
                                                    
                                                    @error('tanggal_selesai_dinas')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="fw-bold" for="">Kota Kedinasan</label>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <select name="provinsi" class="form-select" id="select_provinsi" onChange="getDataKota()">
                                                       <option value="" selected disabled>--Pilih Provinsi Kedinasan--</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <select name="kota_kedinasan" class="form-select @error('kota_kedinasan') is-invalid @enderror" id="select_kota_kedinasaan">
                                                        <option value="" selected disabled>--Pilih Kota Kedinasan--</option>
                                                    </select>
                                                    
                                                    @error('kota_kedinasan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 p-3" style="border:1px solid #d4d4d4; border-radius:10px;">
                                        <h4 class="box-title text-dark mb-0">Upload Dokumen Dinas <span class="text-danger">*</span></h4>
                                        <hr class="text-dark">
                                        <div class="document">
                                            <div class="form-group increment" id="increment-document">
                                                <div class="input-group">
                                                    <input class="form-control {{ $errors->has('filename') ? 'is-invalid' : '' }}"  type="file" name="filename[]">
                                                    
                                                    <div class="input-group-append">
                                                        <button type="button"  class="btn btn-outline-primary btn-add" id="btn-add-document">
                                                            <i class="fas fa-plus-square"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clone invisible" id="invisible-document">
                                                <div class="parent" id="parent-document">
                                                    <div class="input-group mt-3">
                                                        <input class="form-control {{ $errors->has('filename') ? 'is-invalid' : '' }}"  type="file" name="filename[]">    
                                                        
                                                        <div class="input-group-append">
                                                            <button type="button"  class="btn btn-outline-danger btn-remove" id="btn-remove-document">
                                                                <i class="fas fa-minus-square"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="fw-bold" for="alamat_kedinasan">Alamat Kedinasan</label>
                                            
                                            <textarea name="alamat_kedinasan" class="form-control" id="alamat_kedinasan" cols="30" rows="10">{{ old('alamat_kedinasan') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="fw-bold" for="keterangan">keterangan</label>
                                            
                                            <textarea name="keterangan" class="form-control" id="keterangan" cols="30" rows="10">{{ old('alamat_kedinasan') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card  animate__animated  animate__fadeIn" id="">
                    <div class="card-header" style="border-radius:15px 15px 0px 0px;">
                        <h3 class="card-title text-dark">Koordinat Kedinasan</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group mb-3 ">
                                            <label class="form-label" for=""><strong>Latitude</strong></label>
                                            
                                            <input class="form-control @error('latitude') is-invalid @enderror" step="any" type="number" name="latitude" id="latitude" placeholder="input latitude" value="{{old('latitude')}}">
            
                                            @error('latitude')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group mb-3 ">
                                            <label class="form-label" for=""><strong>Longitude</strong></label>
                                            
                                            <input class="form-control @error('longitude') is-invalid @enderror" step="any" type="number" name="longitude" id="longitude" placeholder="input longitude" value="{{old('longitude')}}">
            
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
                            <a href="{{route('dinas-luar-kota.index')}}" class="btn btn-danger" type="submit">
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
<script>
    window.action = "submit"
    window.hereApiKey = "{{ env('HERE_API_KEY') }}"
</script>
<script src="{{ asset('js/here.js') }}"></script>

<script>

    $(document).ready(function () {
        // Multiple Select By Id
        $('.multiple-select').select2();

        // Documents
        $("#btn-add-document").click(function () {
            let markup = $("#invisible-document").html();
            $("#increment-document").append(markup);
        });

        $("body").on("click", "#btn-remove-document", function () {
            $(this).parents("#parent-document").remove();
        });
    })

    getDataProvinsi();
    async function getDataProvinsi(){
        let resp = await axios.get('https://dev.farizdotid.com/api/daerahindonesia/provinsi');

        let provinsi = resp.data.provinsi;
        provinsi.forEach(data => {
            $('#select_provinsi').append(`<option value="${data.id}">${data.nama}</option>`);
        });
    }
    async function getDataKota(){
        let getProvinsi = $('#select_provinsi').val();
        $('#select_kota_kedinasaan').empty();
        $('#select_kota_kedinasaan').append(`<option value="" selected disabled>--Pilih Kota Kedinasan--</option>`);

        if (getProvinsi != null || getProvinsi != '') {
            let resp = await axios.get('https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi='+getProvinsi);

            let kota = resp.data.kota_kabupaten;
            kota.forEach(data => {
                $('#select_kota_kedinasaan').append(`<option value="${data.nama}">${data.nama}</option>`);
            });
        }
    }
</script>
@endpush