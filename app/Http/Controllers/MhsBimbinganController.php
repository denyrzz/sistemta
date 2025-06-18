<?php

namespace App\Http\Controllers;

use App\Models\BimbinganTA;
use App\Models\MhsBimbingan;
use Illuminate\Http\Request;

class MhsBimbinganController extends Controller
{
    public function index()
    {
        $mahasiswaId = auth()->user()->mahasiswa->id_mahasiswa;

        $bimbingans = BimbinganTA::whereHas('sempro', function ($query) use ($mahasiswaId) {
            $query->where('mahasiswa_id', $mahasiswaId);
        })->get();

        return view('admin.mhs_bimbingan', compact('bimbingans'));
    }
    public function create()
    {
        $mahasiswa = auth()->user()->mahasiswa->load('sempro');

        if ($mahasiswa && $mahasiswa->sempro) {
            $semproId = $mahasiswa->sempro->id_sempro;
        } else {
            $semproId = null;
        }

        if (is_null($semproId)) {
            dd("Mahasiswa ID: " . ($mahasiswa ? $mahasiswa->id_mahasiswa : 'null'), $mahasiswa->mhs_sempro);
        }

        return view('admin.form.create_bimbingan', compact('semproId'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'sempro_id' => 'required|exists:mhs_sempro,id_sempro',
            'tanggal' => 'required|date',
            'dokumentasi' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $bimbingan = new BimbinganTA();
        $bimbingan->sempro_id = $request->input('sempro_id');
        $bimbingan->tanggal = $request->input('tanggal');
        $bimbingan->keterangan = $request->input('keterangan');

        if ($request->hasFile('dokumentasi')) {
            $filename = time() . '_' . $request->file('dokumentasi')->getClientOriginalName();
            $request->file('dokumentasi')->storeAs('public/uploads/mahasiswa/bimbingan/dokumentasi/', $filename);
            $bimbingan->dokumentasi = $filename;
        }

        $bimbingan->save();

        return redirect()->route('mhs_bimbingan.index')->with('success', 'Bimbingan berhasil ditambahkan');
    }
}
