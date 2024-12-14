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
                    <form action="{{ route('master-data.koordinat-kantor.update', $koordinat_kantor->id) }}" method="post">
                        @method('patch')
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group mb-3">
                                    <label for=""><strong>Latitude</strong></label>
                                    <input  class="form-control @error('latitude') is-invalid @enderror" step="any" type="number" name="latitude" id="latitude" placeholder="input latitude" value="{{$koordinat_kantor->latitude ?? ''}}">

                                    @error('latitude')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group mb-3">
                                    <label for=""><strong>Longitude</strong></label>
                                    <input  class="form-control @error('longitude') is-invalid @enderror" step="any" type="number" name="longitude" id="longitude" placeholder="input longitude" value="{{$koordinat_kantor->longitude ?? ''}}">

                                    @error('longitude')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group mb-3">
                                    <label for=""><strong>Radius </strong><small>(meter)</small></label>
                                    <input  class="form-control @error('radius') is-invalid @enderror"  type="number" name="radius" id="radius" placeholder="input radius" value="{{$koordinat_kantor->radius ?? ''}}">

                                    @error('radius')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        <div class="row">
                            <div class="col-lg-12" style="border-radius: 10px; border:1px solid #e0e2e7;">
                                <div class=" animate__animated  animate__fadeIn" id="formInternalUser">
                                    <div id="here-maps" class="form-group mb-3 text-center">
                                        <label class="form-label mt-1" for=""><strong>Pin Location</strong></label>
                                        <div style="height: 36.5rem; border-radius: 10px; border:1px solid #e0e2e7;" id="mapContainer"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                        <div class="mt-2">
                            <button class="btn btn btn-success">
                                <i class="fa fa-save"></i>
                                Simpan</button>
                            <a href="{{route('master-data.koordinat-kantor.index')}}" class="btn btn btn-danger"><i
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
@endpush
