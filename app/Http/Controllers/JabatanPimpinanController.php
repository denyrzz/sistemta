<?php

namespace App\Http\Controllers;

use App\Models\JabatanPimpinan;
use Illuminate\Http\Request;

class JabatanPimpinanController extends Controller
{
    public function index()
    {
        $jabatanPimpinan = JabatanPimpinan::all();
        return view('admin.jabatan_pimpinan', compact('jabatanPimpinan'));
    }

    public function create()
    {
        return view('admin.form.create_jabatan_pimpinan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jabatan_pimpinan' => 'required|string|max:255',
            'kode_jabatan_pimpinan' => 'required|string|max:50',
            'status_jabatan_pimpinan' => 'required|in:0,1',
        ]);

        JabatanPimpinan::create($request->all());

        return redirect()->route('jabatan_pimpinan')->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jabatan = JabatanPimpinan::findOrFail($id);
        return view('admin.form.edit_jabatan_pimpinan', compact('jabatan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jabatan_pimpinan' => 'required|string|max:255',
            'kode_jabatan_pimpinan' => 'required|string|max:50',
            'status_jabatan_pimpinan' => 'required|in:0,1',
        ]);

        $jabatan = JabatanPimpinan::findOrFail($id);
        $jabatan->update($request->all());

        return redirect()->route('jabatan_pimpinan')->with('success', 'Jabatan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $jabatan = JabatanPimpinan::findOrFail($id);
        $jabatan->delete();

        return redirect()->route('jabatan_pimpinan')->with('success', 'Jabatan berhasil dihapus.');
    }
}
