<?php

namespace App\Http\Controllers;

use App\Models\LiburNasional;
use Illuminate\Http\Request;
use DB;
use Exception;
class LiburNasionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Data Libur Nasional';
        $data['libur_nasionals'] = LiburNasional::orderBy('id', 'desc')->get();
        return view('master-data.libur-nasional.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Tambah Data Libur Nasional';
        return view('master-data.libur-nasional.create', $data);
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
            'nama_hari_libur'   => 'required',
            'tanggal'   => 'required',
            'keterangan' => 'nullable'
        ]);

        try {
            $libur_nasional = new LiburNasional();
            $libur_nasional->nama_hari_libur = $validateData['nama_hari_libur'];
            $libur_nasional->tanggal = $validateData['tanggal'];
            $libur_nasional->keterangan = $validateData['keterangan'];
            $libur_nasional->save();

            return redirect()->route('master-data.libur-nasional.index')->with(['success' => 'Data berhasil dibuat !']);

        } catch (Exception $e) {
            return redirect()->route('master-data.libur-nasional.index')->with(['failed' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title'] = 'Edit Data Libur Nasional';
        $data['libur_nasional'] = LiburNasional::findOrFail($id);
        return view('master-data.libur-nasional.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'nama_hari_libur'   => 'required',
            'tanggal'   => 'required',
            'keterangan' => 'nullable'
        ]);

        try {
            $libur_nasional = LiburNasional::findOrFail($id);
            $libur_nasional->nama_hari_libur = $validateData['nama_hari_libur'];
            $libur_nasional->tanggal = $validateData['tanggal'];
            $libur_nasional->keterangan = $validateData['keterangan'];
            $libur_nasional->save();

            return redirect()->route('master-data.libur-nasional.index')->with(['success' => 'Data berhasil diubah !']);

        } catch (Exception $e) {
            return redirect()->route('master-data.libur-nasional.index')->with(['failed' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
            $libur_nasional = LiburNasional::findOrFail($id);
            $libur_nasional->delete();
        });

        return redirect()->route('master-data.libur-nasional.index')->with(['success' => 'Data berhasil dihapus !']);

        } catch (Exception $e) {
            return redirect()->route('master-data.libur-nasional.index')->with(['failed' => $e->getMessage()]);
        }
    }
}
