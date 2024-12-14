<?php

namespace App\Http\Controllers;

use App\Models\StrukturOrganisasi;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StrukturOrganisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Struktur Organisasi';
        $data['strukturs'] = StrukturOrganisasi::orderby('id', 'asc')->get();

        return view('master-data.struktur-organisasi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Tambah Struktur Organisasi';
        $data['users'] = User::get();
        $data['strukturs'] = StrukturOrganisasi::whereNull('parent_id')->get();

        return view('master-data.struktur-organisasi.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validateData = $request->validate([
            'name'   => 'required',
            'user_id' => 'required',
            'parent_id' => 'nullable',
        ]);
        try {
            $struktur = new StrukturOrganisasi();
            $struktur->name = $validateData['name'];
            $struktur->user_id = $validateData['user_id'];
            $struktur->parent_id = $validateData['parent_id'] ?? null;
            
            $struktur->save();
    
            return redirect()->route('master-data.struktur-organisasi.index')->with(['success' => 'Data berhasil dibuat !']);
        } catch (Exception $e) {
            return redirect()->route('master-data.struktur-organisasi.index')->with(['failed' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrukturOrganisasi  $strukturOrganisasi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title'] = 'Edit Struktur Organisasi';
        $data['users'] = User::get();
        $data['strukturs'] = StrukturOrganisasi::whereNull('parent_id')->get();
        $data['struktur'] = StrukturOrganisasi::findOrFail($id);
        return view('master-data.struktur-organisasi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StrukturOrganisasi  $strukturOrganisasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'name'   => 'required|unique:struktur_organisasis,name,'.$id,
            'user_id' => 'required',
            'parent_id' => 'nullable',
        ]);

        try {
            $struktur = StrukturOrganisasi::findOrFail($id);
            $struktur->name = $validateData['name'];
            $struktur->user_id = $validateData['user_id'];
            $struktur->parent_id = $validateData['parent_id'] ?? null;
    
            $struktur->save();
    
            return redirect()->route('master-data.struktur-organisasi.index')->with(['success' => 'Data berhasil diupdate !']);
        } catch (Exception $e) {
            return redirect()->route('master-data.struktur-organisasi.index')->with(['failed' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StrukturOrganisasi  $strukturOrganisasi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $setupjamKerja = StrukturOrganisasi::findOrFail($id);

                $setupjamKerja->delete();
            });
            
            return redirect()->route('master-data.struktur-organisasi.index')->with(['failed' => 'Data berhasil dihapus !']);
        } catch (\Throwable $th) {
            return redirect()->route('master-data.struktur-organisasi.index')->with(['failed' => $th->getMessage()]);
        }
    }
}
