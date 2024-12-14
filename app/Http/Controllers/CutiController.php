<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Http\Request;
use DB;
use Exception;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Data Cuti';
        $data['cutis'] = Cuti::orderBy('id', 'desc')->get();
        return view('master-data.cuti.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Tambah Data Cuti';
        return view('master-data.cuti.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validateData = $request->validate([
                'batas_cuti'   => 'required',
                'keterangan' => 'nullable'
            ]);

            $cuti = new Cuti();
            $cuti->batas_cuti = $validateData['batas_cuti'];
            $cuti->keterangan = $validateData['keterangan'];
            $cuti->save();

            return redirect()->route('master-data.cuti.index')->with(['success' => 'Data berhasil dibuat !']);

        } catch (Exception $e) {
            return redirect()->route('master-data.cuti.index')->with(['failed' => $e->getMessage()]);
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
        $data['page_title'] = 'Edit Data Cuti';
        $data['cuti'] = Cuti::findOrFail($id);
        return view('master-data.cuti.edit', $data);
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
        try {
            $validateData = $request->validate([
                'batas_cuti'   => 'required',
                'keterangan' => 'nullable'
            ]);

            $cuti = Cuti::findOrFail($id);
            $cuti->batas_cuti = $validateData['batas_cuti'];
            $cuti->keterangan = $validateData['keterangan'];
            $cuti->save();

            return redirect()->route('master-data.cuti.index')->with(['success' => 'Data berhasil diubah !']);

        } catch (Exception $e) {
            return redirect()->route('master-data.cuti.index')->with(['failed' => $e->getMessage()]);
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
            $cuti = Cuti::findOrFail($id);
            $cuti->delete();
        });

        return redirect()->route('master-data.cuti.index')->with(['success' => 'Data berhasil dihapus !']);

        } catch (Exception $e) {
            return redirect()->route('master-data.cuti.index')->with(['failed' => $e->getMessage()]);
        }
    }
}
