<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Exports\MahasiswaExport;
use App\Imports\MahasiswaImport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class MahasiswaController extends Controller
{
    public function index()
    {
        $data_mahasiswa = Mahasiswa::with('prodi')
            ->orderBy('id_mahasiswa')
            ->get();

        return view('admin.mahasiswa', compact('data_mahasiswa'));
    }

    public function create()
    {
        $prodi = Prodi::orderBy('id_prodi')->get();
        return view('admin.form.create_mahasiswa', compact('prodi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim',
            'nama' => 'required|string|max:255',
            'prodi_id' => 'required|exists:prodi,id_prodi',
            'jenis_kelamin' => 'required|string',
            'email' => 'required|string|email|unique:mahasiswa,email',
            'password' => 'required|string|min:6|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('mahasiswa');

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'public/uploads/mahasiswa/image/';
            $file->storeAs($path, $filename);
            $imagePath = $filename;
        }

        Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'prodi_id' => $request->prodi_id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'email' => $request->email,
            'password' => $request->password,
            'image' => $imagePath,
            'user_id' => $user->id, // Assuming there's a user_id foreign key in mahasiswa table
        ]);


        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $prodi = Prodi::orderBy('id_prodi')->get();
        return view('admin.form.edit_mahasiswa', compact('mahasiswa', 'prodi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim,' . $id . ',id_mahasiswa',
            'nama' => 'required|string|max:255',
            'prodi_id' => 'required|exists:prodi,id_prodi',
            'jenis_kelamin' => 'required|string',
            'email' => 'required|string|email|unique:mahasiswa,email,' . $id.',id_mahasiswa',
            'password' => 'nullable|string|min:6|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $mahasiswa = Mahasiswa::findOrFail($id);
        $user = User::findOrFail($mahasiswa->user_id);

        // Update fields
        $mahasiswa->nim = $request->input('nim');
        $mahasiswa->nama = $request->input('nama');
        $mahasiswa->prodi_id = $request->input('prodi_id');
        $mahasiswa->jenis_kelamin = $request->input('jenis_kelamin');
        $mahasiswa->email = $request->input('email');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'public/uploads/mahasiswa/image/';
            $file->storeAs($path, $filename);
            $mahasiswa->image = $filename;
        }

        $user->name = $request->nama; // Update user name
        $user->email = $request->email; // Update user email

        $mahasiswa->save();
        $user->save(); // Save the user record

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diupdate.');
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::with('prodi')->findOrFail($id);
        return view('admin.form.formDetailMahasiswa', compact('mahasiswa'));
    }

    public function export()
    {
        return Excel::download(new MahasiswaExport, 'data_mahasiswa.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new MahasiswaImport, $request->file('file'));
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diimpor.');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $user = User::find($mahasiswa->user_id);

        // Delete associated user
        if ($user) {
            $user->delete();
        }

        // Delete Mahasiswa record
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus.');
    }
}
