<?php

namespace App\Http\Controllers;

use App\Models\MhsPkl;
use App\Models\MhsLogbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MhsLogbookController extends Controller
{
    public function index()
    {
        $mahasiswaId = auth()->user()->mahasiswa->id_mahasiswa;

        // Assuming `pkl_id` is the foreign key that links `mhs_logbook` to the `mhs_pkl` table,
        // and `mhs_pkl` has `mahasiswa_id` to identify the mahasiswa
        $logbooks = MhsLogbook::whereHas('mhspkl', function ($query) use ($mahasiswaId) {
            $query->where('mahasiswa_id', $mahasiswaId);
        })->get();

        return view('admin.mhs_logbook', compact('logbooks'));
    }

    public function create()
    {
        $mahasiswa = auth()->user()->mahasiswa->load('mhs_pkl');

        if ($mahasiswa && $mahasiswa->mhs_pkl) {
            $pklId = $mahasiswa->mhs_pkl->id_pkl;
        } else {
            $pklId = null;
        }

        if (is_null($pklId)) {
            dd("Mahasiswa ID: " . ($mahasiswa ? $mahasiswa->id_mahasiswa : 'null'), $mahasiswa->mhs_pkl);
        }

        return view('admin.form.create_logbook', compact('pklId'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'pkl_id' => 'required|exists:mhs_pkl,id_pkl',
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date',
            'komentar' => 'required|string',
            'dokumentasi' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        // Process and store logbook entry as before
        $logbook = new MhsLogbook();
        $logbook->pkl_id = $request->input('pkl_id');
        $logbook->tgl_awal = $request->input('tgl_awal');
        $logbook->tgl_akhir = $request->input('tgl_akhir');
        $logbook->kegiatan = $request->input('kegiatan');
        $logbook->komentar = $request->input('komentar');

        if ($request->hasFile('dokumentasi')) {
            $filename = time() . '_' . $request->file('dokumentasi')->getClientOriginalName();
            $request->file('dokumentasi')->storeAs('public/uploads/mahasiswa/dokumentasi', $filename);
            $logbook->dokumentasi = $filename;
        }

        $logbook->save();

        return redirect()->route('mhs_logbook.index')->with('success', 'Logbook berhasil ditambahkan');
    }

}
