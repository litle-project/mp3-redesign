@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('mp3/libs/main.css') }}">
@endpush

@section('content')
<div class="page-content" style="">
    <div class="container-fluid">
        <div class="row d-flex justify-content-between">
            <div class="col-8">
                <p class="fw-bolder text-uppercase">CALENDER</p>
            </div>
            <div class="col-4">
                <div class="text-end">
                    <span>{{ $dateNowID }}</span>
                </div>
            </div>
            <hr>
        </div>

        <div class="row">
            <div class="col-lg-12 mt-3">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="col-12">
                            @include('components.flash-message')
                        </div>
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<!-- end page title -->


 <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal  fade" id="modal-perintah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content" style="border:none;">
                <div class="modal-header" style="background: #001A88;">
                    <h5 class="modal-title text-white" id="exampleModalScrollableTitle">TAMBAH EVENT </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
                </div>
                <form action="{{ route('add-event-calender', ['id' => Auth::user()->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="fw-bold" for="">Judul</label>
                            <input type="text" name="judul_event" class="form-control" id="judul_event">
                        </div>
                        {{-- <div class="form-group mb-3">
                            <label class="fw-bold" for="">Warna</label>
                            <input type="color" name="color_event" class="form-control" id="color_event">
                        </div> --}}
                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="fw-bold" for="tanggal_event">Tanggal Event</label>
                                    <input type="date" name="tanggal_event" class="form-control"
                                        id="tanggal_event">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="fw-bold" for="jam_event">Jam Event</label>
                                    <input type="time" name="jam_event" class="form-control"
                                        id="jam_event">
                                    <small class="text-danger">*(Kosongkan jika tidak ingin di isi)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="background: #001A88;">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn text-white btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal -->
    <!-- End Button trigger modal -->
@endsection

@push('scripts')
<script type="text/javascript" src="{{ asset('mp3/libs/main.js') }}"></script>

<script>
    var newArray = [];
    getDataHariLibur()
    async function getDataHariLibur(){
        let resp = await axios.get('https://api-harilibur.vercel.app/api');

        let data = resp.data;
        var filterArray = data.filter(function (el) {
            return el.is_national_holiday == true;
        });
        filterArray.forEach(element => {
            let newDate = new Date(element.holiday_date);
            const object = {title : element.holiday_name,
                            start : moment(newDate).format('YYYY-MM-DD'),
                            end   : moment(newDate).format('YYYY-MM-DD'),
                            color : '#DC3545',}
            newArray.push( object );
        });
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        $( document ).ready(function() {
        let dataEvent = @json($arrayEvent);
        let concatData = newArray.concat(dataEvent);
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            events: concatData,
            // events: [{title: 'test', start:'2022-07-07', allDay: true},{title: 'rapat', start:'2022-07-08 12:30:00', allDay: false, background:'#red'},{title: 'test', start:'2022-07-07T12:30:00', allDay: false},{title: 'test', start:'2022-07-07T12:30:00', allDay: false},{title: 'test', start:'2022-07-07T12:30:00', allDay: false},{title: 'test', start:'2022-07-07T12:30:00', allDay: false}],
            initialView: 'dayGridMonth',
            dayMaxEventRows: true,
            views: {
                timeGrid: {
                dayMaxEventRows: 1 // adjust to 6 only for timeGridWeek/timeGridDay
                }
            },
            buttonText: {
                    list: 'Agenda',
                    dayGridMonth: 'Month',
                    timeGridWeek: 'Week',
                    timeGridDay: 'Day',
                    prev: 'Prev',
                    next: 'Next',
                    },
            headerToolbar: {
                start: 'title', // will normally be on the left. if RTL, will be on the right
                end: 'prev,next', // will normally be on the right. if RTL, will be on the left
            },
            themeSystem: 'bootstrap5',
            selectable: true,
            dateClick: function(info) {
                $('#modal-perintah').modal('toggle');
                $('#tanggal_event').val(info.dateStr);
            }
        });
            calendar.render();
        });
    });

  </script>
@endpush