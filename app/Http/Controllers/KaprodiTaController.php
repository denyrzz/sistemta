<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use App\Models\User;
use App\Models\Dosen;
use App\Models\MhsTa;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class KaprodiTaController extends Controller
{
    public function index()
    {
        $dosen = Dosen::all();
        $ruangan = Ruangan::all();
        $sesi = Sesi::all();
        $data_ta = MhsTa::with(['mahasiswa', 'ruangan', 'sesi', 'ketuasidang', 'penguji1', 'penguji2', 'penguji3'])
            ->get();

        return view('kaprodi.pengajuan_ta', compact('data_ta', 'dosen', 'sesi', 'ruangan'));
    }


}
