@extends('layouts.admin.template')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
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
                            <h4 class="card-title">Daftar Dosen Pembimbing PKL</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="dosenTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Mahasiswa PKL</th>
                                        <th>Tahun PKL</th>
                                        <th>Nilai Bimbingan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dosen->mhsPkl as $index => $mhsPkl)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $mhsPkl->mahasiswa->nama }}</td>
                                            <td>{{ $mhsPkl->tempat->nama_perusahaan }}</td>
                                            <td>{{ $mhsPkl->tahun_pkl }}</td>
                                            <td>{{ $mhsPkl->nilaiBimbingan->nilai_bimbingan }}</td>
                                            <td>
                                                <a href="{{ route('dosen.pembimbing.showLogbook', $mhsPkl->id_pkl) }}"
                                                    class="btn btn-primary btn-sm">Show Logbook</a>
                                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#penilaianModal{{ $mhsPkl->id_pkl }}">
                                                    <i class="bi bi-pencil-square"></i> Penilaian
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Penilaian Modal -->
                                        <div class="modal fade" id="penilaianModal{{ $mhsPkl->id_pkl }}" tabindex="-1"
                                            aria-labelledby="penilaianModalLabel{{ $mhsPkl->id_pkl }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="penilaianModalLabel{{ $mhsPkl->id_pkl }}">
                                                            Penilaian Bimbingan Mahasiswa
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form
                                                        action="{{ route('dosen.pembimbing.updatePenilaian', $mhsPkl->id_pkl) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="keaktifan_bimbingan{{ $mhsPkl->id_pkl }}">Keaktifan Bimbingan (30%)</label>
                                                                <input type="number" step="0.01" class="form-control"
                                                                    name="keaktifan_bimbingan"
                                                                    id="keaktifan_bimbingan{{ $mhsPkl->id_pkl }}"
                                                                    value="{{ old('keaktifan_bimbingan', $mhsPkl->nilaiBimbingan->keaktifan ?? '') }}"
                                                                    required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="komunikatif{{ $mhsPkl->id_pkl }}">Komunikatif (30%)</label>
                                                                <input type="number" step="0.01" class="form-control"
                                                                    name="komunikatif"
                                                                    id="komunikatif{{ $mhsPkl->id_pkl }}"
                                                                    value="{{ old('komunikatif', $mhsPkl->nilaiBimbingan->komunikatif ?? '') }}"
                                                                    required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="problem_solving{{ $mhsPkl->id_pkl }}">Problem Solving (40%)</label>
                                                                <input type="number" step="0.01" class="form-control"
                                                                    name="problem_solving"
                                                                    id="problem_solving{{ $mhsPkl->id_pkl }}"
                                                                    value="{{ old('problem_solving', $mhsPkl->nilaiBimbingan->problem_solving ?? '') }}"
                                                                    required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nilai_perkiraan{{ $mhsPkl->id_pkl }}">Nilai Perkiraan</label>
                                                                <input type="number" step="0.01" class="form-control"
                                                                    name="nilai_perkiraan"
                                                                    id="nilai_perkiraan{{ $mhsPkl->id_pkl }}"
                                                                    value="{{ old('nilai_perkiraan', $mhsPkl->nilaiBimbingan->nilai_bimbingan ?? '') }}"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Simpan Penilaian</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($dosen->mhsPkl as $mhsPkl)
                const keaktifanInput{{ $mhsPkl->id_pkl }} = document.getElementById('keaktifan_bimbingan{{ $mhsPkl->id_pkl }}');
                const komunikatifInput{{ $mhsPkl->id_pkl }} = document.getElementById('komunikatif{{ $mhsPkl->id_pkl }}');
                const problemSolvingInput{{ $mhsPkl->id_pkl }} = document.getElementById('problem_solving{{ $mhsPkl->id_pkl }}');
                const nilaiPerkiraanInput{{ $mhsPkl->id_pkl }} = document.getElementById('nilai_perkiraan{{ $mhsPkl->id_pkl }}');

                const calculateNilaiPerkiraan = () => {
                    const keaktifan = parseFloat(keaktifanInput{{ $mhsPkl->id_pkl }}.value) || 0;
                    const komunikatif = parseFloat(komunikatifInput{{ $mhsPkl->id_pkl }}.value) || 0;
                    const problemSolving = parseFloat(problemSolvingInput{{ $mhsPkl->id_pkl }}.value) || 0;

                    const nilaiPerkiraan = (keaktifan * 0.3) + (komunikatif * 0.3) + (problemSolving * 0.4);
                    nilaiPerkiraanInput{{ $mhsPkl->id_pkl }}.value = nilaiPerkiraan.toFixed(2);
                };

                keaktifanInput{{ $mhsPkl->id_pkl }}.addEventListener('input', calculateNilaiPerkiraan);
                komunikatifInput{{ $mhsPkl->id_pkl }}.addEventListener('input', calculateNilaiPerkiraan);
                problemSolvingInput{{ $mhsPkl->id_pkl }}.addEventListener('input', calculateNilaiPerkiraan);

                // Initialize calculation
                calculateNilaiPerkiraan();
            @endforeach
        });
    </script>
@endsection
