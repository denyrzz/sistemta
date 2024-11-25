<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\MhsPkl;
use App\Models\MhsLogbook;
use Illuminate\Http\Request;
use App\Models\MhsNilaiBimbinganPkl;

class DosenPembimbingController extends Controller
{
    public function index()
    {
        //dd($request->all());
        $dosen = auth()->user()->dosen;
        $nilaiBimbingan = MhsNilaiBimbinganPkl::all();

        $mhsPkl = $dosen->mhsPkl()->with(['mahasiswa', 'tempat'])->get();

        return view('admin.dosen_pembimbing', compact('dosen', 'mhsPkl','nilaiBimbingan'));
    }

    public function showLogbook($mhs_pkl_id)
    {

        $mhsPkl = MhsPkl::with('logbook')->findOrFail($mhs_pkl_id);
        return view('admin.dosen_logbook', compact('mhsPkl'));
    }
    public function updateValidasi($logbookId, Request $request)
    {
        $logbook = MhsLogbook::findOrFail($logbookId);

        $logbook->validasi = '1';
        $logbook->save();

        return redirect()->route('dosen.pembimbing.showLogbook', $logbook->pkl_id)
            ->with('success', 'Status validasi logbook berhasil diubah.');
    }

    public function updatePenilaian(Request $request, $id)
    {
        $request->validate([
            'keaktifan_bimbingan' => 'required|numeric|min:0|max:100',
            'komunikatif' => 'required|numeric|min:0|max:100',
            'problem_solving' => 'required|numeric|min:0|max:100',
        ]);

        $nilaiBimbingan = ($request->keaktifan_bimbingan * 0.3) +
            ($request->komunikatif * 0.3) +
            ($request->problem_solving * 0.4);

        $mhsPkl = MhsPkl::findOrFail($id);
        $nilaiBimbinganRecord = $mhsPkl->nilaiBimbingan ?? new MhsNilaiBimbinganPkl();

        $nilaiBimbinganRecord->pkl_id = $mhsPkl->id_pkl;
        $nilaiBimbinganRecord->keaktifan = $request->keaktifan_bimbingan;
        $nilaiBimbinganRecord->komunikatif = $request->komunikatif;
        $nilaiBimbinganRecord->problem_solving = $request->problem_solving;
        $nilaiBimbinganRecord->nilai_bimbingan = $nilaiBimbingan;

        $nilaiBimbinganRecord->save();

        return redirect()->back()->with('success', 'Penilaian berhasil disimpan!');
    }
}
