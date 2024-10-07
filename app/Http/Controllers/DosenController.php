<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;


class DosenController extends Controller
{

    public function index()
    {
        $data_dosen = DB::table('dosen')
            ->join('jurusan', 'dosen.id_jurusan', '=', 'jurusan.id_jurusan')
            ->join('prodi', 'dosen.id_prodi', '=', 'prodi.id_prodi')
            ->select('dosen.*', 'jurusan.jurusan', 'prodi.prodi')
            ->orderBy('id_dosen')
            ->get();

        return view('admin.dosen', compact('data_dosen'));
    }

    public function create()
    {
        $data_dosen = DB::table('dosen')->get();
        $jurusan = DB::table('jurusan')->orderBy('id_jurusan')->get();
        $prodi = DB::table('prodi')->orderBy('id_prodi')->get();

        return view('admin.form.create_dosen', compact('jurusan', 'prodi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_dosen' => 'required|string|max:255',
            'nidn' => 'required|string|unique:dosen,nidn',
            'nip' => 'required|string|unique:dosen,nip',
            'gender' => 'required|string',
            'jurusan' => 'required|exists:jurusan,id_jurusan',
            'prodi' => 'required|exists:prodi,id_prodi',
            'email' => 'required|string|email|unique:dosen,email',
        ]);

        // Insert new record into the dosen table
        DB::table('dosen')->insert([
            'nama_dosen' => $request->nama_dosen,
            'nidn' => $request->nidn,
            'nip' => $request->nip,
            'jenis_kelamin' => $request->gender,
            'id_jurusan' => $request->jurusan,
            'id_prodi' => $request->prodi,
            'email' => $request->email,
            'image' => $request->image,
            'status' => $request->status,
        ]);

        return redirect()->route('dosen')->with('success', 'Dosen berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        // Fetch the dosen by ID
        $dosen = DB::table('dosen')->where('id_dosen', $id)->first();

        $jurusan = DB::table('jurusan')->get();
        $prodi = DB::table('prodi')->get();

        if ($dosen) {
            return view('admin.form.edit_dosen', compact('dosen', 'jurusan', 'prodi'));
        } else {
            return redirect()->route('dosen')->with('error', 'Dosen tidak ditemukan');
        }
    }


    public function update(Request $request, string $id)
    {
        // Validate the request
        $request->validate([
            'nama_dosen' => 'required|string|max:255',
            'nidn' => 'required|string|unique:dosen,nidn,' . $id . ',id_dosen',
            'nip' => 'required|string|unique:dosen,nip,' . $id . ',id_dosen',
            'gender' => 'required|string',
            'jurusan' => 'required|exists:jurusan,id_jurusan',
            'prodi' => 'required|exists:prodi,id_prodi',
            'email' => 'required|string|email|unique:dosen,email,' . $id . ',id_dosen',
        ]);

        // Update the dosen record
        DB::table('dosen')->where('id_dosen', $id)->update([
            'nama_dosen' => $request->nama_dosen,
            'nidn' => $request->nidn,
            'nip' => $request->nip,
            'jenis_kelamin' => $request->gender,
            'id_jurusan' => $request->jurusan,
            'id_prodi' => $request->prodi,
            'email' => $request->email,
            'image' => $request->image,
            'status' => $request->status,
        ]);

        return redirect()->route('dosen')->with('success', 'Data Dosen berhasil diupdate');
    }


    public function destroy(string $id)
    {

        $dosen = DB::table('dosen')->where('id_dosen', $id)->first();

        if ($dosen) {
            DB::table('dosen')->where('id_dosen', $id)->delete();
            return redirect()->route('dosen')->with('success', 'Data Dosen berhasil dihapus');
        } else {
            return redirect()->route('dosen')->with('error', 'Data Dosen tidak ditemukan');
        }
    }
}
