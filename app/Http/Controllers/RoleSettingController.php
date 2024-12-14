<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleSettingController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'List Pegawai';
        $data['pegawai'] = User::orderBy('id', 'desc')->get();
        return view('role-setting.index', $data);
    }

    public function setup($id)
    {
        $data['page_title'] = 'Setup Role & Atasan Langsung';
        $data['pegawai'] = User::find($id);
        $data['role'] = Role::all();
        return view('role-setting.setup', $data);
    }
    public function setupUpdate(Request $request,$id)
    {

        try {
            $pegawai = User::find($id);

            $pegawai->role_atasan_name = $request->role_atasan_name;
            $pegawai->save();

            // update role
            $role = Role::findByName($request->role_name);
            $pegawai->syncRoles($role);





            return redirect()->route('role-setting.index')->with(['success' => 'Data berhasil diupdate !']);
        } catch (\Throwable $th) {
            return redirect()->route('role-setting.index')->with(['failed' => $th->getMessage()]);
        }
    }
}
