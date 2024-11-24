<?php

namespace App\Http\Controllers;

use App\Models\Jurusan; // Ensure you have a Jurusan model
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $data_jurusan = Jurusan::orderBy('id_jurusan')->get();
        return view('admin.jurusan', compact('data_jurusan'));
    }

    public function create()
    {
        return view('admin.form.create_jurusan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_jurusan' => 'required|string|max:10',
            'jurusan' => 'required|string|max:255',
        ]);

        Jurusan::create([
            'kode_jurusan' => $request->kode_jurusan,
            'jurusan' => $request->jurusan,
        ]);

        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        // Implement this method if needed
    }

    public function edit(string $id)
    {
        $jurusan = Jurusan::find($id);

        if (!$jurusan) {
            return redirect()->route('jurusan.index')->with('error', 'Jurusan tidak ditemukan.');
        }

        return view('admin.form.edit_jurusan', compact('jurusan'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_jurusan' => 'required|string|max:10',
            'jurusan' => 'required|string|max:255',
        ]);

        $jurusan = Jurusan::find($id);
        if (!$jurusan) {
            return redirect()->route('jurusan.index')->with('error', 'Jurusan tidak ditemukan.');
        }

        $jurusan->update([
            'kode_jurusan' => $request->kode_jurusan,
            'jurusan' => $request->jurusan,
        ]);

        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $jurusan = Jurusan::find($id);
        if (!$jurusan) {
            return redirect()->route('jurusan.index')->with('error', 'Jurusan tidak ditemukan.');
        }

        $jurusan->delete();
        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil dihapus.');
    }
}
