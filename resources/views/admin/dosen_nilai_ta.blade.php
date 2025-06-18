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
                        <li class="breadcrumb-item active" aria-current="page">Daftar Sidang TA</li>
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
                            <h4 class="card-title">Daftar Sidang TA </h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="dosenTablePembimbing" width="100%"
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
                                    @foreach ($nilaiSidang as $index => $mhsSidang)
                                        <?php
                                        //dd(optional(auth()->user()->dosen));
                                        $isPembimbingSatu = $mhsSidang->dosen_pembimbing1 && optional(auth()->user()->dosen)->id_dosen === (int) $mhsSidang->dosen_pembimbing1;

                                        $isPembimbingDua = $mhsSidang->dosen_pembimbing2 && optional(auth()->user()->dosen)->id_dosen === (int) $mhsSidang->dosen_pembimbing2;

                                        $isPenguji1 = $mhsSidang->penguji1_id && optional(auth()->user()->dosen)->id_dosen === (int) $mhsSidang->penguji1_id;

                                        $isPenguji2 = $mhsSidang->penguji2_id && optional(auth()->user()->dosen)->id_dosen === (int) $mhsSidang->penguji2_id;

                                        $isPenguji3 = $mhsSidang->penguji3_id && optional(auth()->user()->dosen)->id_dosen === (int) $mhsSidang->penguji3_id;

                                        ?>
                                        @if ($isPembimbingSatu || $isPembimbingDua || $isPenguji1 || $isPenguji2 || $isPenguji3)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $mhsSidang->mahasiswa->nama }}</td>
                                                <td>{{ $mhsSidang->tanggal_sidang }}</td>
                                                <td>{{ $mhsSidang->ruangan->nama_ruangan }}</td>
                                                <td>{{ $mhsSidang->sesi->sesi }}</td>
                                                <td>
                                                    @if ($isPembimbingSatu)
                                                        {{ optional($mhsSidang->nilaiPembimbing1)->nilai_sidang ?? '-' }}
                                                    @elseif ($isPembimbingDua)
                                                        {{ optional($mhsSidang->nilaiPembimbing2)->nilai_sidang ?? '-' }}
                                                    @elseif ($isPenguji1)
                                                        {{ optional($mhsSidang->nilaiPenguji1)->nilai_sidang ?? '-' }}
                                                    @elseif ($isPenguji2)
                                                        {{ optional($mhsSidang->nilaiPenguji2)->nilai_sidang ?? '-' }}
                                                    @else
                                                        {{ optional($mhsSidang->nilaiPenguji3)->nilai_sidang ?? '-' }}
                                                    @endif

                                                </td>
                                                <td>
                                                    @if (
                                                        ($isPembimbingSatu && $mhsSidang->nilaiSidangTaPembimbing1) ||
                                                            ($isPembimbingDua && $mhsSidang->nilaiSidangTaPembimbing2) ||
                                                            ($isPenguji1 && $mhsSidang->nilaiSidangTaPenguji1) ||
                                                            ($isPenguji2 && $mhsSidang->nilaiSidangTaPenguji2) ||
                                                            ($isPenguji3 && $mhsSidang->nilaiSidangTaPenguji3))
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $mhsSidang->id_ta }}">
                                                            <i class="bi bi-pencil-square"></i> Edit
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-warning"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#penilaianModal{{ $mhsSidang->id_ta }}">
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

                @foreach ($nilaiSidang as $mhsSidang)
                    <div class="modal fade" id="penilaianModal{{ $mhsSidang->id_ta }}" tabindex="-1"
                        aria-labelledby="penilaianModalLabel{{ $mhsSidang->id_ta }}" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="penilaianModalLabel{{ $mhsSidang->id_ta }}">Penilaian
                                        Sidang TA</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('nilai_ta.store', $mhsSidang->id_ta) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_ta" value="{{ $mhsSidang->id_ta }}">

                                        <div class="table-responsive mb-4">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Kriteria</th>
                                                        <th>Deskripsi</th>
                                                        <th>Nilai</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Sikap dan Penampilan</td>
                                                        <td>Kesesuaian sikap dan penampilan selama sidang</td>
                                                        <td>
                                                            <input type="number" class="form-control nilai-input"
                                                                name="sikap_penampilan" min="0" max="100"
                                                                required>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Komunikasi dan Sistematika</td>
                                                        <td>Kemampuan komunikasi dan sistematika penyampaian materi</td>
                                                        <td>
                                                            <input type="number" class="form-control nilai-input"
                                                                name="komunikasi_sistematika" min="0" max="100"
                                                                required>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Penguasaan Materi</td>
                                                        <td>Kedalaman dan penguasaan materi yang disampaikan</td>
                                                        <td>
                                                            <input type="number" class="form-control nilai-input"
                                                                name="penguasaan_materi" min="0" max="100"
                                                                required>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Identifikasi Masalah</td>
                                                        <td>Kemampuan mengidentifikasi masalah dengan jelas</td>
                                                        <td>
                                                            <input type="number" class="form-control nilai-input"
                                                                name="identifikasi_masalah" min="0" max="100"
                                                                required>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>Relevansi Teori</td>
                                                        <td>Kesesuaian teori yang digunakan dengan penelitian</td>
                                                        <td>
                                                            <input type="number" class="form-control nilai-input"
                                                                name="relevansi_teori" min="0" max="100"
                                                                required>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>6</td>
                                                        <td>Metode dan Algoritma</td>
                                                        <td>Kesesuaian metode dan algoritma yang digunakan</td>
                                                        <td>
                                                            <input type="number" class="form-control nilai-input"
                                                                name="metode_algoritma" min="0" max="100"
                                                                required>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>7</td>
                                                        <td>Hasil dan Pembahasan</td>
                                                        <td>Kualitas hasil penelitian dan pembahasan</td>
                                                        <td>
                                                            <input type="number" class="form-control nilai-input"
                                                                name="hasil_pembahasan" min="0" max="100"
                                                                required>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>8</td>
                                                        <td>Kesimpulan dan Saran</td>
                                                        <td>Kualitas kesimpulan dan saran yang diberikan</td>
                                                        <td>
                                                            <input type="number" class="form-control nilai-input"
                                                                name="kesimpulan_saran" min="0" max="100"
                                                                required>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>9</td>
                                                        <td>Bahasa dan Tata Tulis</td>
                                                        <td>Kesesuaian bahasa dan tata tulis yang digunakan</td>
                                                        <td>
                                                            <input type="number" class="form-control nilai-input"
                                                                name="bahasa_tata_tulis" min="0" max="100"
                                                                required>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>10</td>
                                                        <td>Kesesuaian Fungsional</td>
                                                        <td>Kesesuaian fungsional penelitian dengan tujuan awal</td>
                                                        <td>
                                                            <input type="number" class="form-control nilai-input"
                                                                name="kesesuaian_fungsional" min="0"
                                                                max="100" required>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>11</td>
                                                        <td>Formalitas</td>
                                                        <td>Kesesuaian fungsional penelitian dengan tujuan awal</td>
                                                        <td>
                                                            <input type="number" class="form-control nilai-input"
                                                                name="formalitas" min="0"
                                                                max="100" required>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" class="text-end"><strong>Total Nilai</strong>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                name="nilai_sidang" readonly>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan Nilai</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const modals = document.querySelectorAll('.modal');

                        modals.forEach(modal => {
                            const inputs = modal.querySelectorAll('.nilai-input');
                            const totalInput = modal.querySelector('input[name="nilai_sidang_ta"]');

                            inputs.forEach(input => {
                                input.addEventListener('input', () => {
                                    let total = 0;
                                    inputs.forEach(input => {
                                        total += parseFloat(input.value) || 0;
                                    });
                                    totalInput.value = (total / 5).toFixed(2);
                                });
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>
@endsection
