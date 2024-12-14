<?php

namespace App\Http\Controllers;

use App\Models\MhsSempro;
use Illuminate\Http\Request;

class MhsSemproController extends Controller
{
    public function index()
    {
        $mahasiswaId = auth()->user()->mahasiswa->id_mahasiswa;
        $data_sempro = MhsSempro::with(['mahasiswa', 'ruangan', 'sesi', 'pembimbingSatu', 'pembimbingDua', 'penguji'])
            ->where('mahasiswa_id', $mahasiswaId)
            ->get();

        return view('mahasiswa.sempro', compact('data_sempro'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'file_sempro' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);

        // Retrieve mahasiswa_id from the logged-in user
        $mahasiswa_id = auth()->user()->mahasiswa->id_mahasiswa;

        // Store the uploaded file
        $file_path = $request->file('file_sempro')->store('uploads/sempro');

        // Create new Sempro entry
        $sempro = new MhsSempro();
        $sempro->judul = $request->judul;
        $sempro->file_sempro = $file_path;
        $sempro->mahasiswa_id = $mahasiswa_id;  // Associate with the current mahasiswa
        $sempro->save();

        return redirect()->route('mhs_sempro.index')->with('success', 'Sempro judul submitted successfully.');
    }
}
