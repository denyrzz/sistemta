<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use App\Models\Dosen;
use App\Models\MhsPkl;
use App\Models\NilaiSidangPkl;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class NilaiSidangPklController extends Controller
{
    // public function index()
    // {
    //     $dosen = auth()->user()->dosen;
    //     $dosenList = Dosen::all();
    //     $sesiList = Sesi::all();
    //     $ruanganList = Ruangan::all();

    //     $nilaiPkl = $dosen->mhsPkl()->with('mahasiswa', 'tempat', 'dosenpembimbing', 'dosenpenguji')
    //         ->get();

    //     return view('admin.dosen_nilai_pkl', compact('nilaiPkl', 'dosen', 'dosenList', 'sesiList', 'ruanganList'));
    // }

    public function index()
    {
        $dosen = auth()->user()->dosen;

        $mhsDibimbing = $dosen->mhsPkl()->with('mahasiswa', 'tempat', 'dosenpembimbing', 'dosenpenguji')->get();

        $mhsDiuji = $dosen->mhsPkl_penguji()->with('mahasiswa', 'tempat', 'dosenpembimbing', 'dosenpenguji')->get();

        $nilaiPkl = $mhsDibimbing->merge($mhsDiuji);

        $dosenList = Dosen::all();
        $sesiList = Sesi::all();
        $ruanganList = Ruangan::all();

        return view('admin.dosen_nilai_pkl', compact('nilaiPkl', 'dosen', 'dosenList', 'sesiList', 'ruanganList'));
    }


    public function store(Request $request, $id)
    {
        $request->validate([
            'bahasa' => 'required|numeric|min:0|max:100',
            'analisis' => 'required|numeric|min:0|max:100',
            'sikap' => 'required|numeric|min:0|max:100',
            'komunikasi' => 'required|numeric|min:0|max:100',
            'penyajian' => 'required|numeric|min:0|max:100',
            'penguasaan' => 'required|numeric|min:0|max:100',
        ]);

        $dosen = auth()->user()->dosen;
        $mhsPkl = MhsPkl::findOrFail($id);

        $status = null;
        if ($mhsPkl->dosenpembimbing && $mhsPkl->dosenpembimbing->id == $dosen->id) {
            $status = '0';
        } elseif ($mhsPkl->dosenpenguji && $mhsPkl->dosenpenguji->id == $dosen->id) {
            $status = '1';
        }

        if ($status === null) {
            return redirect()->back()->withErrors('Anda tidak memiliki izin untuk memberikan penilaian.');
        }

        $existingRecord = NilaiSidangPkl::where('pkl_id', $mhsPkl->id_pkl)
            ->where('status', $status)
            ->first();

        if ($existingRecord) {
            return redirect()->back()->withErrors('Nilai sudah ada.');
        }

        $nilaiSidang = ($request->bahasa * 0.15) +
            ($request->analisis * 0.2) +
            ($request->sikap * 0.1) +
            ($request->komunikasi * 0.15) +
            ($request->penyajian * 0.2) +
            ($request->penguasaan * 0.2);

        $nilaiSidangRecord = $mhsPkl->nilaisidangpkl ?? new NilaiSidangPkl();
        $nilaiSidangRecord->pkl_id = $mhsPkl->id_pkl;
        $nilaiSidangRecord->bahasa = $request->bahasa;
        $nilaiSidangRecord->analisis = $request->analisis;
        $nilaiSidangRecord->sikap = $request->sikap;
        $nilaiSidangRecord->komunikasi = $request->komunikasi;
        $nilaiSidangRecord->penyajian = $request->penyajian;
        $nilaiSidangRecord->penguasaan = $request->penguasaan;
        $nilaiSidangRecord->nilai_sidang = $nilaiSidang;
        $nilaiSidangRecord->status = $status;

        $nilaiSidangRecord->save();

        return redirect()->back()->with('success', 'Penilaian berhasil disimpan!');
    }
    public function update(Request $request, $id)
    {
        dd($request->all());
        $request->validate([
            'bahasa' => 'required|numeric|min:0|max:100',
            'analisis' => 'required|numeric|min:0|max:100',
            'sikap' => 'required|numeric|min:0|max:100',
            'komunikasi' => 'required|numeric|min:0|max:100',
            'penyajian' => 'required|numeric|min:0|max:100',
            'penguasaan' => 'required|numeric|min:0|max:100',
        ]);

        $mhsPkl = MhsPkl::findOrFail($id);
        $nilaiSidangRecord = $mhsPkl->nilaisidangpkl;

        if (!$nilaiSidangRecord) {
            return redirect()->back()->withErrors('Data penilaian tidak ditemukan.');
        }

        $nilaiSidang = ($request->bahasa * 0.15) +
            ($request->analisis * 0.2) +
            ($request->sikap * 0.1) +
            ($request->komunikasi * 0.15) +
            ($request->penyajian * 0.2) +
            ($request->penguasaan * 0.2);

        $nilaiSidangRecord->bahasa = $request->bahasa;
        $nilaiSidangRecord->analisis = $request->analisis;
        $nilaiSidangRecord->sikap = $request->sikap;
        $nilaiSidangRecord->komunikasi = $request->komunikasi;
        $nilaiSidangRecord->penyajian = $request->penyajian;
        $nilaiSidangRecord->penguasaan = $request->penguasaan;
        $nilaiSidangRecord->nilai_sidang = $nilaiSidang;

        $nilaiSidangRecord->save();

        return redirect()->back()->with('success', 'Penilaian berhasil diperbarui!');
    }
}
