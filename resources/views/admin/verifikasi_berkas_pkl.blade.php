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
                            <h4 class="card-title">Tabel Berkas PKL</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="example" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Nilai Industri</th>
                                        <th>Dokumen Nilai Industri</th>
                                        <th>Dokumen PKL</th>
                                        <th>Verifikasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mhsPkl as $index => $mhs)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $mhs->mahasiswa->nama }}</td>
                                            <td>{{ $mhs->nilai_pembimbing_industri }}</td>
                                            <td><a href="{{ asset('storage/uploads/mahasiswa/dokument_nilai_industri/' . $mhs->dokument_nilai_industri) }}"
                                                    target="_blank">Lihat</a></td>
                                            <td><a href="{{ asset('storage/uploads/mahasiswa/dokument_pkl/' . $mhs->dokument_pkl) }}"
                                                    target="_blank">Lihat</a></td>
                                            <td>
                                                <span
                                                    class="badge {{ $mhs->verif_berkas == '1' ? 'bg-success' : 'bg-warning' }}">
                                                    {{ $mhs->verif_berkas == '1' ? 'Sudah' : 'Belum' }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($mhs->verif_berkas == '0')
                                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#verifikasiModal{{ $mhs->id_pkl }}">Verifikasi</button>
                                                @else
                                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#editVerifikasiModal{{ $mhs->id_pkl }}">Edit</button>
                                                @endif
                                            </td>

                                        </tr>

                                        <!-- Verifikasi Modal -->
                                        <div class="modal fade" id="verifikasiModal{{ $mhs->id_pkl }}" tabindex="-1"
                                            role="dialog" aria-labelledby="verifikasiModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="verifikasiModalLabel">Verifikasi Berkas
                                                            PKL</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('verif_berkas.verifikasi', $mhs->id_pkl) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <p>Apakah Anda yakin ingin memverifikasi berkas PKL ini?</p>
                                                            <button type="submit"
                                                                class="btn btn-success">Verifikasi</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Edit Verifikasi Modal -->
                                        <div class="modal fade" id="editVerifikasiModal{{ $mhs->id_pkl }}" tabindex="-1"
                                            role="dialog" aria-labelledby="editVerifikasiModalLabel{{ $mhs->id_pkl }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="editVerifikasiModalLabel{{ $mhs->id_pkl }}">Edit Status
                                                            Verifikasi</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ route('verif_berkas.update', $mhs->id_pkl) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <p>Apakah Anda ingin mengubah status verifikasi berkas ini
                                                                menjadi "Belum"?</p>
                                                            <button type="submit" class="btn btn-warning">Ubah
                                                                Status</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                        </form>
                                                    </div>
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

<!-- Include Bootstrap 5 JavaScript -->
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
