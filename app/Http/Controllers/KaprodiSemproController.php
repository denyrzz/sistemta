<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Ruangan;
use App\Models\MhsSempro;
use App\Models\MhsTa;
use Illuminate\Http\Request;

class KaprodiSemproController extends Controller
{
    public function index()
    {
        $dosen = Dosen::all();
        $ruangan = Ruangan::all();
        $sesi = Sesi::all();
        $data_sempro = MhsSempro::with(['mahasiswa', 'ruangan', 'sesi', 'pembimbingSatu', 'pembimbingDua', 'penguji'])
            ->get();

        return view('kaprodi.pengajuan_sempro', compact('data_sempro', 'dosen', 'sesi', 'ruangan'));
    }

    public function verify(Request $request, $id)
    {
        //dd($request->all());

        $sempro = MhsSempro::find($id);

        if (!$sempro) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $validated = $request->validate([
            'pembimbing_satu' => 'required|exists:dosen,id_dosen',
            'pembimbing_dua' => 'required|exists:dosen,id_dosen',
        ]);

        $sempro->pembimbing_satu = $request->pembimbing_satu;
        $sempro->pembimbing_dua = $request->pembimbing_dua;
        $sempro->status = '1';

        $sempro->save();

        $mhsTa = MhsTa::updateOrCreate(
            ['mahasiswa_id' => $sempro->mahasiswa_id],
            [
                'dosen_pembimbing1' => $request->pembimbing_satu,
                'dosen_pembimbing2' => $request->pembimbing_dua,
            ]
        );

        $pembimbing_ids = [$request->pembimbing_satu, $request->pembimbing_dua];
        foreach ($pembimbing_ids as $pembimbing_id) {
            $dosen = Dosen::find($pembimbing_id);

            if ($dosen) {
                $user = User::where('email', $dosen->email)->first();

                if ($user) {

                    if (!$user->hasRole('pembimbing')) {
                        $user->assignRole('pembimbing');
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Data berhasil diverifikasi.');
    }
}
