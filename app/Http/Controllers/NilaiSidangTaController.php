<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use App\Models\Dosen;
use App\Models\MhsSempro;
use App\Models\Ruangan;
use App\Models\MhsTa;
use App\Models\NilaiSidangTa;
use Illuminate\Http\Request;

class NilaiSidangTaController extends Controller
{
    public function index()
    {
        $dosen = auth()->user()->dosen;

        $mhsDibimbing1 = MhsTa::where('dosen_pembimbing1', $dosen->id_dosen)
            ->get();
        $mhsDibimbing2 = MhsTa::where('dosen_pembimbing2', $dosen->id_dosen)
            ->get();

        $mhsPenguji1 = $dosen->mhsTa_penguji1()->with('mahasiswa', 'Penguji1', 'Penguji2', 'Penguji3')->get();
        $mhsPenguji2 = $dosen->mhsTa_penguji2()->with('mahasiswa', 'Penguji1', 'Penguji2', 'Penguji3')->get();
        $mhsPenguji3 = $dosen->mhsTa_penguji3()->with('mahasiswa', 'Penguji1', 'Penguji2', 'Penguji3')->get();

        $nilaiSidang = $mhsDibimbing1->merge($mhsDibimbing2)->merge($mhsPenguji1)->merge($mhsPenguji2)->merge($mhsPenguji3);

        $dosenList = Dosen::all();
        $sesiList = Sesi::all();
        $ruanganList = Ruangan::all();

        return view('admin.dosen_nilai_ta', compact('nilaiSidang', 'dosen', 'dosenList', 'sesiList', 'ruanganList'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'sikap_penampilan' => 'nullable|numeric|min:0|max:100',
            'komunikasi_sistematika' => 'nullable|numeric|min:0|max:100',
            'penguasaan_materi' => 'nullable|numeric|min:0|max:100',
            'identifikasi_masalah' => 'nullable|numeric|min:0|max:100',
            'relevansi_teori' => 'nullable|numeric|min:0|max:100',
            'metode_algoritma' => 'nullable|numeric|min:0|max:100',
            'hasil_pembahasan' => 'nullable|numeric|min:0|max:100',
            'kesimpulan_saran' => 'nullable|numeric|min:0|max:100',
            'bahasa_tata_tulis' => 'nullable|numeric|min:0|max:100',
            'kesesuaian_fungsional' => 'nullable|numeric|min:0|max:100',
            'formalitas' => 'nullable|numeric|min:0|max:100',
        ]);

        $dosen = auth()->user()->dosen;
        $mhsTa = MhsTa::findOrFail($id);

        $status = null;
        if ($mhsTa->dosen_pembimbing1 == $dosen->id_dosen) {
            $status = '0';
        } elseif ($mhsTa->dosen_pembimbing2 == $dosen->id_dosen) {
            $status = '1';
        } elseif ($mhsTa->penguji1_id == $dosen->id_dosen) {
            $status = '2';
        } elseif ($mhsTa->penguji2_id == $dosen->id_dosen) {
            $status = '3';
        } elseif ($mhsTa->penguji3_id == $dosen->id_dosen) {
            $status = '4';
        }

        if ($status === null) {
            return redirect()->back()->withErrors('Anda tidak memiliki izin untuk memberikan penilaian.');
        }

        $nilaiSidang = (
            ($request->sikap_penampilan * 0.1) +
            ($request->komunikasi_sistematika * 0.1) +
            ($request->penguasaan_materi * 0.1) +
            ($request->identifikasi_masalah * 0.1) +
            ($request->relevansi_teori * 0.1) +
            ($request->metode_algoritma * 0.1) +
            ($request->hasil_pembahasan * 0.1) +
            ($request->kesimpulan_saran * 0.1) +
            ($request->bahasa_tata_tulis * 0.1) +
            ($request->kesesuaian_fungsional * 0.1) +
            ($request->formalitas * 0.1)
        );

        $nilaiSidangRecord = new NilaiSidangTa();
        $nilaiSidangRecord->ta_id = $mhsTa->id_ta;
        $nilaiSidangRecord->sikap_penampilan = $request->sikap_penampilan;
        $nilaiSidangRecord->komunikasi_sistematika = $request->komunikasi_sistematika;
        $nilaiSidangRecord->penguasaan_materi = $request->penguasaan_materi;
        $nilaiSidangRecord->identifikasi_masalah = $request->identifikasi_masalah;
        $nilaiSidangRecord->relevansi_teori = $request->relevansi_teori;
        $nilaiSidangRecord->metode_algoritma = $request->metode_algoritma;
        $nilaiSidangRecord->hasil_pembahasan = $request->hasil_pembahasan;
        $nilaiSidangRecord->kesimpulan_saran = $request->kesimpulan_saran;
        $nilaiSidangRecord->bahasa_tata_tulis = $request->bahasa_tata_tulis;
        $nilaiSidangRecord->kesesuaian_fungsional = $request->kesesuaian_fungsional;
        $nilaiSidangRecord->formalitas = $request->formalitas;
        $nilaiSidangRecord->nilai_sidang = $nilaiSidang;
        $nilaiSidangRecord->status = $status;

        $nilaiSidangRecord->save();

        return redirect()->back()->with('success', 'Penilaian berhasil disimpan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'sikap_penampilan' => 'nullable|numeric|min:0|max:100',
            'komunikasi_sistematika' => 'nullable|numeric|min:0|max:100',
            'penguasaan_materi' => 'nullable|numeric|min:0|max:100',
            'identifikasi_masalah' => 'nullable|numeric|min:0|max:100',
            'relevansi_teori' => 'nullable|numeric|min:0|max:100',
            'metode_algoritma' => 'nullable|numeric|min:0|max:100',
            'hasil_pembahasan' => 'nullable|numeric|min:0|max:100',
            'kesimpulan_saran' => 'nullable|numeric|min:0|max:100',
            'bahasa_tata_tulis' => 'nullable|numeric|min:0|max:100',
            'kesesuaian_fungsional' => 'nullable|numeric|min:0|max:100',
            'status' => 'required|in:0,1,2,3,4',
        ]);

        $mhsTa = MhsTa::findOrFail($id);
        $dosen = auth()->user()->dosen;

        $nilaiSidangRecord = NilaiSidangTa::where('ta_id', $mhsTa->id_ta)
            ->where('status', $request->status)
            ->first();

        if (!$nilaiSidangRecord) {
            return redirect()->back()->withErrors('Data penilaian tidak ditemukan.');
        }

        $nilaiSidang = (
            ($request->sikap_penampilan * 0.1) +
            ($request->komunikasi_sistematika * 0.1) +
            ($request->penguasaan_materi * 0.1) +
            ($request->identifikasi_masalah * 0.1) +
            ($request->relevansi_teori * 0.1) +
            ($request->metode_algoritma * 0.1) +
            ($request->hasil_pembahasan * 0.1) +
            ($request->kesimpulan_saran * 0.1) +
            ($request->bahasa_tata_tulis * 0.1) +
            ($request->kesesuaian_fungsional * 0.1)
        );

        $nilaiSidangRecord->sikap_penampilan = $request->sikap_penampilan;
        $nilaiSidangRecord->komunikasi_sistematika = $request->komunikasi_sistematika;
        $nilaiSidangRecord->penguasaan_materi = $request->penguasaan_materi;
        $nilaiSidangRecord->identifikasi_masalah = $request->identifikasi_masalah;
        $nilaiSidangRecord->relevansi_teori = $request->relevansi_teori;
        $nilaiSidangRecord->metode_algoritma = $request->metode_algoritma;
        $nilaiSidangRecord->hasil_pembahasan = $request->hasil_pembahasan;
        $nilaiSidangRecord->kesimpulan_saran = $request->kesimpulan_saran;
        $nilaiSidangRecord->bahasa_tata_tulis = $request->bahasa_tata_tulis;
        $nilaiSidangRecord->kesesuaian_fungsional = $request->kesesuaian_fungsional;
        $nilaiSidangRecord->nilai_sidang = $nilaiSidang;
        $nilaiSidangRecord->status = $request->status;

        $nilaiSidangRecord->save();

        return redirect()->back()->with('success', 'Penilaian berhasil diperbarui!');
    }
}
