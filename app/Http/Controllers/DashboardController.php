<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\PKL;
use App\Models\Sempro;
use App\Models\Activity;
use App\Models\MhsPkl;
use App\Models\MhsSempro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('super_admin')) {
            return $this->superAdminDashboard();
        }

        if ($user->hasAnyRole('admin')) {
            return $this->adminDashboard();
        }

        if ($user->hasAnyRole(['pembimbing', 'penguji', 'dosen', 'kaprodi'])) {
            return $this->dosenDashboard();
        }

        if ($user->hasAnyRole('mahasiswa')) {
            return $this->mahasiswaDashboard();
        }
    }

    private function superAdminDashboard()
    {
        // Get total counts for various entities
        $totalMahasiswa = Mahasiswa::count();
        $totalDosen = User::whereHas('roles', function($query) {
            $query->whereIn('name', ['pembimbing', 'penguji', 'dosen', 'kaprodi']);
        })->count();
        $totalAdmin = User::whereHas('roles', function($query) {
            $query->where('name', 'admin');
        })->count();

        // System-wide statistics
        $totalPKL = MhsPkl::count();
        $pklVerified = MhsPkl::where('verif_berkas', '1')->count();
        $pklPending = MhsPkl::where('verif_berkas', '0')->count();
        $pklCompleted = MhsPkl::whereNotNull('nilai_mahasiswa')->count();

        $totalSempro = MhsSempro::count();
        $semproVerified = MhsSempro::where('verif_berkas', '1')->count();
        $semproPending = MhsSempro::where('verif_berkas', '0')->count();
        $completedSempro = MhsSempro::whereNotNull('nilai_mahasiswa')->count();

        // // Get latest system activities
        // $recentActivities = Activity::with(['user', 'mahasiswa'])
        //     ->orderBy('id', 'desc')
        //     ->take(15)
        //     ->get();

        // // Statistics by study program (assuming there's a program_studi field)
        // $pklByProgram = MhsPkl::join('mahasiswa', 'mhs_pkl.mahasiswa_id', '=', 'mahasiswa.id')
        //     ->selectRaw('mahasiswa.program_studi, COUNT(*) as total')
        //     ->groupBy('mahasiswa.program_studi')
        //     ->get();

        // $semproByProgram = MhsSempro::join('mahasiswa', 'mhs_sempro.mahasiswa_id', '=', 'mahasiswa.id')
        //     ->selectRaw('mahasiswa.program_studi, COUNT(*) as total')
        //     ->groupBy('mahasiswa.program_studi')
        //     ->get();

        return view('dashboard', compact(
            'totalMahasiswa',
            'totalDosen',
            'totalAdmin',
            'totalPKL',
            'pklVerified',
            'pklPending',
            'pklCompleted',
            'totalSempro',
            'semproVerified',
            'semproPending',
            'completedSempro',
            // 'recentActivities',
            // 'pklByProgram',
            // 'semproByProgram'
        ));
    }

    private function adminDashboard()
    {
        // Get departmental counts
        $totalMahasiswa = Mahasiswa::count();
        $totalDosen = User::whereHas('roles', function($query) {
            $query->whereIn('name', ['pembimbing', 'penguji', 'dosen', 'kaprodi']);
        })->count();

        // Departmental PKL Statistics
        $totalPKL = MhsPkl::count();
        $pklVerified = MhsPkl::where('verif_berkas', '1')->count();
        $pklPending = MhsPkl::where('verif_berkas', '0')->count();
        $pklInProgress = MhsPkl::where('verif_berkas', '1')
            ->whereNull('nilai_mahasiswa')
            ->count();
        $pklCompleted = MhsPkl::whereNotNull('nilai_mahasiswa')->count();

        // Departmental Sempro Statistics
        $totalSempro = MhsSempro::count();
        $semproVerified = MhsSempro::where('verif_berkas', '1')->count();
        $semproPending = MhsSempro::where('verif_berkas', '0')->count();
        $completedSempro = MhsSempro::whereNotNull('nilai_mahasiswa')->count();
        $semproInProgress = MhsSempro::where('verif_berkas', '1')
            ->whereNull('nilai_mahasiswa')
            ->count();

        // // Recent activities
        // $recentActivities = Activity::with(['user', 'mahasiswa'])
        //     ->orderBy('id', 'desc')
        //     ->take(10)
        //     ->get();

        // Pending approvals
        $pendingPKL = MhsPkl::where('verif_berkas', '0')
            ->with('mahasiswa')
            ->get();

        $pendingSempro = MhsSempro::where('verif_berkas', '0')
            ->with('mahasiswa')
            ->get();

        return view('dashboard', compact(
            'totalMahasiswa',
            'totalDosen',
            'totalPKL',
            'pklVerified',
            'pklPending',
            'pklInProgress',
            'pklCompleted',
            'totalSempro',
            'semproVerified',
            'semproPending',
            'semproInProgress',
            'completedSempro',
            //'recentActivities',
            'pendingPKL',
            'pendingSempro'
        ));
    }

    private function dosenDashboard()
    {
        $mahasiswaPklIds = MhsPkl::where(function ($query) {
            $query->where('dosen_pembimbing', Auth::id())
                ->orWhere('dosen_penguji', Auth::id());
        })
            ->pluck('mahasiswa_id');

        $mahasiswaSemproIds = MhsSempro::where(function ($query) {
            $query->where('pembimbing_satu', Auth::id())
                ->orWhere('pembimbing_dua', Auth::id())
                ->orWhere('penguji', Auth::id());
        })
            ->pluck('mahasiswa_id');

        $allMahasiswaIds = $mahasiswaPklIds->merge($mahasiswaSemproIds)->unique();

        $totalMahasiswa = $allMahasiswaIds->count();

        $totalPKL = MhsPkl::whereIn('mahasiswa_id', $mahasiswaPklIds)
            ->where('verif_berkas', '1')
            ->count();

        $totalSempro = MhsSempro::whereIn('mahasiswa_id', $mahasiswaSemproIds)
            ->where('verif_berkas', '1')
            ->count();

        $sudahSempro = MhsSempro::whereIn('mahasiswa_id', $mahasiswaSemproIds)
            ->whereNotNull('nilai_mahasiswa')
            ->count();

        $pklStats = [$totalPKL, 0, 0, 0, 0, 0];
        $semproStats = [$totalSempro + $sudahSempro, 0, 0, 0, 0, 0];

        return view('dashboard', compact(
            'totalMahasiswa',
            'totalPKL',
            'totalSempro',
            'sudahSempro',
            'pklStats',
            'semproStats'
        ));
    }

    private function mahasiswaDashboard()
    {
        $mahasiswa = Mahasiswa::with(['mhs_pkl', 'sempro'])->where('user_id', Auth::id())->firstOrFail();

        $statusPKL = optional($mahasiswa->mhs_pkl)->verif_berkas === '1';
        $periodePKL = optional($mahasiswa->mhs_pkl)->tahun_pkl;

        $statusSempro = optional($mahasiswa->sempro)->status === '1';
        $tanggalSempro = optional($mahasiswa->sempro)->tanggal_sempro;

        $progressTimeline = collect([
            [
                'title' => 'Pendaftaran PKL',
                'description' => 'Pengajuan dan persetujuan PKL',
                'status' => $statusPKL,
                'icon' => 'fa-briefcase',
                'date' => $periodePKL ?? '-',
            ],
            [
                'title' => 'Pelaksanaan PKL',
                'description' => 'Periode pelaksanaan PKL',
                'status' => $statusPKL,
                'icon' => 'fa-clock',
                'date' => $periodePKL ?? '-',
            ],
            [
                'title' => 'Pengajuan Sempro',
                'description' => 'Pengajuan seminar proposal',
                'status' => !empty($mahasiswa->sempro),
                'icon' => 'fa-file-alt',
                'date' => $tanggalSempro ?? '-',
            ],
            [
                'title' => 'Pelaksanaan Sempro',
                'description' => 'Seminar proposal',
                'status' => $statusSempro,
                'icon' => 'fa-presentation',
                'date' => $tanggalSempro ? date('d M Y', strtotime($tanggalSempro)) : '-',
            ],
        ]);

        return view('dashboard', compact(
            'statusPKL',
            'periodePKL',
            'statusSempro',
            'tanggalSempro',
            'progressTimeline'
        ));
    }
}
