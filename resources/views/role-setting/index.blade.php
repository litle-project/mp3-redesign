@extends('layouts.app')

@section('content')
<div class="page-content">

    <!-- end page title -->
    <div class="row animate__animated  animate__fadeIn">
        <div class="col-lg-12">
            <div class="card shadow-lg">
                <div class="card-header justify-content-between d-flex align-items-center">
                    <h4 class="card-title">{{$page_title}}</h4>


                </div>
                <div class="card-body">
                    <div class="col-12">
                        @include('components.flash-message')
                    </div>
                    <table class="table-striped datatables" id="data-table" style="font-size: 16px">
                        <thead style="border-radius: 10px;">
                            <tr class="tr-head bg-simlog" style="border-radius: 10px;">
                                <th style="border-top-left-radius: 10px;border-bottom-left-radius: 10px;" width="1%">No
                                </th>
                                <th>NAMA PEGAWAI</th>
                                <th>NIK</th>
                                <th>POSISI DALAM ORGANISASI</th>
                                <th>ATASAN LANGSUNG</th>
                                <th style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;"
                                    class="td-head" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pegawai as $pgw)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$pgw->name}}</td>
                                <td>{{$pgw->nik}}</td>
                                <td>
                                    {!!($pgw->roles->first()->name ?? null) ? '<span
                                        class="d-block fw-bolder">'.$pgw->roles->first()->name.'</span>': '<span
                                        class="d-block fw-bolder text-danger">N/A</span>'!!}

                                </td>
                                <td>
                                    {!!($pgw->role_atasan_name ?? null) ? '<span
                                        class="d-block fw-bolder">'.$pgw->role_atasan_name.'</span>': '<span
                                        class="d-block fw-bolder text-danger">N/A</span>'!!}

                                </td>
                                <td>
                                    <a href="{{route('role-setting.setup',$pgw->id)}}">
                                        <button class="btn btn-primary " style="white-space: nowrap">SETUP ROLE
                                            PEGAWAI</button>
                                    </a>
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
@endsection

@push('scripts')
<script>
    $('#data-table').DataTable({});
</script>
@endpush
