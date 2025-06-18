<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Ruangan;
use App\Models\MhsSempro;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SemproController extends Controller
{
    public function index()
    {
        $dosenList = Dosen::all();
        $sesiList = Sesi::all();
        $ruanganList = Ruangan::all();
        $data_sempro = MhsSempro::where('verif_berkas', '1')
            ->with(['mahasiswa', 'ruangan', 'sesi', 'pembimbingSatu', 'pembimbingDua', 'penguji'])
            ->get();

        return view('kaprodi.sempro', compact('data_sempro', 'dosenList', 'sesiList', 'ruanganList'));
    }

    public function store(Request $request, $id)
    {
        //dd($request->all());
        $validated = $request->validate([
            'ruangan_id' => 'required|exists:ruangan,id_ruangan',
            'sesi_id' => 'required|exists:sesi,id_sesi',
            'tanggal_sempro' => 'required|date',
            'penguji' => 'nullable|exists:dosen,id_dosen',
        ]);

        $sempro = MhsSempro::find($id);
        $sempro->ruangan_id = $request->ruangan_id;
        $sempro->sesi_id = $request->sesi_id;
        $sempro->tanggal_sempro = $request->tanggal_sempro;
        $sempro->penguji = $request->penguji;
        $sempro->status = "1";
        $sempro->save();

        $dosen = Dosen::find($request->penguji);
        if ($dosen) {
            $user = User::where('email', $dosen->email)->first();

            if ($user) {

                if (!$user->hasRole('penguji')) {
                    $user->assignRole('penguji');
                }
            }
        }
        return redirect()->route('sempro.index')->with('success', 'Data berhasil disimpan.');
    }

    public function generatePDF($id)
    {
        $sempro = MhsSempro::with(['mahasiswa', 'pembimbingSatu', 'pembimbingDua', 'Penguji', 'ruangan', 'sesi'])->findOrFail($id);

        $data = [
            'nama_mahasiswa' => $sempro->mahasiswa->nama,
            'nim' => $sempro->mahasiswa->nim,
            'prodi' => $sempro->mahasiswa->prodi->prodi,
            'pembimbingSatu' => $sempro->pembimbingSatu->nama_dosen ?? '-',
            'pembimbingDua' => $sempro->pembimbingDua->nama_dosen ?? '-',
            'penguji' => $sempro->Penguji->nama_dosen ?? '-',
            'nidn_pembimbingSatu' => $sempro->pembimbingSatu->nidn ?? '-',
            'nidn_pembimbingDua' => $sempro->pembimbingDua->nidn ?? '-',
            'nidn_penguji' => $sempro->Penguji->nidn ?? '-',
            'tanggal_sempro' => $sempro->tanggal_sempro,
            'ruangan' => $sempro->ruangan->nama_ruangan ?? '-',
            'no_ruangan' => $sempro->ruangan->no_ruangan ?? '-',
            'sesi' => $sempro->sesi->jam ?? '-',
        ];

        $pdf = PDF::loadView('kaprodi.surat_tugas_sempro', $data);

        //dd($data);
        return $pdf->download('Surat_Tugas_sempro_' . $data['nama_mahasiswa'] . '.pdf');
    }
}
