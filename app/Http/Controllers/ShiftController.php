<?php

namespace App\Http\Controllers;
use App\Models\Instalasi;
use App\Models\User;
use App\Models\Shift;
use Exception;
use DB;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Data Shift';
        $data['shifts'] = Shift::orderBy('id', 'asc')->get();
        return view('master-data.setup-shift.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Tambah Shift';
        $getIdUser = User::get()->pluck('id');

        $data['users'] = User::whereDoesntHave('ShiftUsers',function($q) use($getIdUser){
            $q->whereIn('user_id', $getIdUser);
        })->get();

        $data['instalasis'] = Instalasi::get();
        return view('master-data.setup-shift.create', $data);
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
            'nama_shift' => 'required',
            'jam_masuk' => 'required',
            'jam_pulang' => 'required',
            'user_id' => 'nullable',
            'instalasi_id' => 'required',
            'keterangan' => 'nullable',
        ]);

        try {
            $shift = new Shift();
            $shift->nama_shift = $validateData['nama_shift'];
            $shift->jam_masuk = $validateData['jam_masuk'];
            $shift->jam_pulang = $validateData['jam_pulang'];
            $shift->instalasi_id = $validateData['instalasi_id'];
            $shift->keterangan = $validateData['keterangan'];
            $shift->save();

            $shift->Users()->attach($validateData['user_id']);

            return redirect()->route('master-data.setup-shift.index')->with(['success' => 'Data berhasil dibuat !']);

        } catch (Exception $e) {
            return redirect()->route('master-data.setup-shift.index')->with(['failed' => $e->getMessage()]);
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
        $data['page_title'] = 'Detail Pegawai';
        $data['shift'] = Shift::findOrFail($id);
        return view('master-data.setup-shift.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title'] = 'Edit Shift';
        $data['instalasis'] = Instalasi::get();
        $data['shift'] = Shift::findOrFail($id);
        $getIdUser = User::get()->pluck('id');
        $data['users'] = User::whereDoesntHave('ShiftUsers',function($q) use($getIdUser, $id){
            $q->whereIn('user_id', $getIdUser);
            $q->whereNotIn('shift_id', [$id]);
        })->get();
        return view('master-data.setup-shift.edit', $data);
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
        $validateData =  $request->validate([
            'nama_shift'   => 'required',
            'jam_masuk'   => 'required',
            'jam_pulang'   => 'required',
            'user_id' => 'nullable',
            'instalasi_id' => 'required',
            'keterangan' => 'nullable'
        ]);

        try {
            $shift = Shift::findOrFail($id);
            $shift->nama_shift = $request->nama_shift;
            $shift->jam_masuk = $request->jam_masuk;
            $shift->jam_pulang = $request->jam_pulang;
            $shift->instalasi_id = $request->instalasi_id;
            $shift->keterangan = $request->keterangan;
            $shift->save();

            $shift->Users()->sync($validateData['user_id']);

            return redirect()->route('master-data.setup-shift.index')->with(['success' => 'Data berhasil diubah !']);

        } catch (Exception $e) {
            return redirect()->route('master-data.setup-shift.index')->with(['failed' => $e->getMessage()]);
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
            $shift = Shift::findOrFail($id);

            $shift->delete();
        });

        return redirect()->route('master-data.setup-shift.index')->with(['success' => 'Data berhasil dihapus !']);

        } catch (Exception $e) {
            return redirect()->route('master-data.setup-shift.index')->with(['failed' => $e->getMessage()]);
        }
    }
}
