<?php

namespace App\Http\Controllers;

use App\Models\Instalasi;
use App\Models\SetupJamKerja;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SetupJamKerjaController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('permission:read', ['only' => 'index']);
    //     $this->middleware('permission:create', ['only' => ['create']]);
    //     $this->middleware('permission:edit', ['only' => ['edit']]);
    //     $this->middleware('permission:delete', ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Setup Jam Kerja';
        $data['setup_jams'] = SetupJamKerja::orderby('id', 'asc')->get();

        return view('master-data.setup-jam-kerja.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Tambah Jam Kerja';
        $data['instalasis'] = Instalasi::orderBy('id', 'asc')->get();
        return view('master-data.setup-jam-kerja.create', $data);
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
            'jam_masuk'   => 'required',
            'jam_pulang'   => 'required',
            'jam_masuk_istirahat' => 'required',
            'jam_keluar_istirahat' => 'required',
            'keterangan' => 'required',
            'instalasi_id' => 'required',
        ]);

        try {
            $setupjamKerja = new SetupJamKerja();
            $setupjamKerja->jam_masuk = $validateData['jam_masuk'];
            $setupjamKerja->jam_pulang = $validateData['jam_pulang'];
            $setupjamKerja->jam_masuk_istirahat = $validateData['jam_masuk_istirahat'];
            $setupjamKerja->jam_keluar_istirahat = $validateData['jam_keluar_istirahat'];
            $setupjamKerja->keterangan = $validateData['keterangan'];
            $setupjamKerja->instalasi_id = $validateData['instalasi_id'];
           
            $setupjamKerja->save();
    
            return redirect()->route('master-data.setup-jam-kerja.index')->with(['success' => 'Data berhasil dibuat !']);
        } catch (Exception $e) {
            return redirect()->route('master-data.setup-jam-kerja.index')->with(['failed' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SetupJamKerja  $setupJamKerja
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title'] = 'Edit Jam Kerja';
        $data['instalasis'] = Instalasi::get();
        $data['setup_jam'] = SetupJamKerja::findOrFail($id);
        return view('master-data.setup-jam-kerja.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SetupJamKerja  $setupJamKerja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'jam_masuk'   => 'required',
            'jam_pulang'   => 'required',
            'jam_masuk_istirahat' => 'required',
            'jam_keluar_istirahat' => 'required',
            'keterangan' => 'required',
            'instalasi_id' => 'required',
        ]);
        
        try {
            $setupjamKerja = SetupJamKerja::findOrFail($id);
            $setupjamKerja->jam_masuk = $validateData['jam_masuk'];
            $setupjamKerja->jam_pulang = $validateData['jam_pulang'];
            $setupjamKerja->jam_masuk_istirahat = $validateData['jam_masuk_istirahat'];
            $setupjamKerja->jam_keluar_istirahat = $validateData['jam_keluar_istirahat'];
            $setupjamKerja->keterangan = $validateData['keterangan'];
            $setupjamKerja->instalasi_id = $validateData['instalasi_id'];
    
            $setupjamKerja->save();
    
            return redirect()->route('master-data.setup-jam-kerja.index')->with(['success' => 'Data berhasil diupdate !']);
        } catch (Exception $e) {
            return redirect()->route('master-data.setup-jam-kerja.index')->with(['failed' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SetupJamKerja  $setupJamKerja
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $setupjamKerja = SetupJamKerja::findOrFail($id);

                $setupjamKerja->delete();
            });
            
            return redirect()->route('master-data.setup-jam-kerja.index')->with(['failed' => 'Data berhasil dihapus !']);
        } catch (\Throwable $th) {
            return redirect()->route('master-data.setup-jam-kerja.index')->with(['failed' => $th->getMessage()]);
        }
    }
}
