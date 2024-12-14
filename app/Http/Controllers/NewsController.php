<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use DB;
use File;
use Exception;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Berita dan Pengumuman';
        $data['berita'] = News::get();
        
        return view('berita.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Tambah Berita & Pengumuman';
        return view('berita.create', $data);
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
            'judul'   => 'required',
            'isi' => 'required' 
        ]);

        try {
            $berita = new News();
            $berita->judul = $validateData['judul'];
            $berita->isi = $validateData['isi'];

            if ($request->hasFile('gambar')) {            
                $image = $request->file('gambar');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('img/');
                $image->move($destinationPath, $name);
                $berita->gambar = "img/".$name;
            }

            $berita->save();

            return redirect()->route('berita.index')->with(['success' => 'Data berhasil dibuat !']);

        } catch (Exception $e) {
            return redirect()->route('berita.index')->with(['failed' => $e->getMessage()]);
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
        $data['page_title'] = 'Edit Berita & Pengumuman';
        $data['berita'] = News::findOrFail($id);
        return view('berita.edit', $data);
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
            'judul'   => 'required',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        try {
        $berita =  News::findOrFail($id);
            $berita->judul = $validateData['judul'];
            $berita->isi = $validateData['isi'];

            if ($request->hasFile('gambar')) {
                // Delete Img
                if ($berita->gambar) {
                    $image_path = public_path('img/'.$berita->gambar); // Value is not URL but directory file path
                    if (File::exists($image_path)) {
                        File::delete($image_path);
                    }
                }
                
                $image = $request->file('gambar');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('img/');
                $image->move($destinationPath, $name);
                $berita->gambar = $name;
            }

            $berita->save();

            return redirect()->route('berita.index')->with(['success' => 'Data berhasil dibuat !']);

        } catch (Exception $e) {
            return redirect()->route('berita.index')->with(['failed' => $e->getMessage()]);
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
            $berita = News::findOrFail($id);
            $berita->delete();
        });

        return redirect()->route('berita.index')->with(['success' => 'Data berhasil dihapus !']);

        } catch (Exception $e) {
            return redirect()->route('berita.index')->with(['failed' => $e->getMessage()]);
        }
    }
}
