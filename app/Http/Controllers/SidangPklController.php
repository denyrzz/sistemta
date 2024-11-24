<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use App\Models\Dosen;
use App\Models\MhsPkl;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class SidangPklController extends Controller
{
    public function index()
    {
        $dosenList = Dosen::all();
        $sesiList = Sesi::all();
        $ruanganList = Ruangan::all();
        $mhsPkl = MhsPkl::where('verif_berkas', '1')
            ->with('mahasiswa', 'tempat', 'dosenpembimbing', 'dosenpenguji')
            ->get();

        return view('admin.sidang_pkl', compact('mhsPkl','dosenList','sesiList','ruanganList'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'dosen_penguji' => 'required|exists:dosen,id_dosen',
            'tanggal_sidang' => 'required|date',
            'sesi_id' => 'required|exists:sesi,id_sesi',
            'ruangan_id' => 'required|exists:ruangan,id_ruangan',
        ]);

        $sidang = MhsPkl::findOrFail($id);
        $sidang->update([
            'dosen_penguji' => $request->dosen_penguji,
            'tanggal_sidang' => $request->tanggal_sidang,
            'sesi_id' => $request->sesi_id,
            'ruangan_id' => $request->ruangan_id,
        ]);

        return redirect()->back()->with('success', 'Data Sidang PKL berhasil diperbarui.');
    }
}
