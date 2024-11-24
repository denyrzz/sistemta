<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Exports\DosenExport;
use App\Imports\DosenImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Add this line
use App\Http\Controllers\Controller;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

class DosenController extends Controller
{
    public function index()
    {
        $data_dosen = DB::table('dosen')
            ->join('jurusan', 'dosen.jurusan_id', '=', 'jurusan.id_jurusan')
            ->join('prodi', 'dosen.prodi_id', '=', 'prodi.id_prodi')
            ->select('dosen.*', 'jurusan.jurusan', 'prodi.prodi')
            ->orderBy('id_dosen')
            ->get();

        return view('admin.dosen', compact('data_dosen'));
    }

    public function create()
    {
        $jurusan = DB::table('jurusan')->orderBy('id_jurusan')->get();
        $prodi = DB::table('prodi')->orderBy('id_prodi')->get();

        return view('admin.form.create_dosen', compact('jurusan', 'prodi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_dosen' => 'required|string|max:255',
            'nidn' => 'required|string|unique:dosen,nidn',
            'nip' => 'required|string|unique:dosen,nip',
            'jenis_kelamin' => 'required|string',
            'jurusan_id' => 'required|exists:jurusan,id_jurusan',
            'prodi_id' => 'required|exists:prodi,id_prodi',
            'golongan' => 'required|in:1,2,3,4',
            'email' => 'required|string|email|unique:dosen,email',
            'password' => 'required|string|min:6|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:0,1',
        ]);


        $user = User::create([
            'name' => $request->nama_dosen,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $path = 'public/uploads/dosen/image/';
            $file->storeAs($path, $filename);
            $imagePath = $filename;
        }

        // Hash the password before storing it
        $hashedPassword = Hash::make($request->password);

        DB::table('dosen')->insert([
            'nama_dosen' => $request->nama_dosen,
            'nidn' => $request->nidn,
            'nip' => $request->nip,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jurusan_id' => $request->jurusan_id,
            'prodi_id' => $request->prodi_id,
            'golongan' => $request->golongan,
            'email' => $request->email,
            'password' => $hashedPassword,
            'image' => $imagePath,
            'status' => $request->status,
            'user_id' => $user->id
        ]);

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $dosen = DB::table('dosen')->where('id_dosen', $id)->first();
        $jurusan = DB::table('jurusan')->get();
        $prodi = DB::table('prodi')->get();

        if ($dosen) {
            return view('admin.form.edit_dosen', compact('dosen', 'jurusan', 'prodi'));
        } else {
            return redirect()->route('dosen.index')->with('error', 'Dosen tidak ditemukan');
        }
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_dosen' => 'required|string|max:255',
            'nidn' => 'required|string|unique:dosen,nidn,' . $id . ',id_dosen',
            'nip' => 'required|string|unique:dosen,nip,' . $id . ',id_dosen',
            'jenis_kelamin' => 'required|string',
            'jurusan_id' => 'required|exists:jurusan,id_jurusan',
            'prodi_id' => 'required|exists:prodi,id_prodi',
            'golongan' => 'required|in:1,2,3,4',
            'email' => 'required|string|email|unique:dosen,email,' . $id . ',id_dosen',
            'password' => 'nullable|string|min:6|confirmed', // Make password optional
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:0,1',
        ]);

        // Retrieve existing dosen and user
        $dosen = DB::table('dosen')->where('id_dosen', $id)->first();
        $user = User::find($dosen->user_id);

        if (!$dosen || !$user) {
            return redirect()->route('dosen.index')->with('error', 'Dosen atau User tidak ditemukan');
        }

        $imagePath = $dosen->image; // Default to existing image

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $path = 'public/uploads/dosen/image/';
            $file->storeAs($path, $filename);
            $imagePath = $filename; // Update imagePath if a new image is uploaded
        }

        // Update data for dosen
        $dataToUpdate = [
            'nama_dosen' => $request->nama_dosen,
            'nidn' => $request->nidn,
            'nip' => $request->nip,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jurusan_id' => $request->jurusan_id,
            'prodi_id' => $request->prodi_id,
            'golongan' => $request->golongan,
            'email' => $request->email,
            'image' => $imagePath,
            'status' => $request->status,
        ];

        // Update user data
        $user->name = $request->nama_dosen; // Update user name
        $user->email = $request->email; // Update user email

        // Only hash and update the password if it's provided
        if ($request->filled('password')) {
            $dataToUpdate['password'] = Hash::make($request->password);
            $user->password = $dataToUpdate['password']; // Update user password
        }

        // Update the dosen record
        DB::table('dosen')->where('id_dosen', $id)->update($dataToUpdate);

        // Save the user data
        $user->save();

        return redirect()->route('dosen.index')->with('success', 'Data Dosen berhasil diupdate');
    }


    public function export()
    {
        return Excel::download(new DosenExport, 'datadosen.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new DosenImport, $request->file('file'));
        return redirect()->route('dosen.index')->with('success', 'Data Dosen berhasil diimpor');
    }

    public function show($id)
    {
        $data_dosen = Dosen::with('jurusan', 'prodi')->findOrFail($id);
        return view('admin.dosen_show', compact('data_dosen'));
    }

    public function destroy(string $id)
    {
        $dosen = DB::table('dosen')->where('id_dosen', $id)->first();

        if ($dosen) {
            DB::table('dosen')->where('id_dosen', $id)->delete();
            return redirect()->route('dosen.index')->with('success', 'Data Dosen berhasil dihapus');
        } else {
            return redirect()->route('dosen.index')->with('error', 'Data Dosen tidak ditemukan');
        }
    }
}
