@extends('layouts.app')

@push('styles')

@endpush

@section('content')
<div class="page-content">

<!-- end page title -->
<div class="row justify-content-center animate__animated  animate__fadeIn">
    <div class="col-lg-8">
        <div class="card shadow-lg">

            <div class="card-body p-4 text-center">
                <h2 class="mt-3">Halaman ini bermasalah </h2>
                <img src="{{asset('assets/images/error.webp')}}" alt="" height="400" width="auto">
                {{-- {{dd($exception)}} --}}
                <p>Detail masalah sudah dikirim , dan akan segera diperbaiki :)</p>
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

</script>
@endpush
