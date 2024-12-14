


@extends('layouts.app')


@push('styles')

<style>


</style>

@endpush
@section('content')
<div class="page-content">
    <div class="row animate__animated  animate__fadeIn">
        <div class="col-lg-12">
            <div class="card shadow-lg">
                <div class="card-header justify-content-between d-flex align-items-center">
                    <h4 class="card-title">{{$page_title}}</h4>

                    <div class="wd-100p">
                        <a href="{{route('master-data.instalasi.create')}}" class="btn btn-success float-end fw-bold"> 
                            Tambah Data 
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        @include('components.flash-message')
                    </div>
                    <table class="table-striped datatables" id="data-table" style="font-size: 16px">
                        <thead style="border-radius: 10px;">
                            <tr class="tr-head bg-simlog" style="border-radius: 10px;">
                                <th style="border-top-left-radius: 10px;border-bottom-left-radius: 10px;"width="1%">No</th>
                                <th>Nama Instalasi</th>
                                <th>latitude</th>
                                <th>longitude</th>
                                <th>Radius</th>
                                <th>Alamat Instalasi</th>
                                <th style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;"class="td-head"  width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($instalasis as $instalasi)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$instalasi->nama_instalasi}}</td>
                                <td>{{$instalasi->latitude}}</td>
                                <td>{{$instalasi->longitude}}</td>
                                <td>{{$instalasi->radius}} m</td>
                                <td>{{$instalasi->alamat_instalasi}}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{route('master-data.instalasi.edit',$instalasi->id)}}" data-toggle="tooltip" title="Edit Data"
                                            class="btn rounded-3 btn-warning me-1">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <button class="btn rounded-3 btn-danger" data-toggle="tooltip" title="Hapus Data" onclick="return confirmDelete('{{route('master-data.instalasi.destroy',$instalasi->id)}}')">
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
</div> <!-- container-fluid -->
@endsection

@push('scripts')
<script>
    $('#data-table').DataTable({
        //   "pageLength": 3

    });

</script>
@endpush
