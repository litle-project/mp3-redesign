@extends('layouts.app')
@push('styles')

@endpush

@section('content')
<div class="page-content">
    <div class="row animate__animated  animate__fadeIn">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header justify-content-between d-flex align-items-center">
                    <h4 class="card-title">{{$page_title}} - {{$data->no_surat}}</h4>
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
                    <div class="row">
                        <div class="col-lg-12 mt-2">
                            <div class="col-12 p-3" style="border:solid 1px black; border-radius:10px;">
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <span class="text-muted d-block fs-6 ">Perihal Dinas</span>
                                        <span class="text-default fw-bolder d-block fs-6">{{$data->perihal_dinas}}</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-lg-4">
                                        <span class="text-muted d-block fs-6 ">Tanggal Mulai Dinas</span>
                                        <span class="text-default fw-bolder d-block fs-6">{{$data->tanggal_mulai_dinas}}</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <span class="text-muted d-block fs-6 ">Tanggal Selesai dinas</span>
                                        <span class="text-default fw-bolder d-block fs-6">{{$data->tanggal_selesai_dinas}}</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <span class="text-muted d-block fs-6 ">Total Hari Dinas</span>
                                        <span class="text-default fw-bolder d-block fs-6">{{$data->getTotalHariDinas($data->tanggal_mulai_dinas,$data->tanggal_selesai_dinas). ' Hari'}}</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-lg-4">
                                        <span class="text-muted d-block  fs-6 ">Kota Kedinasan</span>
                                        <span class="text-default fw-bolder d-block fs-6">{{$data->kota_kedinasan}}</span>
                                    </div>
                                    <div class="col-lg-8">
                                        <span class="text-muted d-block fs-6 ">Alamat Kedinasan</span>
                                        <span class="text-default fw-bolder d-block fs-6">{{$data->alamt_kedinasan}}</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-lg-12">
                                        <span class="text-muted d-block fs-6 ">Keterangan</span>
                                        <span class="text-default fw-bolder d-block fs-6">{{$data->keterangan}}</span>
                                    </div>
                                </div>
                                <hr>
                                <h4 class="fw-bold">Dokumen<span class="text-danger">*</span></h4>
                                <div class="row mb-3">
                                    @foreach (($data->dokumenDinasLuarKotas) as $document)
                                    <div class="col-2 d-flex justify-content-center mt-3">
                                        <div class="me-3">
                                            @php
                                                $path = $document->filename;
                                                $ext = pathinfo($path, PATHINFO_EXTENSION);
                                            @endphp 
                                            <a href="{{ asset('dokumen/dokumen-dinas-luar/'.$document->filename) }}" target="_blank">
                                                @if ($ext == 'pdf'|| $ext == 'xlxs'||$ext == 'pdf'||$ext == 'docx')
                                                    <img class="" src="{{ asset('images/icon/docs.png') }}" alt="Document" title="{{ $document->filename }}">
                                                @elseif($ext == 'jpg'||$ext == 'png'||$ext == 'jpeg')
                                                    <img class="" src="{{ asset('images/icon/image.png') }}" alt="Image" title="{{ $document->filename }}">
                                                @endif
                                                <p>{{ Str::limit($document->filename ?? "N/A", 8, '...') }}</p>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')

@endpush
