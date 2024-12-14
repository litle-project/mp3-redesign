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
                    <form action="{{ route('role-setting.setup-update',$pegawai->id)}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label for=""><strong>Nama Pegawai</strong></label>
                                    <span class="d-block text-dark fs-4">{{$pegawai->name}}</span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for=""><strong>NIK</strong></label>
                                    <span class="d-block text-dark fs-4">{{$pegawai->nik}}</span>
                                </div>
                                <hr>
                                <div class="form-group mb-3">
                                    {{-- <label for=""><strong>{{$role->pluck('name')}}</strong></label> --}}
                                    <label for=""><strong>Pilih Role</strong></label>
                                    <select name="role_name" class="form-select" id="selectRole">
                                        <option value=""></option>
                                        @foreach ($role as $r)
                                        <option
                                            {{($pegawai->roles->first()->name ?? null) == $r->name ? 'selected=selected':''}}
                                            value="{{$r->name}}">{{$r->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for=""><strong>Atasan Langsung</strong></label>
                                    <select name="role_atasan_name" class="form-select" id="selectAtasan">
                                        <option value=""></option>
                                        @foreach ($role as $r)
                                        <option
                                            {{($pegawai->role_atasan_name ?? null) == $r->name ? 'selected=selected':''}}
                                            value="{{$r->name}}">{{$r->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mt-2">
                            <button class="btn btn btn-success">
                                <i class="fa fa-save"></i>
                                Update</button>
                            <a href="{{route('role-setting.index')}}" class="btn btn btn-danger"><i
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

@endsection

@push('scripts')
<script>
    // $('#selectRole').on('change',function(){
    //     let selectRole = this.value;
    //     ["Seksi Pengadaan","Admins","Kepala Distrik Navigasi","Kabid Operasi","Kabid Logistik","Kabag Tata Usaha","Kasie Sarana Prasarana","Kasie Program","Kasie Pengadaan","Kasie Penghapusan","Kasie Keuangan","Kasie Kepegawaian","Pengelola Absensi","Pengelola Lembur","Kepala Kelompok Bengkel","Kepala Kelompok SBNP","Kepala Kelompok Pengamatan Laut","Kepala Kelompok Kapal Negara","Kepala Kelompok Telkompel","Staff"]
    //     if (condition) {
    //         naem
    //     }
    // })

</script>
<script src="{{ asset('js/here.js') }}"></script>
@endpush
