<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_jurusan = DB::table('jurusan')
            ->orderBy('id_jurusan')
            ->get();
    
        return view('admin.jurusan', compact('data_jurusan')); 
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create_jurusan'); // Membuat tampilan untuk formulir
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'kode_jurusan' => 'required|string|max:10',
            'jurusan' => 'required|string|max:255',
        ]);

        // Menyimpan data ke tabel jurusan
        DB::table('jurusan')->insert([
            'kode_jurusan' => $request->kode_jurusan,
            'jurusan' => $request->jurusan,
        ]);

        return redirect()->route('jurusan')->with('success', 'Jurusan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('jurusan')->where('id_jurusan', $id)->delete();
        return redirect()->route('jurusan')->with('success', 'Data Prodi berhasil dihapus.');
    }
}