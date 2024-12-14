@extends('layouts.app')


@section('content')
<div class="page-content">

    <!-- end page title -->
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
                    <form action="{{ route('master-data.libur-nasional.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label for=""><strong>Tanggal</strong></label>
                                    <input  class="form-control  @error('tanggal') is-invalid @enderror"  type="date" name="tanggal" id="tanggal" placeholder="Pilih tanggal" value="{{old('tanggal')}}">

                                    @error('tanggal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label for=""><strong>Nama Hari Libur</strong></label>
                                    <input  class="form-control @error('nama_hari_libur') is-invalid @enderror"  type="text" name="nama_hari_libur" id="nama_hari_libur" placeholder="input nama hari libur" value="{{old('nama_hari_libur')}}">

                                    @error('nama_hari_libur')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label for=""><strong>Keterangan</strong></label>
                                    <input  class="form-control @error('keterangan') is-invalid @enderror"  type="text" name="keterangan" id="keterangan" placeholder="input keterangan" value="{{old('keterangan')}}">

                                    @error('keterangan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button class="btn btn btn-success">
                                <i class="fa fa-save"></i>
                                Simpan</button>
                            <a href="{{route('master-data.libur-nasional.index')}}" class="btn btn btn-danger"><i
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
