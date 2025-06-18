@extends('layouts.admin.template')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 d-flex align-items-center">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/dashboard') }}" class="link">
                                <i class="mdi mdi-home-outline fs-4"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Dosen PKL</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="card-title">Daftar Sidang PKL (Pembimbing)</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="dosenTablePembimbing" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Tanggal</th>
                                        <th>Ruangan</th>
                                        <th>Sesi</th>
                                        <th>Nilai Sidang</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nilaiPkl as $index => $mhsPkl)
                                        @if ($mhsPkl->dosen_pembimbing && auth()->user()->dosen->id_dosen == $mhsPkl->dosen_pembimbing)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $mhsPkl->mahasiswa->nama }}</td>
                                                <td>{{ $mhsPkl->tanggal_sidang }}</td>
                                                <td>{{ $mhsPkl->ruangan->nama_ruangan }}</td>
                                                <td>{{ $mhsPkl->sesi->sesi ? $mhsPkl->sesi->jam : '-' }}</td>
                                                <td>
                                                    {{ $mhsPkl->nilaiPembimbing->nilai_sidang ?? '-' }}
                                                </td>
                                                <td>
                                                    @if ($mhsPkl->nilaiPembimbing)
                                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $mhsPkl->id_pkl }}">
                                                            <i class="bi bi-pencil-square"></i> Edit
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#penilaianModal{{ $mhsPkl->id_pkl }}">
                                                            <i class="bi bi-pencil-square"></i> Penilaian
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Second Table for Penguji (Examiner) -->
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="card-title">Daftar Sidang PKL (Penguji)</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="dosenTablePenguji" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Tanggal</th>
                                        <th>Ruangan</th>
                                        <th>Sesi</th>
                                        <th>Nilai Sidang</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nilaiPkl as $index => $mhsPkl)
                                        @if ($mhsPkl->dosen_penguji && auth()->user()->dosen->id_dosen == $mhsPkl->dosen_penguji)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $mhsPkl->mahasiswa->nama }}</td>
                                                <td>{{ $mhsPkl->tanggal_sidang }}</td>
                                                <td>{{ $mhsPkl->ruangan->nama_ruangan }}</td>
                                                <td>{{ $mhsPkl->sesi->sesi }}</td>
                                                <td>
                                                    {{ $mhsPkl->nilaiPenguji->nilai_sidang ?? '-' }}
                                                </td>
                                                <td>
                                                    @if ($mhsPkl->nilaiPenguji)
                                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $mhsPkl->id_pkl }}">
                                                            <i class="bi bi-pencil-square"></i> Edit
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#penilaianModal{{ $mhsPkl->id_pkl }}">
                                                            <i class="bi bi-pencil-square"></i> Penilaian
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add your modal content here as before (same modals for penilaian and edit, just make sure IDs are unique) -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($dosen->mhsPkl as $mhsPkl)
                const inputs = [
                    document.getElementById('bahasa{{ $mhsPkl->id_pkl }}'),
                    document.getElementById('analisis{{ $mhsPkl->id_pkl }}'),
                    document.getElementById('sikap{{ $mhsPkl->id_pkl }}'),
                    document.getElementById('komunikasi{{ $mhsPkl->id_pkl }}'),
                    document.getElementById('penyajian{{ $mhsPkl->id_pkl }}'),
                    document.getElementById('penguasaan{{ $mhsPkl->id_pkl }}')
                ];

                const totalInput = document.getElementById('nilai_sidang{{ $mhsPkl->id_pkl }}');

                const calculateTotal = () => {
                    const weights = [0.15, 0.20, 0.10, 0.15, 0.20, 0.20];
                    const total = inputs.reduce((sum, input, index) => {
                        return sum + (parseFloat(input.value) || 0) * weights[index];
                    }, 0);
                    totalInput.value = total.toFixed(2);
                };

                inputs.forEach(input => input.addEventListener('input', calculateTotal));

                // Initialize calculation
                calculateTotal();
            @endforeach
        });
    </script>

@endsection
