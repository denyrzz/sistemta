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
            'no_ruangan' => 'required|unique:ruangan',
            'jam' => 'required'
        ]);

        Ruangan::create($request->all());

        return redirect()->route('ruangan')->with('success', 'Ruangan created successfully.');
    }

    public function edit($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        return view('admin.form.edit_ruangan', compact('ruangan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_ruangan' => 'required|unique:ruangan,no_ruangan,'.$id,
            'jam' => 'required'
        ]);

        $ruangan = Ruangan::findOrFail($id);
        $ruangan->update($request->all());

        return redirect()->route('ruangan')->with('success', 'Ruangan updated successfully.');
    }

    public function destroy($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $ruangan->delete();

        return redirect()->route('ruangan')->with('success', 'Ruangan deleted successfully.');
    }
}
