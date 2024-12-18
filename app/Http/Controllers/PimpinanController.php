<?php

namespace App\Http\Controllers;

use App\Models\Pimpinan;
use App\Models\Dosen;
use App\Models\JabatanPimpinan;
use Illuminate\Http\Request;

class PimpinanController extends Controller
{
    public function index()
    {
        $pimpinans = Pimpinan::with(['dosen', 'jabatanPimpinan'])->get();
        return view('admin.pimpinan', compact('pimpinans'));
    }

    public function create()
    {
        $dosens = Dosen::all();
        $jabatanPimpinans = JabatanPimpinan::all();
        return view('admin.form.create_pimpinan', compact('dosens', 'jabatanPimpinans'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'dosen_id' => 'required|integer|exists:dosen,id_dosen',
            'jabatan_id' => 'required|integer|exists:jabatan_pimpinan,id_jabatan',
            'periode' => 'required|string|max:255',
            'status_pimpinan' => 'required|in:0,1',
        ]);

        Pimpinan::create($request->only(['dosen_id', 'jabatan_id', 'periode', 'status_pimpinan']));

        return redirect()->route('pimpinan.index')->with('success', 'Pimpinan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pimpinan = Pimpinan::findOrFail($id);
        $dosens = Dosen::all();
        $jabatanPimpinans = JabatanPimpinan::all();
        return view('admin.form.edit_pimpinan', compact('pimpinan', 'dosens', 'jabatanPimpinans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'dosen_id' => 'required|exists:dosen,id_dosen',
            'jabatan_id' => 'required|exists:jabatan_pimpinan,id_jabatan',
            'periode' => 'required|string|max:255',
            'status_pimpinan' => 'required|in:0,1',
        ]);

        $pimpinan = Pimpinan::findOrFail($id);
        $pimpinan->update($request->only(['dosen_id', 'jabatan_id', 'periode', 'status_pimpinan']));

        return redirect()->route('pimpinan.index')->with('success', 'Pimpinan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $pimpinan = Pimpinan::findOrFail($id);
        $pimpinan->delete();

        return redirect()->route('pimpinan.index')->with('success', 'Pimpinan berhasil dihapus.');
    }
}
