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
            'kode_jabatan' => 'required|string|max:100',
            'status_jabatan' => 'required|in:0,1',
        ]);

        JabatanPimpinan::create($request->all());
        return redirect()->route('jabatan_pimpinan.index')->with('success', 'Jabatan Pimpinan berhasil ditambahkan.');
    }

    public function edit($id)
    {

        $jabatanPimpinan = JabatanPimpinan::findOrFail($id);
        return view('admin.form.edit_jabatan_pimpinan', compact('jabatanPimpinan'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'jabatan_pimpinan' => 'required|string|max:255',
            'kode_jabatan' => 'required|string|max:100',
            'status_jabatan' => 'required|in:0,1',
        ]);


        $jabatanPimpinan = JabatanPimpinan::findOrFail($id);
        $jabatanPimpinan->update($request->only(['jabatan_pimpinan', 'kode_jabatan', 'status_jabatan']));

        return redirect()->route('jabatan_pimpinan.index')->with('success', 'Jabatan Pimpinan berhasil diupdate.');
    }

    public function destroy($id)
    {

        $jabatanPimpinan = JabatanPimpinan::findOrFail($id);
        $jabatanPimpinan->delete();

        return redirect()->route('jabatan_pimpinan.index')->with('success', 'Jabatan Pimpinan berhasil dihapus.');
    }
}
