<div class="col-lg-12 mt-4">
<div class="card">
    <div class="card-body">
        <div class="hori-timeline">
            <!-- Swiper -->
            <div class="swiper-container slider">
                <div class="d-flex align-items-start">
                    <div class="flex-grow-1">
                        {{-- <h5 class="card-title mb-4">Progress Approval</h5> --}}
                    </div>
                    <div class="flex-shrink-0">
                        <div class="swiper-arrow d-flex gap-2 justify-content-end arrow-sm">
                            <div class="swiper-button-prev position-relative rounded-start">
                            </div>
                            <div class="swiper-button-next position-relative rounded-end"></div>
                        </div>
                    </div>
                </div>
                <div class="swiper-wrapper">
                    <div class="swiper-slide ">
                        <div class="event-list text-start">
                            <h5 class="font-size-14 mb-1 fw-bold mt-3">Permohonan Diajukan</h5>
                            <p class="text-muted">
                                {{date('d F T',strtotime($data->created_at))}} ||
                                {{date('H:i:s',strtotime($data->created_at))}}</p>
                        </div>
                    </div>
                    @if ($data->status == 'Disetujui')
                    <div class="swiper-slide ">
                        <div class="event-list text-start">
                            <h5 class="font-size-14 mb-1 fw-bold mt-3">Permohonan Disetujui</h5>
                            <p class="text-muted">
                                {{date('d F T',strtotime($data->updated_at))}} ||
                                {{date('H:i:s',strtotime($data->updated_at))}}</p>
                        </div>
                    </div>
                    @else
                        <div class="swiper-slide" style="">
                            <div class="event-list-pending text-start">
                                <h5 class="font-size-14 mb-1 fw-bold mt-3">Dalam Proses Approval</h5>
                                <p class="text-muted">
                                        {{date('d F T',strtotime($data->created_at))}} ||
                                        {{date('H:i:s',strtotime($data->created_at))}}
                                    {{-- {{$apv->role_to_name}} --}}
                                </p>
                            </div>
                        </div>
                    @endif


                    <!-- end swiper slide -->
                </div>


            </div>
        </div>
    </div>
    <!-- end card body -->
</div>
</div>
