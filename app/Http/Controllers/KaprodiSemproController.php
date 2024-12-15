<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\MhsSempro;
use App\Models\Ruangan;
use App\Models\Sesi;
use Illuminate\Http\Request;

class KaprodiSemproController extends Controller
{
    public function index()
    {
        $dosen = Dosen::all();
        $ruangan = Ruangan::all(); // Ambil data ruangan
        $sesi = Sesi::all();
        $data_sempro = MhsSempro::with(['mahasiswa', 'ruangan', 'sesi', 'pembimbingSatu', 'pembimbingDua', 'penguji'])
            ->get();

        return view('kaprodi.sempro', compact('data_sempro', 'dosen', 'sesi', 'ruangan'));
    }

    public function verify($id)
    {
        // Cari data berdasarkan ID
        $sempro = MhsSempro::find($id);

        if (!$sempro) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        // Ubah status menjadi 1
        $sempro->status = '1';
        $sempro->save();

        return redirect()->back()->with('success', 'Data berhasil diverifikasi.');
    }

    public function addDosen(Request $request, $id)
    {
        // dd($request->all());
        $validated = $request->validate([
            // 'id_sempro' => 'required|exists:sempros,id',
            'ruangan_id' => 'required|exists:ruangan,id_ruangan',
            'sesi_id' => 'required|exists:sesi,id_sesi',
            'tanggal_sempro' => 'required|date',
            'pembimbing_satu' => 'required|exists:dosen,id_dosen',
            'pembimbing_dua' => 'nullable|exists:dosen,id_dosen',
            'penguji' => 'nullable|exists:dosen,id_dosen',
        ]);

        // Simpan data ke dalam tabel yang sesuai
        $sempro = MhsSempro::find($id);
        $sempro->ruangan_id = $request->ruangan_id;
        $sempro->sesi_id = $request->sesi_id;
        $sempro->tanggal_sempro = $request->tanggal_sempro;
        $sempro->pembimbing_satu = $request->pembimbing_satu;
        $sempro->pembimbing_dua = $request->pembimbing_dua;
        $sempro->penguji = $request->penguji;
        $sempro->status = "1"; // Ubah status menjadi "Sudah Dikonfirmasi"
        $sempro->save();

        return redirect()->route('kaprodi_sempro.index')->with('success', 'Data berhasil disimpan.');
    }
}
