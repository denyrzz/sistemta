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

    /**
     * Menampilkan formulir untuk membuat sesi baru.
     */
    public function create()
    {
        return view('admin.form.create_sesi');
    }

    /**
     * Menyimpan sesi baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'dari_jam' => 'required|date_format:H:i',
            'sampai_jam' => 'required|date_format:H:i|after:dari_jam',
        ]);

        // Membuat sesi baru
        Sesi::create($request->all());

        return redirect()->route('sesi')  // Fix the route to 'sesi.index'
                         ->with('success', 'Sesi berhasil ditambahkan.');
    }

    /**
     * Menampilkan formulir untuk mengedit sesi tertentu.
     */
    public function edit($id_sesi)
    {
        $sesi = Sesi::findOrFail($id_sesi);
        return view('admin.form.edit_sesi', compact('sesi'));
    }

    /**
     * Memperbarui sesi tertentu di database.
     */
    public function update(Request $request, $id_sesi)
    {
        // Validasi input
        $request->validate([
            'dari_jam' => 'required|date_format:H:i',
            'sampai_jam' => 'required|date_format:H:i|after:dari_jam',
        ]);

        // Memperbarui sesi
        $sesi = Sesi::findOrFail($id_sesi);
        $sesi->update($request->all());

        return redirect()->route('sesi')  // Fix the route to 'sesi.index'
                         ->with('success', 'Sesi berhasil diperbarui.');
    }

    /**
     * Menghapus sesi tertentu dari database.
     */
    public function destroy($id_sesi)  // Change to receive $id_sesi instead of Sesi model
    {
        $sesi = Sesi::findOrFail($id_sesi);  // Find the Sesi using id_sesi
        $sesi->delete();

        return redirect()->route('sesi')  // Fix the route to 'sesi.index'
                         ->with('success', 'Sesi berhasil dihapus.');
    }
}
