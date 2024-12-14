<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:read', ['only' => 'read']);
        $this->middleware('permission:create', ['only' => ['create']]);
        $this->middleware('permission:edit', ['only' => ['edit']]);
        $this->middleware('permission:delete', ['only' => ['delete']]);
    }

    public function index()
    {
        $data['page_title'] = 'List Role';
        $data['breadcumb'] = 'List Role';
        $data['roles'] = Role::orderby('id', 'asc')->get();

        return view('master-data.role.index', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Create Role';
        $data['permissions'] = Permission::all();

        return view('master-data.role.create',$data);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required',
        ]);

        try {
            $role = new Role();
            $role->name = $validateData['name'];

            $role->save();
            $role->syncPermissions($validateData['permissions']);

            return redirect()->route('master-data.role.index')->with(['success' => 'Data berhasil dibuat !']);
        } catch (\Throwable $th) {
            return redirect()->route('master-data.role.index')->with(['failed' => $th->getMessage()]);
        }

    }

    public function show($id)
    {
        $data['role'] = Role::findOrFail($id);

        return view('master-data.role.show', $data);
    }

    public function edit($id)
    {
        $data['page_title'] = 'Edit Role';
        $data['role'] = Role::find($id);
        $data['permissions'] = Permission::get();
        $data['rolePermissions'] = DB::table("role_has_permissions")
        ->where("role_has_permissions.role_id",$id)
        ->pluck('role_has_permissions.permission_id')
        ->all();

        return view('master-data.role.edit',$data);
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:roles,name,'.$id,
            'permissions' => 'required',
        ]);

        try {
            $role = Role::find($id);
            $role->name = $validateData['name'];

            $role->save();
            $role->syncPermissions($validateData['permissions']);

            return redirect()->route('master-data.role.index')->with(['success' => 'Data berhasil diupdate !']);
        } catch (\Throwable $th) {
            return redirect()->route('master-data.role.index')->with(['failed' => $th->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $role = Role::findOrFail($id);
                $role->delete();
            });
            return redirect()->route('master-data.kapal-negara.index')->with(['failed' => 'Data berhasil dihapus !']);
        } catch (\Throwable $th) {
            return redirect()->route('master-data.kapal-negara.index')->with(['failed' => $th->getMessage()]);
        }
    }
}
