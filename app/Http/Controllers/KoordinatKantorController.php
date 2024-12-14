<?php

namespace App\Http\Controllers;
use App\Models\KoordinatKantor;
use Exception;
use DB;
use Illuminate\Http\Request;

class KoordinatKantorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Data Koordinat Kantor';
        $data['koordinat_kantors'] = KoordinatKantor::orderBy('id', 'desc')->get();
        return view('master-data.koordinat-kantor.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Tambah Koordinat Kantor';
        return view('master-data.koordinat-kantor.create', $data);
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
            // dd($request->all());
            $request->validate([
                // 'nama_instalasi'   => 'required',
                // 'latitude'   => 'required',
                // 'longtitude'   => 'required',
                // 'alamat_instalasi' => 'nullable',
                // 'radius' => 'required',
                // 'keterangan' => 'nullable'
            ]);

            $koordinat_kantor = new KoordinatKantor();
            $koordinat_kantor->latitude = $request->latitude;
            $koordinat_kantor->longitude = $request->longitude;
            $koordinat_kantor->radius = $request->radius;
            $koordinat_kantor->save();

            return redirect()->route('master-data.koordinat-kantor.index')->with(['success' => 'Data berhasil dibuat !']);

        } catch (Exception $e) {
            return redirect()->route('master-data.koordinat-kantor.index')->with(['failed' => $e->getMessage()]);
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
        $data['page_title'] = 'Edit Koordinat Kantor';
        $data['koordinat_kantor'] = KoordinatKantor::findOrFail($id);
        return view('master-data.koordinat-kantor.edit', $data);
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
            // dd($request->all());
            $request->validate([
                // 'nama_instalasi'   => 'required',
                // 'latitude'   => 'required',
                // 'longtitude'   => 'required',
                // 'alamat_instalasi' => 'nullable',
                // 'radius' => 'required',
                // 'keterangan' => 'nullable'
            ]);

            $koordinat_kantor = KoordinatKantor::findOrFail($id);
            $koordinat_kantor->latitude = $request->latitude;
            $koordinat_kantor->longitude = $request->longitude;
            $koordinat_kantor->radius = $request->radius;
            $koordinat_kantor->save();

            return redirect()->route('master-data.koordinat-kantor.index')->with(['success' => 'Data berhasil diubah !']);

        } catch (Exception $e) {
            return redirect()->route('master-data.koordinat-kantor.index')->with(['failed' => $e->getMessage()]);
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
            $koordinat_kantor = KoordinatKantor::findOrFail($id);
            $koordinat_kantor->delete();
        });

        return redirect()->route('master-data.koordinat-kantor.index')->with(['success' => 'Data berhasil dihapus !']);

        } catch (Exception $e) {
            return redirect()->route('master-data.koordinat-kantor.index')->with(['failed' => $e->getMessage()]);
        }
    }
}
