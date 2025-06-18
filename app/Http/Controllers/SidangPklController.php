<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use App\Models\Dosen;
use App\Models\MhsPkl;
use App\Models\Ruangan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class SidangPklController extends Controller
{
    public function index()
    {
        $mhsPkl = MhsPkl::where('verif_berkas', '1')
            ->with('mahasiswa', 'tempat', 'dosenpembimbing', 'dosenpenguji')
            ->get();

        foreach ($mhsPkl as $mhs) {
            $mhs->Dosen = Dosen::where('id_dosen', '!=', $mhs->dosen_pembimbing)->get();
        }

        $dosenList = Dosen::all();
        $sesiList = Sesi::all();
        $ruanganList = Ruangan::all();

        return view('admin.sidang_pkl', compact('mhsPkl', 'dosenList', 'sesiList', 'ruanganList'));
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

    public function generatePDF($id)
    {
        $pkl = MhsPkl::with(['mahasiswa', 'dosenpembimbing', 'dosenpenguji', 'ruangan', 'sesi'])->findOrFail($id);

        $data = [
            'nama_mahasiswa' => $pkl->mahasiswa->nama,
            'nim' => $pkl->mahasiswa->nim,
            'prodi' => $pkl->mahasiswa->prodi->prodi,
            'dosen_pembimbing' => $pkl->dosenpembimbing->nama_dosen ?? '-',
            'dosen_penguji' => $pkl->dosenpenguji->nama_dosen ?? '-',
            'nidn_pembimbing' => $pkl->dosenpembimbing->nidn ?? '-',
            'nidn_penguji' => $pkl->dosenpenguji->nidn ?? '-',
            'tanggal_sidang' => $pkl->tanggal_sidang,
            'ruangan' => $pkl->ruangan->nama_ruangan ?? '-',
            'no_ruangan' => $pkl->ruangan->no_ruangan ?? '-',
            'sesi' => $pkl->sesi->jam ?? '-',
        ];

        $pdf = PDF::loadView('admin.surat_tugas_pkl', $data);

        return $pdf->download('Surat_Tugas_pkl_' . $data['nama_mahasiswa'] . '.pdf');
    }
}
