@extends('layouts.app')

@push('styles')
<style>
.circle-yellow
{
  width: 20px;
  height: 20px;
  border-radius: 50%;
  border: 1px solid;
  background-color: #FFFF00;
}
.circle-red
{
  width: 20px;
  height: 20px;
  border-radius: 50%;
  border: 1px solid;
  background-color: #ff0000;
}
.circle-green
{
  width: 20px;
  height: 20px;
  border-radius: 50%;
  border: 1px solid;
  background-color: #00FF00;
}
</style>
@endpush
@section('content')
<div class="page-content">
    <!-- end page title -->
    <div class="row animate__animated  animate__fadeIn">
        <div class="col-lg-12">
            <div class="card shadow-lg">
                <div class="card-header justify-content-between d-flex align-items-center">
                    <p class=" fw-bolder head-title text-uppercase"> <b>{{$page_title}}</b></p>
                    {{-- <div class="wd-100p">
                        <a href="{{route('pengajuan-cuti.create')}}" class="btn float-end fw-bold text-white" style="background-color: #001A88 !important;"> Ajukan Cuti <i class="fa fa-plus"></i></a>
                    </div> --}}
                </div>
                <div class="card-body">
                    <div class="col-12">
                        @include('components.flash-message')
                    </div>
                    <div class="d-flex flex-row-reverse bd-highlight mb-2">
                        <div class="p-1 bd-highlight">
                        <div class="wd-100p">
                                <a href="{{route('pengajuan-cuti.create')}}" class="btn  fw-bold text-white " style="margin-top:17px;margin-left:20px;background-color: #001A88 !important;"> Ajukan Cuti <i
                                class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <table class="table-striped datatables" id="data-table" style="font-size: 16px">
                        <thead>
                            <tr class="tr-head">
                                <th style="border-top-left-radius: 10px;border-bottom-left-radius: 10px;" width="1%">No</th>
                                <th>Nomor Permohonan</th>
                                <th>Tanggal Mulai Cuti</th>
                                <th>Tanggal Selesai Cuti</th>
                                <th>Perihal Cuti</th>
                                <th>Total Hari Cuti</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengajuan_cutis as $pengajuan_cuti)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <a href="{{route('pengajuan-cuti.review',$pengajuan_cuti->id)}}">{{$pengajuan_cuti->nomor_permohonan}}</a>
                                    @if (($pengajuan_cuti->persetujuanTerakhir()->role_to_name ?? null) == (Auth::user()->roles->first()->name ?? null))
                                             <span class="noti-dotnya bg-danger float-end" style="position: inherit"> ! </span>
                                    @endif
                                </td>
                                <td><div id="tanggal_mulai">{{$pengajuan_cuti->tanggal_mulai_cuti}}</div></td>
                                <td><div id="tanggal_selesai">{{$pengajuan_cuti->tanggal_selesai_cuti}}</div></td>
                                <td>{{$pengajuan_cuti->perihal_cuti}}</td>
                                <td>{{$pengajuan_cuti->total_hari_cuti}} hari</td>
                                <td>
                                    @if ($pengajuan_cuti->status == 'Disetujui')
                                        <div class="circle-green"></div>
                                    @elseif($pengajuan_cuti->status == 'Ditolak')
                                         <div class="circle-red"></div>
                                    @else
                                         <div class="circle-yellow"></div>
                                    @endif
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
</script>
@endpush
