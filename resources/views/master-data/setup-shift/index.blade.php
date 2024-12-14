@extends('layouts.app')

@push('styles')

@endpush
@section('content')
<div class="page-content">
    <!-- end page title -->
    <div class="row animate__animated  animate__fadeIn">
        <div class="col-lg-12">
            <div class="card shadow-lg">
                <div class="card-header justify-content-between d-flex align-items-center">
                    <h4 class="card-title">{{$page_title}}</h4>

                    <div class="wd-100p">
                        <a href="{{route('master-data.setup-shift.create')}}" class="btn btn-success float-end fw-bold"> Tambah Data <i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        @include('components.flash-message')
                    </div>
                    <table class="table-striped datatables" id="data-table" style="font-size: 16px">
                        <thead>
                            <tr class="tr-head">
                                <th style="border-top-left-radius: 10px;border-bottom-left-radius: 10px;" width="1%">No
                                </th>
                                <th>Nama Shift</th>
                                <th>Nama Pegawai</th>
                                <th>Jam Masuk</th>
                                <th>Jam Pulang</th>
                                <th>Instalasi</th>
                                <th style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;" class="td-head" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shifts as $shift)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$shift->nama_shift}}</td>
                                <td>
                                    <button onclick="detailPegawai({{$shift->id}})" class="btn btn-info btn-sm"><i class="ti-eye"></i> Detail Pegawai </button>
                                </td>
                                <td>{{$shift->jam_masuk}}</td>
                                <td>{{$shift->jam_pulang}}</td>
                                <td>{{$shift->Instalasis->nama_instalasi}}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{route('master-data.setup-shift.edit',$shift->id)}}" data-toggle="tooltip" title="Edit Data" class="btn rounded-3 btn-warning me-1">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <button class="btn rounded-3 btn-danger" data-toggle="tooltip" title="Hapus Data" onclick="return confirmDelete('{{route('master-data.setup-shift.destroy',$shift->id)}}')">
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

    <!-- end row -->

</div> <!-- container-fluid -->
</div>
@endsection

@push('scripts')
<script>
    $('#data-table').DataTable({
        //   "pageLength": 3

    });

    function detailPegawai(id) {
        $.confirm({
            title: 'Detail Pegawai',
            theme: 'material',
            backgroundDismiss: true, // this will just close the modal
            content: 'url:setup-shift/' + id + '/detail',
            onContentReady: function () {
                var self = this;
                // this.setContentPrepend('<div>Prepended text</div>');
                // setTimeout(function () {
                //     self.setContentAppend('<div>Appended text after 2 seconds</div>');
                // }, 2000);
            },
            columnClass: 'medium',
        });
    }
</script>
@endpush
