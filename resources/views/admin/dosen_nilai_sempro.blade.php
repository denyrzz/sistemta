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
                        <li class="breadcrumb-item active" aria-current="page">Daftar Sempro</li>
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
                            <h4 class="card-title">Daftar Sempro - Pembimbing</h4>
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
                                    @foreach ($nilaiSempro as $index => $mhsSempro)
                                        @php
                                            $isPembimbingSatu =
                                                $mhsSempro->pembimbing_satu &&
                                                auth()->user()->dosen->id_dosen == $mhsSempro->pembimbing_satu;
                                            $isPembimbingDua =
                                                $mhsSempro->pembimbing_dua &&
                                                auth()->user()->dosen->id_dosen == $mhsSempro->pembimbing_dua;
                                        @endphp
                                        @if ($isPembimbingSatu || $isPembimbingDua)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $mhsSempro->mahasiswa->nama }}</td>
                                                <td>{{ $mhsSempro->tanggal_sempro }}</td>
                                                <td>{{ $mhsSempro->ruangan->nama_ruangan }}</td>
                                                <td>{{ $mhsSempro->sesi->sesi }}</td>
                                                <td>
                                                    @if ($isPembimbingSatu)
                                                        {{ optional($mhsSempro->nilaiPembimbing1)->nilai_sempro ?? '-' }}
                                                    @else
                                                        {{ optional($mhsSempro->nilaiPembimbing2)->nilai_sempro ?? '-' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (($isPembimbingSatu && $mhsSempro->nilaiPembimbing1) || ($isPembimbingDua && $mhsSempro->nilaiPembimbing2))
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $mhsSempro->id_sempro }}">
                                                            <i class="bi bi-pencil-square"></i> Edit
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-warning"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#penilaianModal{{ $mhsSempro->id_sempro }}">
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

                <div class="card mt-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="card-title">Daftar Sempro - Penguji</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="dosenTablePenguji" width="100%"
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
                                    @foreach ($nilaiSempro as $index => $mhsSempro)
                                        @if ($mhsSempro->penguji && auth()->user()->dosen->id_dosen == $mhsSempro->penguji)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $mhsSempro->mahasiswa->nama }}</td>
                                                <td>{{ $mhsSempro->tanggal_sempro }}</td>
                                                <td>{{ $mhsSempro->ruangan->nama_ruangan }} - {{ $mhsSempro->ruangan->no_ruangan }}</td>
                                                <td>{{ $mhsSempro->sesi->sesi }} - {{ $mhsSempro->sesi->jam }}</td>
                                                <td>
                                                    {{ $mhsSempro->nilaiPenguji->nilai_sempro ?? '-' }}
                                                </td>
                                                <td>
                                                    @if ($mhsSempro->nilaiPenguji)
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $mhsSempro->id_sempro }}">
                                                            <i class="bi bi-pencil-square"></i> Edit
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-warning"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#penilaianModal{{ $mhsSempro->id_sempro }}">
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

    @foreach ($nilaiSempro as $mhsSempro)
        @php
            $isPembimbingSatu =
                $mhsSempro->pembimbing_satu && auth()->user()->dosen->id_dosen == $mhsSempro->pembimbing_satu;
            $isPembimbingDua =
                $mhsSempro->pembimbing_dua && auth()->user()->dosen->id_dosen == $mhsSempro->pembimbing_dua;
        @endphp
        <!-- Penilaian Modal -->
        <div class="modal fade" id="penilaianModal{{ $mhsSempro->id_sempro }}" tabindex="-1"
            aria-labelledby="penilaianModalLabel{{ $mhsSempro->id_sempro }}" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="penilaianModalLabel{{ $mhsSempro->id_sempro }}">Penilaian Sidang Sempro
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('nilai_sempro.store', $mhsSempro->id_sempro) }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_sempro" value="{{ $mhsSempro->id_sempro }}">

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
                                            <td>Pendahuluan</td>
                                            <td>Mahasiswa mampu menjelaskan latar belakang, tujuan, dan kontribusi
                                                penelitian</td>
                                            <td>
                                                <input type="number" class="form-control"
                                                    id="pendahuluan{{ $mhsSempro->id_sempro }}" name="pendahuluan"
                                                    min="0" max="100" required
                                                    value="{{ $isPembimbingSatu
                                                        ? optional($mhsSempro->nilaiPembimbing1)->pendahuluan ?? ''
                                                        : ($isPembimbingDua
                                                            ? optional($mhsSempro->nilaiPembimbing2)->pendahuluan ?? ''
                                                            : optional($mhsSempro->nilaiPenguji)->pendahuluan ?? '') }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Tinjauan Pustaka</td>
                                            <td>Mahasiswa mampu menyajikan tinjauan pustaka yang relevan dan mendukung
                                                penelitian</td>
                                            <td>
                                                <input type="number" class="form-control"
                                                    id="tinjauan_pustaka{{ $mhsSempro->id_sempro }}"
                                                    name="tinjauan_pustaka" min="0" max="100" required
                                                    value="{{ $isPembimbingSatu
                                                        ? optional($mhsSempro->nilaiPembimbing1)->tinjauan_pustaka ?? ''
                                                        : ($isPembimbingDua
                                                            ? optional($mhsSempro->nilaiPembimbing2)->tinjauan_pustaka ?? ''
                                                            : optional($mhsSempro->nilaiPenguji)->tinjauan_pustaka ?? '') }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Metodologi</td>
                                            <td>Mahasiswa mampu menjelaskan metodologi penelitian secara sistematis dan
                                                terperinci</td>
                                            <td>
                                                <input type="number" class="form-control"
                                                    id="metodologi{{ $mhsSempro->id_sempro }}" name="metodologi"
                                                    min="0" max="100" required
                                                    value="{{ $isPembimbingSatu
                                                        ? optional($mhsSempro->nilaiPembimbing1)->metodologi ?? ''
                                                        : ($isPembimbingDua
                                                            ? optional($mhsSempro->nilaiPembimbing2)->metodologi ?? ''
                                                            : optional($mhsSempro->nilaiPenguji)->metodologi ?? '') }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Penggunaan Bahasa</td>
                                            <td>Mahasiswa mampu menggunakan bahasa yang baik dan benar dalam presentasi dan
                                                dokumen</td>
                                            <td>
                                                <input type="number" class="form-control"
                                                    id="penggunaan_bahasa{{ $mhsSempro->id_sempro }}"
                                                    name="penggunaan_bahasa" min="0" max="100" required
                                                    value="{{ $isPembimbingSatu
                                                        ? optional($mhsSempro->nilaiPembimbing1)->penggunaan_bahasa ?? ''
                                                        : ($isPembimbingDua
                                                            ? optional($mhsSempro->nilaiPembimbing2)->penggunaan_bahasa ?? ''
                                                            : optional($mhsSempro->nilaiPenguji)->penggunaan_bahasa ?? '') }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Presentasi</td>
                                            <td>Mahasiswa mampu menyampaikan presentasi dengan jelas, terstruktur, dan
                                                menarik</td>
                                            <td>
                                                <input type="number" class="form-control"
                                                    id="presentasi{{ $mhsSempro->id_sempro }}" name="presentasi"
                                                    min="0" max="100" required
                                                    value="{{ $isPembimbingSatu
                                                        ? optional($mhsSempro->nilaiPembimbing1)->presentasi ?? ''
                                                        : ($isPembimbingDua
                                                            ? optional($mhsSempro->nilaiPembimbing2)->presentasi ?? ''
                                                            : optional($mhsSempro->nilaiPenguji)->presentasi ?? '') }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>Total Nilai</strong></td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    id="nilai_sempro{{ $mhsSempro->id_sempro }}" name="nilai_sempro"
                                                    readonly
                                                    value="{{ $isPembimbingSatu
                                                        ? optional($mhsSempro->nilaiPembimbing1)->nilai_sempro ?? ''
                                                        : ($isPembimbingDua
                                                            ? optional($mhsSempro->nilaiPembimbing2)->nilai_sempro ?? ''
                                                            : optional($mhsSempro->nilaiPenguji)->nilai_sempro ?? '') }}">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan Penilaian</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal{{ $mhsSempro->id_sempro }}" tabindex="-1"
            aria-labelledby="editModalLabel{{ $mhsSempro->id_sempro }}" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $mhsSempro->id_sempro }}">Edit Penilaian Sempro</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('nilai_sempro.update', $mhsSempro->id_sempro) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id_sempro" value="{{ $mhsSempro->id_sempro }}">

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
                                            <td>Pendahuluan</td>
                                            <td>Mahasiswa mampu menjelaskan latar belakang, tujuan, dan kontribusi
                                                penelitian</td>
                                            <td>
                                                <input type="number" class="form-control"
                                                    id="pendahuluanEdit{{ $mhsSempro->id_sempro }}" name="pendahuluan"
                                                    min="0" max="100" required
                                                    value="{{ $isPembimbingSatu
                                                        ? optional($mhsSempro->nilaiPembimbing1)->pendahuluan ?? ''
                                                        : ($isPembimbingDua
                                                            ? optional($mhsSempro->nilaiPembimbing2)->pendahuluan ?? ''
                                                            : optional($mhsSempro->nilaiPenguji)->pendahuluan ?? '') }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Tinjauan Pustaka</td>
                                            <td>Mahasiswa mampu menyajikan tinjauan pustaka yang relevan dan mendukung
                                                penelitian</td>
                                            <td>
                                                <input type="number" class="form-control"
                                                    id="tinjauan_pustakaEdit{{ $mhsSempro->id_sempro }}"
                                                    name="tinjauan_pustaka" min="0" max="100" required
                                                    value="{{ $isPembimbingSatu
                                                        ? optional($mhsSempro->nilaiPembimbing1)->tinjauan_pustaka ?? ''
                                                        : ($isPembimbingDua
                                                            ? optional($mhsSempro->nilaiPembimbing2)->tinjauan_pustaka ?? ''
                                                            : optional($mhsSempro->nilaiPenguji)->tinjauan_pustaka ?? '') }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Metodologi</td>
                                            <td>Mahasiswa mampu menjelaskan metodologi penelitian secara sistematis dan
                                                terperinci</td>
                                            <td>
                                                <input type="number" class="form-control"
                                                    id="metodologiEdit{{ $mhsSempro->id_sempro }}" name="metodologi"
                                                    min="0" max="100" required
                                                    value="{{ $isPembimbingSatu
                                                        ? optional($mhsSempro->nilaiPembimbing1)->metodologi ?? ''
                                                        : ($isPembimbingDua
                                                            ? optional($mhsSempro->nilaiPembimbing2)->metodologi ?? ''
                                                            : optional($mhsSempro->nilaiPenguji)->metodologi ?? '') }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Penggunaan Bahasa</td>
                                            <td>Mahasiswa mampu menggunakan bahasa yang baik dan benar dalam presentasi dan
                                                dokumen</td>
                                            <td>
                                                <input type="number" class="form-control"
                                                    id="penggunaan_bahasaEdit{{ $mhsSempro->id_sempro }}"
                                                    name="penggunaan_bahasa" min="0" max="100" required
                                                    value="{{ $isPembimbingSatu
                                                        ? optional($mhsSempro->nilaiPembimbing1)->penggunaan_bahasa ?? ''
                                                        : ($isPembimbingDua
                                                            ? optional($mhsSempro->nilaiPembimbing2)->penggunaan_bahasa ?? ''
                                                            : optional($mhsSempro->nilaiPenguji)->penggunaan_bahasa ?? '') }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Presentasi</td>
                                            <td>Mahasiswa mampu menyampaikan presentasi dengan jelas, terstruktur, dan
                                                menarik</td>
                                            <td>
                                                <input type="number" class="form-control"
                                                    id="presentasiEdit{{ $mhsSempro->id_sempro }}" name="presentasi"
                                                    min="0" max="100" required
                                                    value="{{ $isPembimbingSatu
                                                        ? optional($mhsSempro->nilaiPembimbing1)->presentasi ?? ''
                                                        : ($isPembimbingDua
                                                            ? optional($mhsSempro->nilaiPembimbing2)->presentasi ?? ''
                                                            : optional($mhsSempro->nilaiPenguji)->presentasi ?? '') }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>Total Nilai</strong></td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    id="nilai_semproEdit{{ $mhsSempro->id_sempro }}" name="nilai_sempro"
                                                    readonly
                                                    value="{{ $isPembimbingSatu
                                                        ? optional($mhsSempro->nilaiPembimbing1)->nilai_sempro ?? ''
                                                        : ($isPembimbingDua
                                                            ? optional($mhsSempro->nilaiPembimbing2)->nilai_sempro ?? ''
                                                            : optional($mhsSempro->nilaiPenguji)->nilai_sempro ?? '') }}">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan Penilaian</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function updateTotal(id_sempro) {
                const inputs = [
                    document.getElementById('pendahuluanEdit' + id_sempro),
                    document.getElementById('tinjauan_pustakaEdit' + id_sempro),
                    document.getElementById('metodologiEdit' + id_sempro),
                    document.getElementById('penggunaan_bahasaEdit' + id_sempro),
                    document.getElementById('presentasiEdit' + id_sempro)
                ];

                const totalInput = document.getElementById('nilai_semproEdit' + id_sempro);

                let total = 0;
                inputs.forEach(input => {
                    total += parseFloat(input.value) || 0;
                });
                totalInput.value = (total / 5).toFixed(2); // Calculate average and round to 2 decimal places
            }

            @foreach ($nilaiSempro as $mhsSempro)
                const editInputs{{ $mhsSempro->id_sempro }} = [
                    'pendahuluanEdit',
                    'tinjauan_pustakaEdit',
                    'metodologiEdit',
                    'penggunaan_bahasaEdit',
                    'presentasiEdit'
                ];

                editInputs{{ $mhsSempro->id_sempro }}.forEach(inputId => {
                    const element = document.getElementById(inputId + '{{ $mhsSempro->id_sempro }}');
                    if (element) {
                        element.addEventListener('input', () => updateTotal(
                            '{{ $mhsSempro->id_sempro }}'));
                    }
                });
            @endforeach
        });
    </script>
@endsection
