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
                        <li class="breadcrumb-item active" aria-current="page">Sempro Mahasiswa</li>
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
                        <h4 class="card-title">Daftar Sempro Mahasiswa</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="example" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Pembimbing I</th>
                                        <th>Pembimbing II</th>
                                        <th>Penguji</th>
                                        <th>Tanggal Sempro</th>
                                        <th>Ruangan</th>
                                        <th>Sesi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_sempro as $index => $sempro)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $sempro->mahasiswa->nama ?? 'N/A' }}</td>
                                            <td>{{ $sempro->pembimbingSatu->nama_dosen ?? 'N/A' }}</td>
                                            <td>{{ $sempro->pembimbingDua->nama_dosen ?? 'N/A' }}</td>
                                            <td>{{ $sempro->Penguji->nama_dosen ?? 'N/A' }}</td>
                                            <td>{{ $sempro->tanggal_sempro ?? 'Belum Dijadwalkan' }}</td>
                                            <td>{{ $sempro->ruangan->nama_ruangan ?? 'N/A' }}</td>
                                            <td>{{ $sempro->sesi->sesi ?? 'N/A' }}</td>
                                            <td>
                                                <button type="button" class="btn btn-secondary btn-sm w-100 mb-2"
                                                    data-bs-toggle="modal" data-bs-target="#semproModal{{ $sempro->id_sempro }}">
                                                    Jadwalkan
                                                </button>
                                                <a href="{{ route('surat_tugas_sempro.generatePDF', ['id' => $sempro->id_sempro]) }}"
                                                    class="btn btn-primary text-white btn-sm w-100">
                                                    Surat Tugas
                                                </a>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="semproModal{{ $sempro->id_sempro }}" tabindex="-1"
                                            aria-labelledby="semproModalLabel{{ $sempro->id_sempro }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="semproModalLabel{{ $sempro->id_sempro }}">
                                                            Jadwalkan Sempro</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('sempro.store', $sempro->id_sempro) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="penguji">Dosen Penguji</label>
                                                                <select class="form-control" name="penguji" id="penguji" required>
                                                                    <option value="">-- Pilih Dosen --</option>
                                                                    @foreach ($dosenList as $dosen)
                                                                        <option value="{{ $dosen->id_dosen }}"
                                                                            {{ old('penguji', $sempro->penguji) == $dosen->id_dosen ? 'selected' : '' }}>
                                                                            {{ $dosen->nama_dosen }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group mt-3">
                                                                <label for="tanggal_sempro">Tanggal Sempro</label>
                                                                <input type="date" class="form-control"
                                                                name="tanggal_sempro" id="tanggal_sempro"
                                                                value="{{ old('tanggal_sempro', $sempro->tanggal_sempro) }}"
                                                                required>
                                                            </div>

                                                            <div class="form-group mt-3">
                                                                <label for="ruangan_id">Ruangan</label>
                                                                <select class="form-control" name="ruangan_id"
                                                                    id="ruangan_id" required>
                                                                    <option value="">-- Pilih Ruangan --</option>
                                                                    @foreach ($ruanganList as $ruangan)
                                                                        <option value="{{ $ruangan->id_ruangan }}"
                                                                            {{ old('ruangan_id', $sempro->ruangan_id) == $ruangan->id_ruangan ? 'selected' : '' }}>
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
                                                                            {{ old('sesi_id', $sempro->sesi_id) == $sesi->id_sesi ? 'selected' : '' }}>
                                                                            {{ $sesi->jam }}
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
