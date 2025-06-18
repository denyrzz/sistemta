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
                        <li class="breadcrumb-item active" aria-current="page">TA Mahasiswa</li>
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
                        <h4 class="card-title">Daftar TA Mahasiswa</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="example" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Ketua Sidang</th>
                                        <th>Penguji 1</th>
                                        <th>Penguji 2</th>
                                        <th>Penguji 3</th>
                                        <th>Tanggal</th>
                                        <th>Ruangan</th>
                                        <th>Sesi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_ta as $index => $ta)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $ta->mahasiswa->nama ?? 'N/A' }}</td>
                                            <td>{{ $ta->ketuasidang->nama_dosen ?? 'N/A' }}</td>
                                            <td>{{ $ta->penguji1->nama_dosen ?? 'N/A' }}</td>
                                            <td>{{ $ta->penguji2->nama_dosen ?? 'N/A' }}</td>
                                            <td>{{ $ta->penguji3->nama_dosen ?? 'N/A' }}</td>
                                            <td>{{ $ta->tanggal_sidang ?? 'Belum Dijadwalkan' }}</td>
                                            <td>{{ $ta->ruangan->nama_ruangan ?? 'N/A' }}</td>
                                            <td>{{ $ta->sesi->sesi ?? 'N/A' }}</td>
                                            <td>
                                                <button type="button" class="btn btn-secondary btn-sm w-100 mb-2"
                                                    data-bs-toggle="modal" data-bs-target="#taModal{{ $ta->id_ta }}">
                                                    Jadwalkan
                                                </button>
                                                <a href="{{ route('surat_tugas_ta.generatePDF', ['id' => $ta->id_ta]) }}"
                                                    class="btn btn-primary text-white btn-sm w-100">
                                                    Surat Tugas
                                                </a>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="taModal{{ $ta->id_ta }}" tabindex="-1"
                                            aria-labelledby="taModalLabel{{ $ta->id_ta }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="taModalLabel{{ $ta->id_ta }}">
                                                            Jadwalkan Sidang TA</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('sidang_ta.store', $ta->id_ta) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="ketua_sidang">Ketua Sidang</label>
                                                                <select class="form-control" name="ketua_sidang" id="ketua_sidang" required>
                                                                    <option value="">-- Pilih Ketua Sidang --</option>
                                                                    @if($ta->dosenPembimbing1)
                                                                        <option value="{{ $ta->dosenPembimbing1->id_dosen }}">
                                                                            {{ $ta->dosenPembimbing1->nama_dosen }}
                                                                        </option>
                                                                    @endif
                                                                    @if($ta->dosenPembimbing2)
                                                                        <option value="{{ $ta->dosenPembimbing2->id_dosen }}">
                                                                            {{ $ta->dosenPembimbing2->nama_dosen }}
                                                                        </option>
                                                                    @endif
                                                                </select>
                                                            </div>

                                                            <div class="form-group mt-3">
                                                                <label for="penguji1">Penguji 1</label>
                                                                <select class="form-control" name="penguji1" id="penguji1" required>
                                                                    <option value="">-- Pilih Penguji 1 --</option>
                                                                    @foreach ($dosenList as $dosen)
                                                                        <option value="{{ $dosen->id_dosen }}"
                                                                            {{ old('penguji1', $ta->penguji1_id) == $dosen->id_dosen ? 'selected' : '' }}>
                                                                            {{ $dosen->nama_dosen }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group mt-3">
                                                                <label for="penguji2">Penguji 2</label>
                                                                <select class="form-control" name="penguji2" id="penguji2" required>
                                                                    <option value="">-- Pilih Penguji 2 --</option>
                                                                    @foreach ($dosenList as $dosen)
                                                                        <option value="{{ $dosen->id_dosen }}"
                                                                            {{ old('penguji2', $ta->penguji2_id) == $dosen->id_dosen ? 'selected' : '' }}>
                                                                            {{ $dosen->nama_dosen }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group mt-3">
                                                                <label for="penguji3">Penguji 3</label>
                                                                <select class="form-control" name="penguji3" id="penguji3" required>
                                                                    <option value="">-- Pilih Penguji 3 --</option>
                                                                    @foreach ($dosenList as $dosen)
                                                                        <option value="{{ $dosen->id_dosen }}"
                                                                            {{ old('penguji3', $ta->penguji3_id) == $dosen->id_dosen ? 'selected' : '' }}>
                                                                            {{ $dosen->nama_dosen }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group mt-3">
                                                                <label for="tanggal_sidang">Tanggal Sidang</label>
                                                                <input type="date" class="form-control"
                                                                    name="tanggal_sidang" id="tanggal_sidang"
                                                                    value="{{ old('tanggal_sidang', $ta->tanggal_sidang) }}"
                                                                    required>
                                                            </div>

                                                            <div class="form-group mt-3">
                                                                <label for="ruangan_id">Ruangan</label>
                                                                <select class="form-control" name="ruangan_id"
                                                                    id="ruangan_id" required>
                                                                    <option value="">-- Pilih Ruangan --</option>
                                                                    @foreach ($ruanganList as $ruangan)
                                                                        <option value="{{ $ruangan->id_ruangan }}"
                                                                            {{ old('ruangan_id', $ta->ruangan_id) == $ruangan->id_ruangan ? 'selected' : '' }}>
                                                                            {{ $ruangan->nama_ruangan }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group mt-3">
                                                                <label for="sesi_id">Sesi</label>
                                                                <select class="form-control" name="sesi_id" id="sesi_id"
                                                                    required>
                                                                    <option value="">-- Pilih Sesi --</option>
                                                                    @foreach ($sesiList as $sesi)
                                                                        <option value="{{ $sesi->id_sesi }}"
                                                                            {{ old('sesi_id', $ta->sesi_id) == $sesi->id_sesi ? 'selected' : '' }}>
                                                                            {{ $sesi->sesi }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">Save</button>
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
@endsection
