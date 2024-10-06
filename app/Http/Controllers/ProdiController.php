<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ProdiController extends Controller
{
    public function index()
    {
        $data_prodi = DB::table('prodi')
            ->orderBy('id_prodi')
            ->get();

        return view('admin.prodi', compact('data_prodi'));
    }

    public function store(Request $request)
    {
        $data = [
            'kode_prodi' => $request->kode_prodi,
            'prodi' => $request->prodi,
            'id_jurusan' => $request->id_jurusan,
            'jenjang' => $request->jenjang
        ];

        DB::table('prodi')->insert($data);
        return redirect()->route('prodi')->with('success', 'Data Prodi berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $prodi = DB::table('prodi')->where('id_prodi', $id)->first();

        $jurusan = DB::table('jurusan')->orderBy('id_jurusan')->get();

        return view('admin.form.edit_prodi', compact('prodi', 'jurusan'));
    }

    public function create()
    {
        $jurusan = DB::table('jurusan')->orderBy('id_jurusan')->get();
        return view('admin.form.create_prodi', compact('jurusan'));
    }

    public function update(Request $request, string $id)
    {

        $request->validate([
            'kode_prodi' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'id_jurusan' => 'required|exists:jurusan,id_jurusan',
            'jenjang' => 'required|string|max:255',
        ]);

        $data = [
            'kode_prodi' => $request->kode_prodi,
            'prodi' => $request->prodi,
            'id_jurusan' => $request->id_jurusan,
            'jenjang' => $request->jenjang,
        ];

        DB::table('prodi')->where('id_prodi', $id)->update($data);

        return redirect()->route('prodi')->with('success', 'Data Prodi berhasil diperbarui.');
    }


    public function destroy(string $id)
    {
        DB::table('prodi')->where('id_prodi', $id)->delete();
        return redirect()->route('prodi')->with('success', 'Data Prodi berhasil dihapus.');
    }
}
