<?php

namespace App\Http\Controllers;

use App\Models\MhsSempro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        $mahasiswa_id = auth()->user()->mahasiswa->id_mahasiswa;

        // Handle file upload
        if ($request->hasFile('file_sempro')) {
            $filename = time() . '_' . md5($request->file('file_sempro')->getClientOriginalName()) . '.' . $request->file('file_sempro')->getClientOriginalExtension();
            $file_path = $request->file('file_sempro')->storeAs('public/uploads/mahasiswa/sempro', $filename);
        }

        // Create new Sempro entry
        $sempro = new MhsSempro();
        $sempro->judul = $request->judul;
        $sempro->file_sempro = $filename;
        $sempro->mahasiswa_id = $mahasiswa_id;
        $sempro->save();

        return redirect()->route('mhs_sempro.index')->with('success', 'Sempro judul submitted successfully.');
    }

    public function destroy($id)
    {
        // Temukan data berdasarkan ID
        $sempro = MhsSempro::findOrFail($id);

        // Hapus file dari storage jika ada
        if (!empty($sempro->file_sempro)) {
            $filePath = 'public/uploads/mahasiswa/sempro/' . $sempro->file_sempro;
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }

        // Hapus data dari database
        $sempro->delete();

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('mhs_sempro.index')->with('success', 'Data Sempro berhasil dihapus.');
    }
    public function verify($id)
    {
        // Cari data berdasarkan ID
        $sempro = MhsSempro::find($id);

        if (!$sempro) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        // Ubah status menjadi 1
        $sempro->status = '1';
        $sempro->save();

        return redirect()->back()->with('success', 'Data berhasil diverifikasi.');
    }
}
