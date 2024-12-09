<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('superadmin.users.user', [
            'users' => $users
        ]);
    }

    public function createMhs()
    {
        $prodi = Prodi::all();
        return view('superadmin.users.createmahasiswa', compact('prodi'));
    }

    public function storeMhs(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim',
            'nama' => 'required',
            'prodi_id' => 'required',
            'jenis_kelamin' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/mahasiswa', 'public');
        }

        Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'prodi_id' => $request->prodi_id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'email' => $request->email,
            'password' => $request->password,
            'image' => $imagePath,
            'user_id' => $user->id,
        ]);

        return redirect()->route('users.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function createDsn()
    {
        $jurusan = Jurusan::all();
        $prodi = Prodi::all();
        return view('superadmin.users.createdosen', compact('jurusan', 'prodi'));
    }

    public function storeDsn(Request $request)
    {
        $request->validate([
            'nama_dosen' => 'required',
            'nidn' => 'required|unique:dosen,nidn',
            'nip' => 'nullable|unique:dosen,nip',
            'jenis_kelamin' => 'required',
            'jurusan_id' => 'required',
            'prodi_id' => 'required',
            'golongan' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|boolean',
        ]);

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/dosen', 'public');
        }

        Dosen::create([
            'nama_dosen' => $request->nama_dosen,
            'nidn' => $request->nidn,
            'nip' => $request->nip,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jurusan_id' => $request->jurusan_id,
            'prodi_id' => $request->prodi_id,
            'golongan' => $request->golongan,
            'email' => $request->email,
            'password' => $request->password,
            'image' => $imagePath,
            'status' => $request->status,
            'user_id' => $user->id,
        ]);

        return redirect()->route('users.index')->with('success', 'Dosen berhasil ditambahkan.');
    }
}
