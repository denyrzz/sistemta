<?php

namespace App\Http\Controllers;

use App\Models\TempatPkl;
use Illuminate\Http\Request;

class TempatPklController extends Controller
{
    public function index()
    {
        $tempatPkl = TempatPkl::all();
        return view('admin.tempat_pkl', compact('tempatPkl'));
    }

    public function create()
    {
        return view('admin.form.create_tempat_pkl');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'nullable|string|max:20',
            'status' => 'required|in:0,1', // Ensure status is validated correctly
        ]);

        // Save Tempat PKL data
        $tempatPkl = TempatPkl::create([
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
            'status' => $request->status, // Make sure status is being passed
        ]);

        return redirect()->route('tempat_pkl.index')->with('success', 'Tempat PKL berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $tempatPkl = TempatPkl::findOrFail($id);
        return view('admin.form.edit_tempat_pkl', compact('tempatPkl'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'nullable|string|max:20',
            'kuota' => 'integer|min:0',
            'status' => 'required|in:0,1'
        ]);

        $tempatPkl = TempatPkl::findOrFail($id);
        $tempatPkl->update($request->all());

        return redirect()->route('tempat_pkl.index')->with('success', 'Tempat PKL berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tempatPkl = TempatPkl::findOrFail($id);
        $tempatPkl->delete();

        return redirect()->route('tempat_pkl.index')->with('success', 'Tempat PKL berhasil dihapus.');
    }
}
