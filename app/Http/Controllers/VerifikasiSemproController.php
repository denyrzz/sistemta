<?php

namespace App\Http\Controllers;

use App\Models\MhsSempro;
use Illuminate\Http\Request;

class VerifikasiSemproController extends Controller
{
    public function index()
    {
        $mhsSempro = MhsSempro::with('mahasiswa')->get();
        return view('admin.verifikasi_berkas_sempro', compact('mhsSempro'));
    }

    public function verifikasi($id_sempro)
    {
        $mhsSempro = MhsSempro::findOrFail($id_sempro);
        $mhsSempro->verif_berkas = '1';
        $mhsSempro->save();

        return redirect()->route('verif_berkas_sempro.index')->with('success', 'Berkas Sempro berhasil diverifikasi!');
    }

    public function update($id_sempro)
    {
        $mhsSempro = MhsSempro::findOrFail($id_sempro);
        $mhsSempro->verif_berkas = '0';
        $mhsSempro->save();

        return redirect()->route('verif_berkas_sempro.index')->with('success', 'Status verifikasi berhasil diubah menjadi "Belum".');
    }
}


