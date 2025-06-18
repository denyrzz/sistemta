<?php

namespace App\Http\Controllers;

use App\Models\MhsTa;
use Illuminate\Http\Request;

class VerifikasiTAController extends Controller
{
    public function index()
    {
        $mhsTa = MhsTa::with('mahasiswa')->get();
        return view('admin.verifikasi_berkas_ta', compact('mhsTa'));
    }

    public function verifikasi($id_ta)
    {
        $mhsTa = MhsTa::findOrFail($id_ta);
        $mhsTa->verif_berkas = '1';
        $mhsTa->save();

        return redirect()->route('verif_berkas_sempro.index')->with('success', 'Berkas Sempro berhasil diverifikasi!');
    }

    public function update($id_sempro)
    {
        $mhsTa = MhsTa::findOrFail($id_sempro);
        $mhsTa->verif_berkas = '0';
        $mhsTa->save();

        return redirect()->route('verif_berkas_ta.index')->with('success', 'Status verifikasi berhasil diubah menjadi "Belum".');
    }
}
