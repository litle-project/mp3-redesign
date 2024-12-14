@extends('layouts.app')


@section('content')
<div class="page-content">

    <!-- end page title -->
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
                    <form action="{{ route('master-data.instalasi.update', $instalasi->id) }}" method="post">
                        @method('patch')
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for=""><strong>Nama Instalasi</strong></label>
                                    <input type="text" name="nama_instalasi" class="form-control @error('nama_instalasi') is-invalid @enderror" placeholder="input nama instalasi" required value="{{$instalasi->nama_instalasi ?? ''}}">

                                    @error('nama_instalasi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for=""><strong>Latitude</strong></label>
                                            <input  class="form-control @error('latitude') is-invalid @enderror" step="any" type="number" name="latitude" required id="latitude" placeholder="input latitude" value="{{$instalasi->latitude ?? ''}}">
        
                                            @error('latitude')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group mb-3">
                                            <label for=""><strong>Longitude</strong></label>
                                            <input  class="form-control @error('longitude') is-invalid @enderror" step="any" type="number" name="longitude" required id="longitude" placeholder="input longitude" value="{{$instalasi->longitude ?? ''}}">
        
                                            @error('longitude')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for=""><strong>Radius </strong><small>(meter)</small></label>
                                    <div class="input-group">   
                                        <input  class="form-control @error('radius') is-invalid @enderror"  type="number" name="radius" id="radius" required placeholder="input radius" value="{{$instalasi->radius ?? ''}}">
                                        <div class="input-group-text">m</div>
                                     </div>
                                    @error('radius')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for=""><strong>Alamat Instalasi</strong></label>
                                    <textarea class="form-control @error('alamat_instalasi') is-invalid @enderror" name="alamat_instalasi" id="" placeholder="input alamat instalasi" cols="57" rows="4">{{$instalasi->alamat_instalasi ?? ''}}</textarea>

                                    @error('alamat_instalasi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for=""><strong>Keterangan</strong></label>
                                    <textarea class="form-control @error('keterangan') is-invalid @enderror" placeholder="input keterangan" name="keterangan" id="" cols="57" rows="4">{{$instalasi->keterangan ?? ''}}</textarea>

                                    @error('keterangan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label for="" class="d-block"><strong>Tetapkan Sebagai Kantor Utama</strong><span class="text-danger fs-5">*</span></label>
                                            
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="kantor_utama" id="inlineRadio1" value="true" onclick="confirmRadioButton({{ $instalasi->id }})" {{ (($instalasi->kantor_utama ?? '') == true) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="kantor_utama" id="inlineRadio2" value="false" onclick="confirmRadioButton({{ $instalasi->id }})" {{ (($instalasi->kantor_utama ?? '') == false) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                            </div>
                                            @error('radius')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12" style="border-radius: 10px; border:1px solid #e0e2e7;">
                                        <div class=" animate__animated  animate__fadeIn" id="formInternalUser">
                                            <div id="here-maps" class="form-group mb-3 text-center">
                                                <label class="form-label mt-1" for=""><strong>Pin Location</strong></label>
                                                <div style="height: 26rem; border-radius: 10px; border:1px solid #e0e2e7;" id="mapContainer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-2">
                            <button class="btn btn btn-success">
                                <i class="fa fa-save"></i>
                                Simpan</button>
                            <a href="{{route('master-data.instalasi.index')}}" class="btn btn btn-danger"><i
                                    class="fa fa-arrow-left"></i>
                                Kembali</a>
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
    window.action = "submit"
    window.hereApiKey = "{{ env('HERE_API_KEY') }}"
</script>
    <script src="{{ asset('js/here.js') }}"></script>
<script>
    // --- FUNCTION DELETE
    function confirmRadioButton(id) {
        let getVal = $('input[name="kantor_utama"]:checked').val();
        alertify.confirm("APAKAH ANDA YAKIN ?", function () {
            $.ajax({
                type: 'POST',
                url: '/api/instalasi/kantor-utama',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                    kantor_utama: getVal 
                },
                success: function (data) {
                    // $.alert('Generate Success!', data.token);
                    // Swal.fire({
                    //     title: 'Generate Success!',
                    //     text: 'Token : ' + data.token,
                    //     icon: 'success',
                    //     allowOutsideClick: false
                    // });
                    if (data.success == true) {
                        alertify.success(data.message);
                        setTimeout(() => {
                            location.reload();
                        },3000);
                    }else{
                        alertify.error(data.message);
                        setTimeout(() => {
                            location.reload();
                        },3000);
                    }
                },
                error: function (data) {
                    alertify.error('Error!');
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
</script>
@endpush
