<?php

namespace App\Http\Controllers;
use App\Models\Instalasi;
use Exception;
use DB;
use Illuminate\Http\Request;

class InstalasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Data Instalasi';
        $data['instalasis'] = Instalasi::orderBy('id', 'desc')->get();
        return view('master-data.instalasi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Tambah Instalasi';
        return view('master-data.instalasi.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_instalasi'   => 'required',
            'latitude'   => 'required',
            'longitude'   => 'required',
            'alamat_instalasi' => 'nullable',
            'radius' => 'required',
            'keterangan' => 'nullable',
        ]);

        try {
            $instalasi = new Instalasi();
            $instalasi->nama_instalasi = $request->nama_instalasi;
            $instalasi->latitude = $request->latitude;
            $instalasi->longitude = $request->longitude;
            $instalasi->alamat_instalasi = $request->alamat_instalasi;
            $instalasi->radius = $request->radius;
            $instalasi->keterangan = $request->keterangan;
            $instalasi->save();

            return redirect()->route('master-data.instalasi.index')->with(['success' => 'Data berhasil dibuat !']);
        } catch (Exception $e) {
            return redirect()->route('master-data.instalasi.index')->with(['failed' => $e->getMessage()]);
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
        $data['page_title'] = 'Edit Instalasi';
        $data['instalasi'] = Instalasi::findOrFail($id);
        return view('master-data.instalasi.edit', $data);
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
        $request->validate([
            'nama_instalasi'   => 'required',
            'latitude'   => 'required',
            'longitude'   => 'required',
            'alamat_instalasi' => 'nullable',
            'radius' => 'required',
            'keterangan' => 'nullable'
        ]);

        try {

            $instalasi = Instalasi::findOrFail($id);
            $instalasi->nama_instalasi = $request->nama_instalasi;
            $instalasi->latitude = $request->latitude;
            $instalasi->longitude = $request->longitude;
            $instalasi->alamat_instalasi = $request->alamat_instalasi;
            $instalasi->radius = $request->radius;
            $instalasi->keterangan = $request->keterangan;
            $instalasi->save();

            return redirect()->route('master-data.instalasi.index')->with(['success' => 'Data berhasil diedit !']);
        } catch (Exception $e) {
            return redirect()->route('master-data.instalasi.index')->with(['failed' => $e->getMessage()]);
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
            $instalasi = Instalasi::findOrFail($id);
            $instalasi->delete();
        });

        return redirect()->route('master-data.instalasi.index')->with(['success' => 'Data berhasil dihapus !']);

        } catch (Exception $e) {
            return redirect()->route('master-data.instalasi.index')->with(['failed' => $e->getMessage()]);
        }
    }

    public function checkKantorUtama(Request $request){
        try {
            $id = $request->id;
            $kantor_utama = $request->kantor_utama;
            $isTrue = Instalasi::where('kantor_utama', true)->get()->count();
            if($isTrue == 0 || $kantor_utama == 'false'){
                $instalasi = Instalasi::findOrFail($id);
                $instalasi->kantor_utama = $kantor_utama;
                $instalasi->save();
                if ($kantor_utama == 'true') {
                    $response = [
                        "success" => true,
                        "message" => "Berhasil menetapkan kantor utama!",
                        "data" => [$instalasi]
                    ];
                }else{
                    $response = [
                        "success" => true,
                        "message" => "Berhasil tidak menetapkan kantor utama!",
                        "data" => [$instalasi]
                    ];
                }
                return $response;
            }else{
                $response = [
                    "success" => false,
                    "message" => "Kantor utama sudah di tetapkan!",
                    "data" => []
                ];
                return $response;
            }
        } catch (\Throwable $th) {
            $response = [
                "success" => false,
                "message" => "Internal Server Error!",
                "data" => []
            ];
            return $response;
        }
    }
}
