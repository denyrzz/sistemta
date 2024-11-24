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
                            <h4 class="card-title">Daftar Sidang PKL</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="dosenTable" width="100%"
                                cellspacing="0">
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
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $mhsPkl->mahasiswa->nama }}</td>
                                            <td>{{ $mhsPkl->tanggal_sidang }}</td>
                                            <td>{{ $mhsPkl->ruangan->nama_ruangan }}</td>
                                            <td>{{ $mhsPkl->sesi->sesi }}</td>
                                            <td>
                                                @if (auth()->user()->dosen->id_dosen == $mhsPkl->dosen_pembimbing && $mhsPkl->nilaiPembimbing)
                                                    {{ $mhsPkl->nilaiPembimbing->nilai_sidang ?? '-' }}
                                                @elseif (auth()->user()->dosen->id_dosen == $mhsPkl->dosen_penguji && $mhsPkl->nilaiPenguji)
                                                    {{ $mhsPkl->nilaiPenguji->nilai_sidang ?? '-' }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if (
                                                    ($mhsPkl->nilaiPembimbing && auth()->user()->dosen->id_dosen == $mhsPkl->dosen_pembimbing) ||
                                                        ($mhsPkl->nilaiPenguji && auth()->user()->dosen->id_dosen == $mhsPkl->dosen_penguji))
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $mhsPkl->id_pkl }}">
                                                        <i class="bi bi-pencil-square"></i> Edit
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-warning"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#penilaianModal{{ $mhsPkl->id_pkl }}">
                                                        <i class="bi bi-pencil-square"></i> Penilaian
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>

                                        <!-- Penilaian Modal -->
                                        <div class="modal fade" id="penilaianModal{{ $mhsPkl->id_pkl }}" tabindex="-1"
                                            aria-labelledby="penilaianModalLabel{{ $mhsPkl->id_pkl }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Penilaian Sidang PKL</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('nilai_sidang_pkl.store', $mhsPkl->id_pkl) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="bahasa{{ $mhsPkl->id_pkl }}">Bahasa
                                                                    (15%)
                                                                </label>
                                                                <input type="number" step="0.01" class="form-control"
                                                                    name="bahasa" id="bahasa{{ $mhsPkl->id_pkl }}"
                                                                    value="{{ old('bahasa') }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="analisis{{ $mhsPkl->id_pkl }}">Analisis
                                                                    (20%)</label>
                                                                <input type="number" step="0.01" class="form-control"
                                                                    name="analisis" id="analisis{{ $mhsPkl->id_pkl }}"
                                                                    value="{{ old('analisis') }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="sikap{{ $mhsPkl->id_pkl }}">Sikap (10%)</label>
                                                                <input type="number" step="0.01" class="form-control"
                                                                    name="sikap" id="sikap{{ $mhsPkl->id_pkl }}"
                                                                    value="{{ old('sikap') }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="komunikasi{{ $mhsPkl->id_pkl }}">Komunikasi
                                                                    (15%)</label>
                                                                <input type="number" step="0.01" class="form-control"
                                                                    name="komunikasi" id="komunikasi{{ $mhsPkl->id_pkl }}"
                                                                    value="{{ old('komunikasi') }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="penyajian{{ $mhsPkl->id_pkl }}">Penyajian
                                                                    (20%)</label>
                                                                <input type="number" step="0.01" class="form-control"
                                                                    name="penyajian" id="penyajian{{ $mhsPkl->id_pkl }}"
                                                                    value="{{ old('penyajian') }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="penguasaan{{ $mhsPkl->id_pkl }}">Penguasaan
                                                                    Materi (20%)</label>
                                                                <input type="number" step="0.01" class="form-control"
                                                                    name="penguasaan" id="penguasaan{{ $mhsPkl->id_pkl }}"
                                                                    value="{{ old('penguasaan') }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nilai_sidang{{ $mhsPkl->id_pkl }}">Nilai Total
                                                                    Sidang</label>
                                                                <input type="number" step="0.01" class="form-control"
                                                                    name="nilai_sidang"
                                                                    id="nilai_sidang{{ $mhsPkl->id_pkl }}" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editModal{{ $mhsPkl->id_pkl }}" tabindex="-1"
                                            aria-labelledby="editModalLabel{{ $mhsPkl->id_pkl }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Nilai Sidang PKL</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('nilai_sidang_pkl.update', $mhsPkl->id_pkl) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="bahasa{{ $mhsPkl->id_pkl }}">Bahasa</label>
                                                                <input type="number" step="0.01" class="form-control"
                                                                    name="bahasa" id="bahasa{{ $mhsPkl->id_pkl }}"
                                                                    value="{{ old('bahasa', $mhsPkl->nilaiPembimbing->bahasa ?? '') }}"
                                                                    required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label
                                                                    for="analisis{{ $mhsPkl->id_pkl }}">Analisis</label>
                                                                <input type="number" step="0.01" class="form-control"
                                                                    name="analisis" id="analisis{{ $mhsPkl->id_pkl }}"
                                                                    value="{{ old('analisis', $mhsPkl->nilaiPembimbing->analisis ?? '') }}"
                                                                    required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="sikap{{ $mhsPkl->id_pkl }}">Sikap</label>
                                                                <input type="number" step="0.01" class="form-control"
                                                                    name="sikap" id="sikap{{ $mhsPkl->id_pkl }}"
                                                                    value="{{ old('sikap', $mhsPkl->nilaiPembimbing->sikap ?? '') }}"
                                                                    required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label
                                                                    for="komunikasi{{ $mhsPkl->id_pkl }}">Komunikasi</label>
                                                                <input type="number" step="0.01" class="form-control"
                                                                    name="komunikasi"
                                                                    id="komunikasi{{ $mhsPkl->id_pkl }}"
                                                                    value="{{ old('komunikasi', $mhsPkl->nilaiPembimbing->komunikasi ?? '') }}"
                                                                    required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label
                                                                    for="penyajian{{ $mhsPkl->id_pkl }}">Penyajian</label>
                                                                <input type="number" step="0.01" class="form-control"
                                                                    name="penyajian" id="penyajian{{ $mhsPkl->id_pkl }}"
                                                                    value="{{ old('penyajian', $mhsPkl->nilaiPembimbing->penyajian ?? '') }}"
                                                                    required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="penguasaan{{ $mhsPkl->id_pkl }}">Penguasaan
                                                                    Materi</label>
                                                                <input type="number" step="0.01" class="form-control"
                                                                    name="penguasaan"
                                                                    id="penguasaan{{ $mhsPkl->id_pkl }}"
                                                                    value="{{ old('penguasaan', $mhsPkl->nilaiPembimbing->penguasaan ?? '') }}"
                                                                    required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nilai_sidang{{ $mhsPkl->id_pkl }}">Nilai Total
                                                                    Sidang</label>
                                                                <input type="number" step="0.01" class="form-control"
                                                                    name="nilai_sidang"
                                                                    id="nilai_sidang{{ $mhsPkl->id_pkl }}"
                                                                    value="{{ old('nilai_sidang', $mhsPkl->nilaiPembimbing->nilai_sidang ?? '') }}"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
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
