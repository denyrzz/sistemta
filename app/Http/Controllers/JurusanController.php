<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class JurusanController extends Controller
{

    public function index()
    {
        $data_jurusan = DB::table('jurusan')
            ->orderBy('id_jurusan')
            ->get();

        return view('admin.jurusan', compact('data_jurusan'));
    }


    public function create()
    {
        return view('admin.form.create_jurusan'); // Membuat tampilan untuk formulir
    }

    public function store(Request $request)
    {

        $request->validate([
            'kode_jurusan' => 'required|string|max:10',
            'jurusan' => 'required|string|max:255',
        ]);

        DB::table('jurusan')->insert([
            'kode_jurusan' => $request->kode_jurusan,
            'jurusan' => $request->jurusan,
        ]);

        return redirect()->route('jurusan')->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {

        $jurusan = DB::table('jurusan')->where('id_jurusan', $id)->first();

        if (!$jurusan) {
            return redirect()->route('jurusan')->with('error', 'Jurusan tidak ditemukan.');
        }

        return view('admin.form.edit_jurusan', compact('jurusan'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_jurusan' => 'required|string|max:10',
            'jurusan' => 'required|string|max:255',
        ]);

        DB::table('jurusan')->where('id_jurusan', $id)->update([
            'kode_jurusan' => $request->kode_jurusan,
            'jurusan' => $request->jurusan,
        ]);

        return redirect()->route('jurusan')->with('success', 'Jurusan berhasil diperbarui.');
    }


    public function destroy(string $id)
    {
        DB::table('jurusan')->where('id_jurusan', $id)->delete();
        return redirect()->route('jurusan')->with('success', 'Data Prodi berhasil dihapus.');
    }
}
