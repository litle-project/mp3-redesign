<div class="col-lg-12 mt-2">
    <h2 class="fw-bolder">PESETUJUAN KEGIATAN LUAR KANTOR</h2>
    <div class="">
        @foreach ($data->approval as $d)
                <div class="card" style="border:solid 1px black;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <span class="text-muted d-block ">{{date('d F Y',strtotime($d->timestamp))}} || {{date('H:i',strtotime($d->timestamp))}} </span>
                                <span class="text-dark d-block fs-6 text-default fw-bolder ">{{$d->title}}</span>
                            </div>
                        </div>
                        <hr>





                        <div class="row">
                            <div class="col-lg-8 ">
                                <span class="text-muted d-block ">Arahan</span>
                                <span
                                    class="text-dark d-block fs-6 text-default fw-bolder ">{{$d->arahan ?? '-'}}</span>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>



        @endforeach

    </div>
</div>
