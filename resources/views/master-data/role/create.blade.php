@extends('layouts.app')

@push('styles')
    
@endpush

@section('content')
<div class="page-content">
    <div class="row animate__animated  animate__fadeIn">
        <div class="col-lg-6">
            <form method="POST" action="{{ route('master-data.role.store') }}" novalidate>
                @csrf
                <div class="card  animate__animated  animate__fadeIn" id="">
                    <div class="card-header" style="border-radius:15px 15px 0px 0px;">
                        <h3 class="card-title">Create Role</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="name"><strong>Nama</strong></label>
                                    <input type="text" name="name" class="form-control" placeholder="">
                                </div>
                                <div class="form-group mb-4">
                                    <label class="form-label" for=""><strong>Permissions</strong></label> <br>
                                    <small>Select All</small>
                                    <input type="checkbox" id="checkbox">
                
                                    <div class="select2-purple">
                                        <select class="select2" name="permissions[]" id="e1" data-placeholder="Select The Permissions" multiple data-dropdown-css-class="select2-purple" style="width: 100%;">
                                            @foreach ($permissions as $permission)
                                                <option value="{{$permission->id}}" 
                                                    @foreach (old('permissions') ?? [] as $id)
                                                        @if ($id == $permission->id)
                                                            {{ ' selected' }}
                                                        @endif
                                                    @endforeach>
                                                    {{$permission->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                
                                    @error('permissions')
                                        <span class="text-danger text-sm">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-success" type="submit">
                                <i class="fa fa-save"></i>
                                Simpan
                            </button>
                            <a href="{{route('master-data.role.index')}}" class="btn btn-danger" type="submit">
                                <i class="fa fa-arrow-left"></i>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script>
         $("#checkbox").click(function () {
            if ($("#checkbox").is(':checked')) {
                $("#e1 > option").prop("selected", "selected");
                $("#e1").trigger("change");
            } else {
                $("#e1 > option").removeAttr("selected");
                $("#e1").val("");
                $("#e1").trigger("change");
            }
        });
    </script>
@endpush