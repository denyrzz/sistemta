<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\MhsPkl;
use App\Models\Mahasiswa;
use App\Models\TempatPkl;
use App\Models\UsulanPkl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsulanPklController extends Controller
{
    public function index()
    {
        $mahasiswaId = auth()->user()->mahasiswa->id_mahasiswa;
        $tempatPkl = TempatPkl::with('usulanPkl')->get();


        $selectedUsulan = UsulanPkl::where('mahasiswa_id', $mahasiswaId)->pluck('tempat_id')->toArray();

        $usulanPkl = UsulanPkl::with('mahasiswa', 'perusahaan')
            ->where('mahasiswa_id', $mahasiswaId)
            ->get();

        return view('admin.usulan_pkl', compact('tempatPkl', 'selectedUsulan', 'usulanPkl'));
    }


    public function store(Request $request)
    {
        //dd($request->all());

        $validator = Validator::make($request->all(), [
            'mahasiswa_id' => 'required|exists:mahasiswa,id_mahasiswa',
            'tempat_id' => 'required|exists:tempat_pkl,id_tempat',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $existingUsulan = UsulanPkl::where('mahasiswa_id', $request->mahasiswa_id)
            ->where('tempat_id', $request->tempat_id)
            ->first();

        if ($existingUsulan) {
            return redirect()->back()->with('error', 'Tempat PKL sudah diusulkan sebelumnya!');
        }

        UsulanPkl::create([
            'mahasiswa_id' => $request->mahasiswa_id,
            'tempat_id' => $request->tempat_id,
        ]);

        return redirect()->route('usulan_pkl.index')->with('success', 'Tempat PKL berhasil diusulkan!');
    }
    public function destroy($id)
    {
        $usulanPkl = UsulanPkl::findOrFail($id);
        $usulanPkl->delete();

        return redirect()->route('usulan_pkl.index')->with('success', 'Usulan berhasil dihapus.');
    }

    public function indexprodi()
    {
        $usulanPkl = UsulanPkl::with(['mahasiswa', 'perusahaan'])->get(); // Assuming UsulanPkl model for usulan data
        $mhsPklData = MhsPkl::with(['mahasiswa', 'tempat', 'dosenpembimbing'])->get(); // Fetch MhsPkl data
        $dosenList = Dosen::all();

        return view('kaprodi.usulan_pkl', compact('usulanPkl', 'mhsPklData', 'dosenList'));
    }
    public function updateDospem(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'id_pkl' => 'required|exists:mhs_pkl,id_pkl',
            'dosen_pembimbing' => 'required|exists:dosen,id_dosen',
        ]);

        $mhsPkl = MhsPkl::findOrFail($request->id_pkl);
        $mhsPkl->dosen_pembimbing = $request->dosen_pembimbing;
        $mhsPkl->save();

        return redirect()->route('usulan_pkl.indexprodi')->with('success', 'Dosen Pembimbing berhasil ditambahkan.');
    }

    public function confirm(Request $request, $id)
    {
        $usulanPkl = UsulanPkl::findOrFail($id);

        $usulanPkl->konfirmasi = $usulanPkl->konfirmasi === '1' ? '0' : '1';
        $usulanPkl->save();

        if ($usulanPkl->konfirmasi === '1') {
            if (!$request->has('dosen_pembimbing') || empty($request->dosen_pembimbing)) {
                return redirect()->route('usulan_pkl.indexprodi')->with('error', 'Dosen Pembimbing harus dipilih.');
            }

            $existingMhsPkl = MhsPkl::where('mahasiswa_id', $usulanPkl->mahasiswa_id)
                ->where('tempat_id', $usulanPkl->tempat_id)
                ->first();

            if (!$existingMhsPkl) {
                MhsPkl::create([
                    'mahasiswa_id' => $usulanPkl->mahasiswa_id,
                    'tempat_id' => $usulanPkl->tempat_id,
                    'tahun_pkl' => now()->year,
                    'dosen_pembimbing' => $request->dosen_pembimbing,
                ]);
            }
        }

        return redirect()->route('usulan_pkl.indexprodi')->with('success', 'Usulan PKL berhasil dikonfirmasi.');
    }
}
