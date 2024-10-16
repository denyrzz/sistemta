<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Exports\MahasiswaExport;

use App\Imports\MahasiswaImport;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{

    public function index()
    {
        $data_mahasiswa = DB::table('mahasiswa')
            ->join('prodi', 'mahasiswa.prodi_id', '=', 'prodi.id_prodi')
            ->select('mahasiswa.*', 'prodi.prodi as prodi_nama')
            ->orderBy('id_mahasiswa')
            ->get();
        return view('admin.mahasiswa', compact('data_mahasiswa'));
    }
    public function create()
    {
        $prodi = Prodi::all();
        return view('admin.form.create_mahasiswa', compact('prodi'));
    }

    public function store(Request $request)
    {
        // Validasi form
        $validator = Validator::make($request->all(), [
            'nim' => 'required|unique:mahasiswa,nim',
            'nama' => 'required',
            'prodi_id' => 'required',
            'jenis_kelamin' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Prepare the data for Mahasiswa creation
        $mahasiswaData = [
            'nim' => $request->nim,
            'nama' => $request->nama,
            'prodi_id' => $request->prodi_id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'image' => null, // Initialize image to null
        ];

        // Proses upload file gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // Buat nama unik untuk gambar dengan menambahkan timestamp
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            // Pindahkan gambar ke folder public/images/mahasiswa
            $image->move(public_path('images/mahasiswa'), $imageName);
            $mahasiswaData['image'] = $imageName; // Set the image name in the data array
        }

        // Simpan data mahasiswa ke database
        Mahasiswa::create($mahasiswaData);

        return redirect('/mahasiswa')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $mahasiswa = Mahasiswa::where('id_mahasiswa', $id)->first();
        $prodi = DB::table('prodi')->get(); // Mendapatkan semua data prodi
        return view('admin.form.edit_mahasiswa', compact('mahasiswa', 'prodi')); // Mengirimkan ke view
    }
    public function update(Request $request, $id)
    {
        // Validasi form
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'prodi_id' => 'required',
            'jenis_kelamin' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi untuk file gambar
        ]);

        // Ambil data mahasiswa yang ada berdasarkan id
        $mahasiswa = DB::table('mahasiswa')->where('id_mahasiswa', $id)->first();

        // Cek apakah ada file gambar yang diupload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // Buat nama baru untuk gambar
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            // Pindahkan gambar ke folder public/images/mahasiswa
            $image->move(public_path('images/mahasiswa'), $imageName);

            // Hapus gambar lama jika ada
            if ($mahasiswa->image && file_exists(public_path('images/mahasiswa/' . $mahasiswa->image))) {
                unlink(public_path('images/mahasiswa/' . $mahasiswa->image));
            }
        } else {
            // Jika tidak ada gambar baru yang diupload, tetap gunakan gambar lama
            $imageName = $mahasiswa->image;
        }

        // Perbarui data mahasiswa ke database
        DB::table('mahasiswa')->where('id_mahasiswa', $id)->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'prodi_id' => $request->prodi_id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'image' => $imageName, // Simpan nama file gambar baru atau lama
        ]);

        return redirect('/mahasiswa')->with('success', 'Mahasiswa berhasil diupdate.');
    }

    public function show($id)
    {
        // Mengambil data mahasiswa berdasarkan id beserta data prodi-nya
        $mahasiswa = DB::table('mahasiswa')
            ->join('prodi', 'mahasiswa.prodi_id', '=', 'prodi.id_prodi')
            ->select('mahasiswa.*', 'prodi.nama_prodi')
            ->where('mahasiswa.id_mahasiswa', $id)
            ->first();

        // Kirim data mahasiswa ke view detailMahasiswa
        return view('admin.form.formDetailMahasiswa', compact('mahasiswa'));
    }

    public function export()
    {
        return Excel::download(new MahasiswaExport, 'datamahasiswa.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new MahasiswaImport, $request->file('file'));
        return redirect('mahasiswa')->with('success', 'All good!');
    }

    public function destroy($id)
    {
        DB::table('mahasiswa')->where('id_mahasiswa', $id)->delete();
        return redirect('/mahasiswa')->with('success', 'Mahasiswa berhasil dihapus.');
    }


}
