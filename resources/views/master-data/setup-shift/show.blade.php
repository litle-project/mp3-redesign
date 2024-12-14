<link href="{{asset('/mp3')}}/libs/datatables.net-dt/css/jquery.dataTables.min.css" id="app-style"
rel="stylesheet" type="text/css" />

<table class="table table-striped " style="font-size: 16px">
    <thead>
        <tr class="tr-head">
            <th width="1%">No</th>
            <th>Nama Pegawai</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($shift->Users as $shift_user)
        
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$shift_user->name}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<script src="{{asset('/mp3')}}/libs/datatables/jquery.dataTables.min.js"></script>
<script>
     $('#detail-user').DataTable({
        //   "pageLength": 3

    });
</script>