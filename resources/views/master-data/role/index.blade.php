@extends('layouts.app')

@section('style')
@endsection

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-8">
                <div class="card animate__animated  animate__fadeIn">
                    <div class="card-header justify-content-between d-flex align-items-center">
                        <h4 class=" fw-bolder">{{ $page_title }}</h4>

                        <div class="wd-100p">
                            <a href="{{route('master-data.role.create')}}" class="btn btn-success float-end fw-bold"> Tambah Data <i class="fa fa-plus"></i></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="col-12">
                            @include('components.flash-message')
                        </div>
  
                        <table class="table-striped datatables" id="data-table" style="font-size: 16px">
                            <thead style="border-radius: 10px;">
                                <tr class="tr-head bg-simlog" style="border-radius: 10px;">
                                    <th style="border-top-left-radius: 10px;border-bottom-left-radius: 10px;"width="1%" >#</th>
                                    <th>Nama</th>
                                    <th  width="35%">Permissions</th>
                                    <th style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;"class="td-head"  width="12%">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <button onclick="detailModal('Permission', 'role/' + {{ $role->id }}, 'small')" class="btn rounded-3 btn-primary">
                                            <i class="fa fa-info-circle"></i>Show Permissions
                                        </button>
                                    </td>
                                    @if(auth()->user()->can('delete') || auth()->user()->can('edit'))
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{route('master-data.role.edit',$role->id)}}" class="btn rounded-3 btn-warning me-1" data-toggle="tooltip" title="Edit Data">
                                                <i class="fa fa-edit ms-1"></i>
                                            </a>

                                            <button class="btn rounded-3 btn-danger" data-toggle="tooltip" title="Hapus Data" onclick="return confirmDelete('{{route('master-data.role.destroy',$role->id)}}')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                    @endif
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

    {{-- Modal --}}
    @foreach ($roles as $role)
    <div class="modal fade w-500" id="showModal{{ $role->id }}" tabindex="-1" role="dialog"
        aria-labelledby="ShowPermission" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Permission {{ $role->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <ul>
                        @foreach ($role->permissions as $permission)
                        <li>{{ $loop->iteration . '. ' . $permission->name }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    {{-- End Modal --}}
    
@endsection

@push('scripts')
<script>
    $('#data-table').DataTable({});

</script>
@endpush