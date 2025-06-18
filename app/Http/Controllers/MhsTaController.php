<?php

namespace App\Http\Controllers;

use App\Models\MhsSempro;
use App\Models\MhsTa;
use App\Models\TA;
use App\Models\Sempro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MhsTaController extends Controller
{
    public function index()
    {
        $mahasiswaId = auth()->user()->mahasiswa->id_mahasiswa;

        $data_ta = MhsTa::with(['mahasiswa', 'ruangan', 'sesi','Penguji1','Penguji2','Penguji3','sempro'])
        ->where('mahasiswa_id', $mahasiswaId)
        ->get();

        return view('mahasiswa.ta', compact('data_ta'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'proposal_final' => 'required|mimes:pdf|max:2048',
            'laporan_ta' => 'required|mimes:pdf|max:2048',
            'tugas_akhir' => 'required|mimes:pdf|max:2048',
        ]);

        $mahasiswa_id = auth()->user()->mahasiswa->id_mahasiswa;

        $ta = new MhsTa();
        $ta->mahasiswa_id = $mahasiswa_id;

        if ($request->hasFile('proposal_final')) {
            $proposal_final = $request->file('proposal_final');
            $proposal_final_name = time() . '_' . '_proposal_final.' . $proposal_final->getClientOriginalExtension();
            $proposal_final->storeAs('uploads/mahasiswa/proposal_final', $proposal_final_name, 'public');
            $ta->proposal_final = $proposal_final_name;
        }

        if ($request->hasFile('laporan_ta')) {
            $laporan_ta = $request->file('laporan_ta');
            $laporan_ta_name = time() . '_' . '_laporan_ta.' . $laporan_ta->getClientOriginalExtension();
            $laporan_ta->storeAs('uploads/mahasiswa/laporan_ta', $laporan_ta_name, 'public');
            $ta->laporan_ta = $laporan_ta_name;
        }

        if ($request->hasFile('tugas_akhir')) {
            $tugas_akhir = $request->file('tugas_akhir');
            $tugas_akhir_name = time() . '_' . '_tugas_akhir.' . $tugas_akhir->getClientOriginalExtension();
            $tugas_akhir->storeAs('uploads/mahasiswa/tugas_akhir', $tugas_akhir_name, 'public');
            $ta->tugas_akhir = $tugas_akhir_name;
        }

        $ta->save();

        return redirect()->route('mhs_ta.index')->with('success', 'Data TA berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'proposal_final' => 'nullable|mimes:pdf|max:2048',
            'laporan_ta' => 'nullable|mimes:pdf|max:2048',
            'tugas_akhir' => 'nullable|mimes:pdf|max:2048',
        ]);

        $ta = MhsTa::findOrFail($id);
        $mahasiswa_id = auth()->user()->mahasiswa->id_mahasiswa;

        // Handle file uploads
        if ($request->hasFile('proposal_final')) {
            // Delete old file if exists
            if ($ta->proposal_final) {
                Storage::disk('public')->delete('uploads/mahasiswa/proposal_final/' . $ta->proposal_final);
            }

            $proposal_final = $request->file('proposal_final');
            $proposal_final_name = time() . '_' . '_proposal_final.' . $proposal_final->getClientOriginalExtension();
            $proposal_final->storeAs('uploads/mahasiswa/proposal_final', $proposal_final_name, 'public');
            $ta->proposal_final = $proposal_final_name;
        }

        if ($request->hasFile('laporan_ta')) {
            if ($ta->laporan_ta) {
                Storage::disk('public')->delete('uploads/mahasiswa/laporan_ta/' . $ta->laporan_ta);
            }

            $laporan_ta = $request->file('laporan_ta');
            $laporan_ta_name = time() . '_' . '_laporan_ta.' . $laporan_ta->getClientOriginalExtension();
            $laporan_ta->storeAs('uploads/mahasiswa/laporan_ta', $laporan_ta_name, 'public');
            $ta->laporan_ta = $laporan_ta_name;
        }

        if ($request->hasFile('tugas_akhir')) {
            if ($ta->tugas_akhir) {
                Storage::disk('public')->delete('uploads/mahasiswa/tugas_akhir/' . $ta->tugas_akhir);
            }

            $tugas_akhir = $request->file('tugas_akhir');
            $tugas_akhir_name = time() . '_' . '_tugas_akhir.' . $tugas_akhir->getClientOriginalExtension();
            $tugas_akhir->storeAs('uploads/mahasiswa/tugas_akhir', $tugas_akhir_name, 'public');
            $ta->tugas_akhir = $tugas_akhir_name;
        }

        $ta->save();

        return redirect()->route('mhs_ta.index')->with('success', 'Data TA berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ta = MhsTa::findOrFail($id);

        // Delete associated files
        if ($ta->proposal_final) {
            Storage::disk('public')->delete('uploads/mahasiswa/proposal_final/' . $ta->proposal_final);
        }
        if ($ta->laporan_ta) {
            Storage::disk('public')->delete('uploads/mahasiswa/laporan_ta/' . $ta->laporan_ta);
        }
        if ($ta->tugas_akhir) {
            Storage::disk('public')->delete('uploads/mahasiswa/tugas_akhir/' . $ta->tugas_akhir);
        }

        $ta->delete();

        return redirect()->route('mhs_ta.index')->with('success', 'Data TA berhasil dihapus.');
    }
}
