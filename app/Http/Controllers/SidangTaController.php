<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use App\Models\User;
use App\Models\Dosen;
use App\Models\MhsTa;
use App\Models\Sempro;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SidangTaController extends Controller
{
    public function index()
    {
        $sesiList = Sesi::all();
        $ruanganList = Ruangan::all();
        $dosenList = Dosen::all();

        $data_ta = MhsTa::where('verif_berkas', '1')
            ->with([
                'mahasiswa',
                'ruangan',
                'sesi',
                'penguji1',
                'penguji2',
                'penguji3',
                'sempro' => function ($query) {
                    $query->with(['pembimbingSatu', 'pembimbingDua']);
                }
            ])
            ->get();

        return view('kaprodi.ta', compact('data_ta', 'dosenList', 'sesiList', 'ruanganList'));
    }

    public function store(Request $request, $id)
    {
        $ta = MhsTa::findOrFail($id);

        //dd($request->all());
        $request->validate([
            'ketua_sidang' => 'required|exists:dosen,id_dosen',
            'penguji1' => 'required|exists:dosen,id_dosen',
            'penguji2' => 'required|exists:dosen,id_dosen',
            'penguji3' => 'required|exists:dosen,id_dosen',
            'tanggal_sidang' => 'required|date',
            'ruangan_id' => 'required|exists:ruangan,id_ruangan',
            'sesi_id' => 'required|exists:sesi,id_sesi',
        ]);

        $ta->update([
            'ketua_sidang' => $request->ketua_sidang,
            'penguji1_id' => $request->penguji1,
            'penguji2_id' => $request->penguji2,
            'penguji3_id' => $request->penguji3,
            'tanggal_sidang' => $request->tanggal_sidang,
            'ruangan_id' => $request->ruangan_id,
            'sesi_id' => $request->sesi_id,
        ]);

        $penguji_ids = [$request->penguji1, $request->penguji2, $request->penguji3];
        foreach ($penguji_ids as $penguji_id) {
            $dosen = Dosen::find($penguji_id);

            if ($dosen) {
                $user = User::where('email', $dosen->email)->first();

                if ($user) {

                    if (!$user->hasRole('penguji')) {
                        $user->assignRole('penguji');
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Jadwal sidang TA berhasil disimpan.');
    }

    public function generatePDF($id)
    {
        $suratTugas = MhsTa::with([
            'mahasiswa.prodi',
            'ketuaSidang',
            'penguji1',
            'penguji2',
            'penguji3',
            'ruangan',
            'sesi'
        ])->findOrFail($id);

        $data = [
            'nama_mahasiswa' => $suratTugas->mahasiswa->nama,
            'nim' => $suratTugas->mahasiswa->nim,
            'prodi' => $suratTugas->mahasiswa->prodi->prodi,

            'ketua_sidang' => $suratTugas->ketuaSidang->nama_dosen ?? 'N/A',
            'nidn_ketua_sidang' => $suratTugas->ketuaSidang->nidn ?? 'N/A',

            'penguji1' => $suratTugas->penguji1->nama_dosen ?? 'N/A',
            'nidn_penguji1' => $suratTugas->penguji1->nidn ?? 'N/A',

            'penguji2' => $suratTugas->penguji2->nama_dosen ?? 'N/A',
            'nidn_penguji2' => $suratTugas->penguji2->nidn ?? 'N/A',

            'penguji3' => $suratTugas->penguji3->nama_dosen ?? 'N/A',
            'nidn_penguji3' => $suratTugas->penguji3->nidn ?? 'N/A',

            'tanggal_sidang' => $suratTugas->tanggal_sidang,
            'ruangan' => $suratTugas->ruangan->nama_ruangan ?? 'N/A',
            'no_ruangan' => $suratTugas->ruangan->no_ruangan ?? 'N/A',
            'sesi' => $suratTugas->sesi->jam ?? 'N/A',
        ];

        $pdf = PDF::loadView('kaprodi.surat_tugas_ta', $data);

        return $pdf->download('Surat_Tugas_Sidang_' . $data['nama_mahasiswa'] . '.pdf');
    }
}
