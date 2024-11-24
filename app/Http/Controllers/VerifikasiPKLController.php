<?php

namespace App\Http\Controllers;

use App\Models\MhsPkl;
use Illuminate\Http\Request;

class VerifikasiPKLController extends Controller
{
    public function index()
    {
        $mhsPkl = MhsPkl::with('mahasiswa')->get(); // eager load mahasiswa
        return view('admin.verifikasi_berkas_pkl', compact('mhsPkl'));
    }

    public function verifikasi($id_pkl)
    {
        $mhsPkl = MhsPkl::findOrFail($id_pkl);
        $mhsPkl->verif_berkas = '1'; // Set '1' to indicate the document is verified
        $mhsPkl->save();

        return redirect()->route('verif_berkas.index')->with('success', 'Berkas PKL berhasil diverifikasi!');
    }

    public function update($id_pkl)
    {
        $mhsPkl = MhsPkl::findOrFail($id_pkl);
        $mhsPkl->verif_berkas = '0'; // Set '0' to indicate the document is not verified
        $mhsPkl->save();

        return redirect()->route('verif_berkas.index')->with('success', 'Status verifikasi berhasil diubah menjadi "Belum".');
    }
}
