<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        $data_ruangan = Ruangan::all();
        return view('admin.ruangan', compact('data_ruangan'));
    }

    public function create()
    {
        return view('admin.form.create_ruangan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ruangan' => 'required',
            'no_ruangan' => 'required|unique:ruangan'
        ]);

        Ruangan::create($request->all());

        return redirect()->route('ruangan')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        return view('admin.form.edit_ruangan', compact('ruangan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_ruangan' => 'required',
            'no_ruangan' => 'required|unique:ruangan,no_ruangan,' . $id
        ]);

        $ruangan = Ruangan::findOrFail($id);
        $ruangan->update($request->all());

        return redirect()->route('ruangan')->with('success', 'Ruangan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $ruangan->delete();

        return redirect()->route('ruangan')->with('success', 'Ruangan berhasil dihapus.');
    }
}
