<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use Illuminate\Http\Request;

class SesiController extends Controller
{
    /**
     * Menampilkan daftar semua sesi.
     */
    public function index()
    {
        $data_sesi = Sesi::all();
        return view('admin.sesi', compact('data_sesi'));
    }

    public function create()
    {
        return view('admin.form.create_sesi');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sesi' => 'required',
            'jam' => 'required',
        ]);

        Sesi::create($request->all());

        return redirect()->route('sesi.index')
            ->with('success', 'Sesi berhasil ditambahkan.');
    }

    public function edit($id_sesi)
    {
        $sesi = Sesi::findOrFail($id_sesi);

        return view('admin.form.edit_sesi', compact('sesi'));
    }

    public function update(Request $request, $id_sesi)
    {
        $request->validate([
            'sesi' => 'nullable',
            'jam' => 'nullable',
        ]);

        $sesi = Sesi::findOrFail($id_sesi);

        return redirect()->route('sesi.index')->with('success', 'Sesi berhasil diperbarui.');
    }

    public function destroy($id_sesi)
    {
        $sesi = Sesi::findOrFail($id_sesi);
        $sesi->delete();

        return redirect()->route('sesi.index')
            ->with('success', 'Sesi berhasil dihapus.');
    }
}
