<div class="table-responsive">
    <table class="table table-striped datatables table-hover mb-0" id="data-table">
        <thead>
            <tr class="tr-head bg-simlog">
                <th>No</th>
                <th>Permission</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($role->permissions as $permission)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $permission->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>