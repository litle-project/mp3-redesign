@extends('layouts.app')

@push('styles')

@endpush

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row ">
            <div div class="col-lg-12">
                <div class="card animate__animated  animate__fadeIn">
                    <div class="card-header justify-content-between d-flex align-items-center">
                        <h4 class=" fw-bolder">{{ $page_title }}</h4>
                        
                        <div class="wd-100p">
                            <a href="{{route('master-data.struktur-organisasi.create')}}" class="btn btn-success float-end fw-bold"> Tambah Data <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="">
                        <div class="col-12">
                            @include('components.flash-message')
                        </div>

                        <table class="table-striped datatables" id="data-table" style="font-size: 16px">
                            <thead style="border-radius: 10px;">
                                <tr class="tr-head bg-simlog" style="border-radius: 10px;">
                                    <th style="border-top-left-radius: 10px;border-bottom-left-radius: 10px;"width="1%" >#</th>
                                    <th>Nama Struktur</th>
                                    <th>Nama Pegawai</th>
                                    <th>Atasan</th>
                                    <th style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;" class="td-head"  width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($strukturs as $struktur)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$struktur->name}}</td>
                                    <td>{{$struktur->Users->name}}</td>
                                    <td>{{($struktur->parent_id) ? 'Bawahan ' . $struktur->parent->name : 'Atasan'}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{route('master-data.struktur-organisasi.edit',$struktur->id)}}" class="btn rounded-3 btn-warning me-1" data-toggle="tooltip" title="Edit Data">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <button class="btn rounded-3 btn-danger" data-toggle="tooltip" title="Hapus Data" onclick="return confirmDelete('{{route('master-data.struktur-organisasi.destroy',$struktur->id)}}')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('#data-table').DataTable({});

</script>
@endpush