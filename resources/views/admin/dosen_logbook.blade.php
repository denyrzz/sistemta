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
                        <li class="breadcrumb-item active" aria-current="page">Logbook PKL - {{ $mhsPkl->mahasiswa->nama }}
                        </li>
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
                            <h4 class="card-title">Logbook PKL Mahasiswa: {{ $mhsPkl->mahasiswa->nama }}</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="logbookTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Awal</th>
                                        <th>Tanggal Akhir</th>
                                        <th>Kegiatan</th>
                                        <th>Dokumentasi</th>
                                        <th>Komentar</th>
                                        <th>Status Validasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mhsPkl->logbook as $index => $logbookEntry)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $logbookEntry->tgl_awal }}</td>
                                            <td>{{ $logbookEntry->tgl_akhir }}</td>
                                            <td>{{ $logbookEntry->kegiatan }}</td>
                                            <td>
                                                <a href="{{ asset('storage/uploads/mahasiswa/dokumentasi/' . $logbookEntry->dokumentasi) }}" target="_blank">Dokumentasi</a>
                                            </td>
                                            <td>{{ $logbookEntry->komentar }}</td>
                                            <td>
                                                <span class="badge {{ $logbookEntry->validasi == 1 ? 'bg-success' : 'bg-warning' }}">
                                                    {{ $logbookEntry->validasi == 1 ? 'Validasi' : 'Belum Validasi' }}
                                                </span>
                                            </td>
                                            <td>
                                                <form action="{{ route('dosenpembimbing.updateValidasi', $logbookEntry->id_logbook) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#komentarModal{{ $logbookEntry->id_logbook }}">
                                                            Validasi
                                                        </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($mhsPkl->logbook as $logbookEntry)
        <div class="modal fade" id="komentarModal{{ $logbookEntry->id_logbook }}" tabindex="-1" aria-labelledby="komentarModalLabel{{ $logbookEntry->id_logbook }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="komentarModalLabel{{ $logbookEntry->id_logbook }}">Tambah Komentar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('dosenpembimbing.updateValidasi', $logbookEntry->id_logbook) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="komentar">Komentar</label>
                                <textarea name="komentar" class="form-control" required>{{ $logbookEntry->komentar }}</textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan Komentar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
