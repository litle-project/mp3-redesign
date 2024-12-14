<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>
<script src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<!-- JAVASCRIPT -->
<script src="{{asset('/mp3')}}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('/mp3')}}/libs/metismenujs/metismenujs.min.js"></script>
<script src="{{asset('/mp3')}}/libs/simplebar/simplebar.min.js"></script>
<script src="{{asset('/mp3')}}/libs/feather-icons/feather.min.js"></script>

<!-- apexcharts -->
<script src="{{asset('/mp3')}}/libs/apexcharts/apexcharts.min.js"></script>



{{-- <script src="{{asset('/mp3')}}/js/pages/dashboard-sales.init.js"></script> --}}
<script>
    var baseUrl = @json(asset('/mp3'));
    document.body.setAttribute('data-sidebar-size', 'lg')

</script>
<script src="{{asset('/mp3')}}/js/app.js"></script>
<script src="{{asset('/mp3')}}/libs/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('/mp3')}}/libs/alertifyjs/build/alertify.min.js"></script>
<script src="{{asset('mp3/js/jspdf.min.js')}}"></script>
<script src="{{asset('mp3/js/html2canvas.js')}}"></script>
<script src="{{asset('mp3/js/FileSaver.min.js')}}"></script>
{{-- <script src="{{asset('mp3/js/all.min.js')}}"></script> --}}
<script src="{{asset('mp3/libs/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('mp3/js/resize.js')}}"></script>
<!-- Jquery Confirm -->
<script src="{{ asset('plugins/jquery-confirm/js/jquery-confirm.js') }}"></script>
<script src="{{asset('/mp3')}}/libs/%40simonwep/pickr/pickr.min.js"></script>
{{-- <script src="{{asset('/mp3/libs/select2/select2.min.js')}}"></script> --}}
<script src="{{asset('mp3/libs/axios/axios.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('js/moment/moment.min.js')}}"></script>
<script src="{{ asset('backend/libs/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables/buttons.flash.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('backend/libs/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables/buttons.print.min.js') }}"></script>

@stack('scripts')
<script>
    $( document ).ready(function() {
        $('#preloader').addClass('d-none');
    });
    
    $('.ada').val();

    flatpickr(".datepicker-basic", {
        dateFormat: "d-m-Y"
    });

    $(".select2").select2();

    // --- FUNCTION DELETE
    function confirmDelete(urlDelete) {
        alertify.confirm("APAKAH ANDA YAKIN HAPUS DATA ?", function () {
            window.location = urlDelete;
        }, function () {
            alertify.error("Cancel")
        }).set('labels', {
            ok: 'IYA',
            cancel: 'TIDAK',
        }).set({
            title: `<img height="60px" src="{{asset('images/background/modisLogo.png')}}">`
        })
    }

    // --- FUNCTION SAVE
    function confirmSave(formId) {
        alertify.confirm("APAKAH ANDA YAKIN DATA SUDAH BENAR ?", function () {
            var formNya =  $('#'+formId);
            formNya.submit();
        }, function () {
            alertify.error("Cancel")
        }).set('labels', {
            ok: 'IYA',
            cancel: 'TIDAK',
        }).set({
            title: `<img height="60px" src="{{asset('assets/images/logo.png')}}">`
        })
    }

    function detailModal(title, url, width) {
        $.confirm({
            title: title,
            theme : 'material',
            backgroundDismiss: true, // this will just close the modal
            content: 'URL:'+url,
            animation: 'zoom',
            closeAnimation: 'scale',
            animationSpeed: 400,
            closeIcon: true,
            columnClass: width,
            buttons: {
                close: {
                    btnClass: 'btn-dark font-bold',
                }
            },
        });
    }

    function resizeChart(divId) {
        var chart = echarts.init(document.getElementById(divId));
        new ResizeSensor(jQuery('#' + divId), function () {
            chart.resize();
        })
    }
    $(".select2").select2();

    function logout() {
        $.confirm({
            icon: 'fas fa-sign-out-alt',
            title: 'Logout',
            theme: 'supervan',
            content: 'Are you sure want to logout?',
            autoClose: 'cancel|8000',
            buttons: {
                logout: {
                    text: 'logout',
                    action: function () {
                        $.ajax({
                            type: 'POST',
                            url: '/logout',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function (data) {
                                location.reload();
                            },
                            error: function (data) {
                                $.alert('Failed!');
                                console.log(data);
                            }
                        });
                    }
                },
                cancel: function () {

                }
            }
        });
    }

</script>
