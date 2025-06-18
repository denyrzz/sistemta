<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use App\Models\Dosen;
use App\Models\Ruangan;
use App\Models\MhsSempro;
use App\Models\NilaiSempro;
use Illuminate\Http\Request;

class NilaiSemproController extends Controller
{
    public function index()
    {
        $dosen = auth()->user()->dosen;

        $mhsDibimbing1 = $dosen->mhsSempro_pembimbing1()->with('mahasiswa', 'pembimbingSatu', 'pembimbingDua', 'Penguji')->get();

        $mhsDibimbing2 = $dosen->mhsSempro_pembimbing2()->with('mahasiswa', 'pembimbingSatu', 'pembimbingDua', 'Penguji')->get();

        $mhsPenguji = $dosen->mhsSempro_penguji()->with('mahasiswa','pembimbingSatu', 'pembimbingDua', 'Penguji')->get();

        $nilaiSempro = $mhsDibimbing1->merge($mhsDibimbing2)->merge($mhsPenguji);

        $dosenList = Dosen::all();
        $sesiList = Sesi::all();
        $ruanganList = Ruangan::all();

        return view('admin.dosen_nilai_sempro', compact('nilaiSempro', 'dosen', 'dosenList', 'sesiList', 'ruanganList'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'pendahuluan' => 'nullable|numeric|min:0|max:100',
            'tinjauan_pustaka' => 'nullable|numeric|min:0|max:100',
            'metodologi' => 'nullable|numeric|min:0|max:100',
            'penggunaan_bahasa' => 'nullable|numeric|min:0|max:100',
            'presentasi' => 'nullable|numeric|min:0|max:100',
        ]);

        $dosen = auth()->user()->dosen;
        $mhsSempro = MhsSempro::findOrFail($id);

        $status = null;
        if ($mhsSempro->pembimbing_satu == $dosen->id_dosen) {
            $status = '0';
        } elseif ($mhsSempro->pembimbing_dua == $dosen->id_dosen) {
            $status = '1';
        } elseif ($mhsSempro->penguji == $dosen->id_dosen) {
            $status = '2';
        }

        if ($status === null) {
            return redirect()->back()->withErrors('Anda tidak memiliki izin untuk memberikan penilaian.');
        }

        $existingRecord = NilaiSempro::where('sempro_id', $mhsSempro->id_sempro)
            ->where('status', $status)
            ->first();

        if ($existingRecord) {
            return redirect()->back()->withErrors('Nilai sudah ada.');
        }

        $nilaiSempro = ($request->pendahuluan * 0.2) +
            ($request->tinjauan_pustaka * 0.2) +
            ($request->metodologi * 0.2) +
            ($request->penggunaan_bahasa * 0.2) +
            ($request->presentasi * 0.2);


        $nilaiSemproRecord = new NilaiSempro();
        $nilaiSemproRecord->sempro_id = $mhsSempro->id_sempro;
        $nilaiSemproRecord->pendahuluan = $request->pendahuluan;
        $nilaiSemproRecord->tinjauan_pustaka = $request->tinjauan_pustaka;
        $nilaiSemproRecord->metodologi = $request->metodologi;
        $nilaiSemproRecord->penggunaan_bahasa = $request->penggunaan_bahasa;
        $nilaiSemproRecord->presentasi = $request->presentasi;
        $nilaiSemproRecord->nilai_sempro = $nilaiSempro;
        $nilaiSemproRecord->status = $status;

        $nilaiSemproRecord->save();

        return redirect()->back()->with('success', 'Penilaian berhasil disimpan!');
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $request->validate([
            'pendahuluan' => 'nullable|numeric|min:0|max:100',
            'tinjauan_pustaka' => 'nullable|numeric|min:0|max:100',
            'metodologi' => 'nullable|numeric|min:0|max:100',
            'penggunaan_bahasa' => 'nullable|numeric|min:0|max:100',
            'presentasi' => 'nullable|numeric|min:0|max:100',
        ]);

        $mhsSempro = MhsSempro::findOrFail($id);
        $nilaiSemproRecord = $mhsSempro->nilaisempro;

        if (!$nilaiSemproRecord) {
            return redirect()->back()->withErrors('Data penilaian tidak ditemukan.');
        }

        $nilaiSempro = ($request->pendahuluan * 0.2) +
        ($request->tinjauan_pustaka * 0.2) +
        ($request->metodologi * 0.2) +
        ($request->penggunaan_bahasa * 0.2) +
        ($request->presentasi * 0.2);

        $nilaiSemproRecord->pendahuluan = $request->pendahuluan;
        $nilaiSemproRecord->tinjauan_pustaka = $request->tinjauan_pustaka;
        $nilaiSemproRecord->metodologi = $request->metodologi;
        $nilaiSemproRecord->penggunaan_bahasa = $request->penggunaan_bahasa;
        $nilaiSemproRecord->presentasi = $request->presentasi;
        $nilaiSemproRecord->nilai_sempro = $nilaiSempro;

        $nilaiSemproRecord->save();

        return redirect()->back()->with('success', 'Penilaian berhasil diperbarui!');
    }
}
