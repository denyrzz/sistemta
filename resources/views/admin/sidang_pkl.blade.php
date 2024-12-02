{{-- resources/views/admin/sidang_pkl.blade.php --}}

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
                        <li class="breadcrumb-item active" aria-current="page">Sidang PKL</li>
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
                        <h4 class="card-title">Daftar Sidang PKL</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="example" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Dosen Pembimbing</th>
                                        <th>Dosen Penguji</th>
                                        <th>Tanggal Sidang</th>
                                        <th>Ruangan</th>
                                        <th>Sesi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mhsPkl as $index => $mhs)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $mhs->mahasiswa->nama }}</td>
                                            <td>{{ $mhs->dosenpembimbing->nama_dosen }}</td>
                                            <td>
                                                @if ($mhs->dosenpenguji && $mhs->dosenpenguji->nama_dosen)
                                                    {{ $mhs->dosenpenguji->nama_dosen }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $mhs->tanggal_sidang }}</td>
                                            <td>
                                                {{ $mhs->ruangan
                                                    ? ($mhs->ruangan->nama_ruangan && $mhs->ruangan->no_ruangan
                                                        ? $mhs->ruangan->nama_ruangan . ' - ' . $mhs->ruangan->no_ruangan
                                                        : '-')
                                                    : '-' }}
                                            </td>
                                            <td>{{ $mhs->sesi ? $mhs->sesi->jam : '-' }}</td>
                                            <td>
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#sidangModal{{ $mhs->id_pkl }}">
                                                    Jadwalkan
                                                </button>
                                                <a href="{{ route('surat_tugas.generatePDF', ['id' => $mhs->id_pkl]) }}"
                                                    class="btn btn-primary text-white btn-sm">Surat Tugas</a>
                                                {{-- <form action="{{ route('sidang_pkl.destroy', $mhs->id_pkl) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                                                </form> --}}
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="sidangModal{{ $mhs->id_pkl }}" tabindex="-1"
                                            aria-labelledby="sidangModalLabel{{ $mhs->id_pkl }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="sidangModalLabel{{ $mhs->id_pkl }}">
                                                            Atur Sidang PKL
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('sidang_pkl.update', $mhs->id_pkl) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <!-- Dropdown Dosen Penguji -->
                                                            <div class="form-group">
                                                                <label for="dosen_penguji">Dosen
                                                                    Penguji</label>
                                                                <select class="form-control" name="dosen_penguji"
                                                                    id="dosen_penguji" required>
                                                                    <option value="">-- Pilih Dosen --</option>
                                                                    @foreach ($mhs->Dosen as $dosen)
                                                                        <option value="{{ $dosen->id_dosen }}"
                                                                            {{ old('dosen_penguji', $mhs->dosen_penguji) == $dosen->id_dosen ? 'selected' : '' }}>
                                                                            {{ $dosen->nama_dosen }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <!-- Input Tanggal Sidang -->
                                                            <div class="form-group mt-3">
                                                                <label for="tanggal_sidang">Tanggal
                                                                    Sidang</label>
                                                                <input type="date" class="form-control"
                                                                    name="tanggal_sidang" id="tanggal_sidang"
                                                                    value="{{ old('tanggal_sidang', $mhs->tanggal_sidang) }}"
                                                                    required>
                                                            </div>

                                                            <!-- Input Ruangan -->
                                                            <div class="form-group mt-3">
                                                                <label for="ruangan_id">Ruangan</label>
                                                                <select class="form-control" name="ruangan_id"
                                                                    id="ruangan_id" required>
                                                                    <option value="">-- Pilih Ruangan --</option>
                                                                    @foreach ($ruanganList as $ruangan)
                                                                        <option value="{{ $ruangan->id_ruangan }}"
                                                                            {{ old('ruangan_id', $mhs->ruangan_id) == $ruangan->id_ruangan ? 'selected' : '' }}>
                                                                            {{ $ruangan->nama_ruangan }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <!-- Dropdown Sesi -->
                                                            <div class="form-group mt-3">
                                                                <label for="sesi_id">Sesi</label>
                                                                <select class="form-control" name="sesi_id" id="sesi_id"
                                                                    required>
                                                                    <option value="">-- Pilih Sesi --</option>
                                                                    @foreach ($sesiList as $sesi)
                                                                        <option value="{{ $sesi->id_sesi }}"
                                                                            {{ old('sesi_id', $mhs->sesi_id) == $sesi->id_sesi ? 'selected' : '' }}>
                                                                            {{ $sesi->jam }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
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
@endsection
