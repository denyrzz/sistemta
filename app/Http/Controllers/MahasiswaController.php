<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{


    public function index()
    {
        $data_mahasiswa = DB::table('mahasiswa')
            ->join('prodi', 'mahasiswa.prodi_id', '=', 'prodi.id_prodi')
            ->select('mahasiswa.*', 'prodi.prodi as prodi_nama')
            ->orderBy('id_mhs')
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
            'jekel' => 'required',
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
            'jekel' => $request->jekel,
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
        $mahasiswa = Mahasiswa::where('id_mhs', $id)->first();
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
            'jekel' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi untuk file gambar
        ]);

        // Ambil data mahasiswa yang ada berdasarkan id
        $mahasiswa = DB::table('mahasiswa')->where('id_mhs', $id)->first();

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
        DB::table('mahasiswa')->where('id_mhs', $id)->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'prodi_id' => $request->prodi_id,
            'jekel' => $request->jekel,
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
            ->where('mahasiswa.id_mhs', $id)
            ->first();

        // Kirim data mahasiswa ke view detailMahasiswa
        return view('admin.form.formDetailMahasiswa', compact('mahasiswa'));
    }

    public function destroy($id)
    {
        DB::table('mahasiswa')->where('id_mhs', $id)->delete();
        return redirect('/mahasiswa')->with('success', 'Mahasiswa berhasil dihapus.');
    }

    // function export_excel()
    // {
    //     return Excel::download(new ExportStudent, "Student.xlsx");
    // }

    // public function import_excel(Request $request)
    // {
    //     $request->validate([
    //         'file' => 'required|mimes:csv,xls,xlsx'
    //     ]);

    //     $file = $request->file('file');
    //     $name_file = rand() . $file->getClientOriginalName();
    //     $file->move(public_path('file_student'), $name_file);

    //     Excel::import(new ImportStudent, public_path('file_student/' . $name_file));

    //     return back()->with('success', 'File has been imported successfully.');
    // }

}
