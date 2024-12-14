<?php

namespace App\Http\Controllers;

use App\Models\HistoryLog;
use App\Models\User;
use Exception;
Use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use App\Models\Pangkat;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:read', ['only' => 'index']);
    //     $this->middleware('permission:create', ['only' => ['create']]);
    //     $this->middleware('permission:edit', ['only' => ['edit']]);
    //     $this->middleware('permission:delete', ['only' => ['destroy']]);
    // }
    
    public function index()
    {
        $data['page_title'] = 'Data Pegawai';
        $data['users'] = User::orderby('id', 'asc')->get();

        return view('master-data.user.index', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Tambah User';
        $data['breadcumb'] = 'Tambah User';
        $data['pangkats'] = Pangkat::get();
        // $data['roles'] = Role::pluck('name')->all();

        return view('master-data.user.create', $data);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name'   => 'required|string|min:3',
            'username'   => 'required|unique:users,username|alpha_dash',
            'email'   => 'required|email|unique:users,email',
            'password' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            // 'role' => 'required',
            'nip' => 'required',
            'jenis_kelamin' => 'required',
            'status_pegawai' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'nik' => 'required',
            'npwp' => 'required',
            'nomor_telepon' => 'required',
            'alamat_ktp' => 'nullable',
            'alamat_tinggal' => 'nullable',
            'longitude' => 'required',
            'latitude' => 'required',
            'pangkat_id' => 'required',
        ]);
        
        try {
            $user = new User();
            $user->name = $validateData['name'];
            $user->username = $validateData['username'];
            $user->password = Hash::make($validateData['password']);
            $user->email = $validateData['email'];
            $user->nip = $validateData['nip'];
            $user->jenis_kelamin = $validateData['jenis_kelamin'];
            $user->status_pegawai = $validateData['status_pegawai'];
            $user->tempat_lahir = $validateData['tempat_lahir'];
            $user->tanggal_lahir = date('Y-m-d',strtotime($validateData['tanggal_lahir']));
            $user->nik = $validateData['nik'];
            $user->npwp = $validateData['npwp'];
            $user->nomor_telepon = $validateData['nomor_telepon'];
            $user->longitude = $validateData['longitude'];
            $user->latitude = $validateData['latitude'];
            $user->alamat_ktp = $validateData['alamat_ktp'];
            $user->alamat_tinggal = $validateData['alamat_tinggal'];
            $user->pangkat_id = $validateData['pangkat_id'];
            
            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('img/users/');
                $image->move($destinationPath, $name);
                $user->foto = $name;
            }
    
            $user->save();
            // $user->assignRole($validateData['role']);
    
            return redirect()->route('master-data.user.index')->with(['success' => 'Data berhasil dibuat !']);
        } catch (Exception $e) {
            return redirect()->route('master-data.user.index')->with(['failed' => $e->getMessage()]);
        }
        
    }

    public function edit($id)
    {
        $data['page_title'] = 'Edit User';
        $data['breadcumb'] = 'Edit Data Pegawai';
        $data['user'] = User::findOrFail($id);
        $data['pangkats'] = Pangkat::get();
        // $data['roles'] = Role::pluck('name')->all();

        return view('master-data.user.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'name'   => 'required|string|min:3',
            'username'   => 'required|alpha_dash|unique:users,username,'.$id,
            'email'   => 'required|unique:users,email,'.$id,
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            // 'role' => 'required',
            'nip' => 'required',
            'jenis_kelamin' => 'required',
            'status_pegawai' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'nik' => 'required',
            'npwp' => 'required',
            'nomor_telepon' => 'required',
            'alamat_ktp' => 'nullable',
            'alamat_tinggal' => 'nullable',
            'longitude' => 'required',
            'latitude' => 'required',
        ]);
        try {
            $user = User::findOrFail($id);
            $user->name = $validateData['name'];
            $user->username = $validateData['username'];
            $user->email = $validateData['email'];
            $user->nip = $validateData['nip'];
            $user->jenis_kelamin = $validateData['jenis_kelamin'];
            $user->status_pegawai = $validateData['status_pegawai'];
            $user->tempat_lahir = $validateData['tempat_lahir'];
            $user->tanggal_lahir = date('Y-m-d',strtotime($validateData['tanggal_lahir']));
            $user->nik = $validateData['nik'];
            $user->npwp = $validateData['npwp'];
            $user->nomor_telepon = $validateData['nomor_telepon'];
            $user->longitude = $validateData['longitude'];
            $user->latitude = $validateData['latitude'];
            $user->alamat_ktp = $validateData['alamat_ktp'];
            $user->alamat_tinggal = $validateData['alamat_tinggal'];
            $user->pangkat_id = $request->pangkat_id;

            
            if ($request->hasFile('foto')) {
                // Delete Img
                if ($user->foto) {
                    $image_path = public_path('img/users/'.$user->foto); // Value is not URL but directory file path
                    if (File::exists($image_path)) {
                        File::delete($image_path);
                    }
                }
                
                $image = $request->file('foto');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('img/users/');
                $image->move($destinationPath, $name);
                $user->foto = $name;
            }
    
            $user->save();
            // DB::table('model_has_roles')->where('model_id',$id)->delete();
            // $user->assignRole($validateData['role']);
    
            return redirect()->route('master-data.user.index')->with(['success' => 'Data berhasil diupdate !']);
        } catch (Exception $e) {
            return redirect()->route('master-data.user.index')->with(['failed' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $user = User::findOrFail($id);
                if ($user->foto) {
                    $image_path = public_path('img/users/'.$user->foto); // Value is not URL but directory file path
                    if (File::exists($image_path)) {
                        File::delete($image_path);
                    }
                }
    
                $user->delete();
            });
            
            return redirect()->route('master-data.user.index')->with(['failed' => 'Data berhasil dihapus !']);
        } catch (\Throwable $th) {
            return redirect()->route('master-data.user.index')->with(['failed' => $th->getMessage()]);
        }
    }

    public function changePassword(Request $request)
    {
        $validateData = $request->validate([
            'password' => 'required',
            'new_password' => 'required',
        ]);
        try {
            $user = User::findOrFail(Auth::user()->id);

            if (Hash::check($validateData['password'], $user->password)) {
                $user->password = Hash::make($request->get('new_password'));
                $user->save();

                return redirect()->route('user-setting', Auth::user()->id)->with('success', 'Password changed successfully!');
            }
        } catch (\Throwable $th) {
            return redirect()->route('user-setting', Auth::user()->id)->with('failed', 'Password change failed'. $th->getMessage());
        }
    }

    public function userSetting($id)
    {
        $data['page_title'] = 'Setting User';
        // $data['breadcumb'] = 'Setting Data Pegawai';
        $data['user'] = User::findOrFail($id);
        $data['pangkats'] = Pangkat::get();
        // $data['roles'] = Role::pluck('name')->all();

        return view('master-data.user.user-setting', $data);
    }
    public function userSettingUpdate(Request $request, $id)
    {
        $validateData = $request->validate([
            'name'   => 'required|string|min:3',
            'username'   => 'required|alpha_dash|unique:users,username,'.$id,
            'email'   => 'required|unique:users,email,'.$id,
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            // 'role' => 'required',
            'nip' => 'required',
            'jenis_kelamin' => 'required',
            'status_pegawai' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'nik' => 'required',
            'npwp' => 'required',
            'nomor_telepon' => 'required',
            'alamat_ktp' => 'nullable',
            'alamat_tinggal' => 'nullable',
            'longitude' => 'required',
            'latitude' => 'required',
            'pangkat_id' => 'nullable',
        ]);

        try {
            $user = User::findOrFail($id);
            $user->name = $validateData['name'];
            $user->username = $validateData['username'];
            $user->email = $validateData['email'];
            $user->nip = $validateData['nip'];
            $user->jenis_kelamin = $validateData['jenis_kelamin'];
            $user->status_pegawai = $validateData['status_pegawai'];
            $user->tempat_lahir = $validateData['tempat_lahir'];
            $user->tanggal_lahir = date('Y-m-d',strtotime($validateData['tanggal_lahir']));
            $user->nik = $validateData['nik'];
            $user->npwp = $validateData['npwp'];
            $user->nomor_telepon = $validateData['nomor_telepon'];
            $user->longitude = $validateData['longitude'];
            $user->latitude = $validateData['latitude'];
            $user->alamat_ktp = $validateData['alamat_ktp'];
            $user->alamat_tinggal = $validateData['alamat_tinggal'];
            $user->pangkat_id = $validateData['pangkat_id'];
            
            if ($request->hasFile('foto')) {
                // Delete Img
                if ($user->foto) {
                    $image_path = public_path('img/users/'.$user->foto); // Value is not URL but directory file path
                    if (File::exists($image_path)) {
                        File::delete($image_path);
                    }
                }
                
                $image = $request->file('foto');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('img/users/');
                $image->move($destinationPath, $name);
                $user->foto = $name;
            }
    
            $user->save();
            // DB::table('model_has_roles')->where('model_id',$id)->delete();
            // $user->assignRole($validateData['role']);
    
            return redirect()->route('user-setting', Auth::user()->id)->with(['success' => 'User berhasil diupdate !']);
        } catch (Exception $e) {
            return redirect()->route('user-setting', Auth::user()->id)->with(['failed' => $e->getMessage()]);
        }
    }

    public function apiGetPegawai(){
        $data['users'] = User::orderby('id', 'asc')->get(['id','name','email','username','nik']);
        return json_encode([
            'data'=> $data['users']
        ]);
    }

    public function apiGetPegawaiById($id){
        return json_encode(User::where('id',$id)->first(['id','name','password','email','username','nik'])->makeVisible(['password'])
        );
    }

    


}
