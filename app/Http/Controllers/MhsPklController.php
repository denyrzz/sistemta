<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\MhsPkl;
use App\Models\UsulanPkl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MhsPklController extends Controller
{
    public function index()
    {
        $mahasiswaId = auth()->user()->mahasiswa->id_mahasiswa;

        $data_pkl = MhsPkl::with(['mahasiswa', 'tempat', 'ruangan', 'sesi', 'dosenPembimbing', 'dosenPenguji'])
            ->where('mahasiswa_id', $mahasiswaId)
            ->first();

        if (!$data_pkl) {
            return redirect()->route('mhs_pkl.index')->with('error', 'Data PKL not found for this mahasiswa.');
        }

        return view('admin.mhs_pkl', compact('data_pkl'));
    }

    public function edit($id)
    {
        $data_pkl = MhsPkl::with('mahasiswa', 'tempat', 'dosenPembimbing')->findOrFail($id);
        return view('admin.pkl.detail', compact('data_pkl'));
    }

    public function update(Request $request, string $id)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'judul' => 'nullable|string',
            'pembimbing_industri' => 'nullable|string',
            'nilai_pembimbing_industri' => 'nullable|numeric',
            'dokument_nilai_industri' => 'nullable|file|mimes:pdf,doc,docx,jpg,png',
            'dokument_pkl' => 'nullable|file|mimes:pdf,doc,docx,jpg,png',
            'dokument_pkl_revisi' => 'nullable|file|mimes:pdf,doc,docx,jpg,png',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $oldData = MhsPkl::where('id_pkl', $id)->firstOrFail();

        $data = [
            'judul' => $request->judul,
            'pembimbing_industri' => $request->pembimbing_industri,
            'nilai_pembimbing_industri' => $request->nilai_pembimbing_industri,
        ];

        if ($request->hasFile('dokument_nilai_industri')) {
            Storage::delete('public/uploads/mahasiswa/dokument_nilai_industri/' . $oldData->dokument_nilai_industri);
            $filename = time() . '_' . $request->file('dokument_nilai_industri')->getClientOriginalName();
            $request->file('dokument_nilai_industri')->storeAs('public/uploads/mahasiswa/dokument_nilai_industri', $filename);
            $data['dokument_nilai_industri'] = $filename;
        }

        if ($request->hasFile('dokument_pkl')) {
            Storage::delete('public/uploads/mahasiswa/dokument_pkl/' . $oldData->dokument_pkl);
            $filename = time() . '_' . $request->file('dokument_pkl')->getClientOriginalName();
            $request->file('dokument_pkl')->storeAs('public/uploads/mahasiswa/dokument_pkl', $filename);
            $data['dokument_pkl'] = $filename;
        }

        if ($request->hasFile('dokument_pkl_revisi')) {
            Storage::delete('public/uploads/mahasiswa/dokument_pkl_revisi/' . $oldData->dokument_pkl_revisi);
            $filename = time() . '_' . $request->file('dokument_pkl_revisi')->getClientOriginalName();
            $request->file('dokument_pkl_revisi')->storeAs('public/uploads/mahasiswa/dokument_pkl_revisi', $filename);
            $data['dokument_pkl_revisi'] = $filename;
        }

        $oldData->update($data);

        return redirect()->route('mhs_pkl.index')->with('success', 'Data berhasil diupload.');
    }
}
