<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BimbinganTA;
use App\Models\MhsSempro;

class BimbinganTAController extends Controller
{
    public function index()
    {
        $dosen = auth()->user()->dosen;
        $bimbinganTA = BimbinganTA::whereHas('sempro', function ($query) use ($dosen) {
            $query->where('pembimbing_satu', $dosen->id_dosen)
                  ->orWhere('pembimbing_dua', $dosen->id_dosen);
        })->with('sempro.mahasiswa')->get();

        return view('admin.dosen_bimbingan_ta', compact('dosen', 'bimbinganTA'));
    }

    public function showBimbingan($sempro_id)
    {
        $sempro = MhsSempro::with('bimbinganTA')->findOrFail($sempro_id);
        return view('admin.dosen_detail_bimbingan_ta', compact('sempro'));
    }

    public function updateValidasi($bimbinganId, Request $request)
    {
        $request->validate([
            'komentar' => 'required|string',
        ]);

        $bimbingan = BimbinganTA::findOrFail($bimbinganId);

        $bimbingan->komentar = $request->input('komentar');
        $bimbingan->validasi = '1';
        $bimbingan->save();

        return redirect()->route('dosen.bimbingan.show', $bimbingan->sempro_id)
            ->with('success', 'Status validasi bimbingan berhasil diubah.');
    }
}
