@extends('layouts.admin.template')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
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
                        <li class="breadcrumb-item active" aria-current="page">Usulan Tempat PKL</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-0">
                    <div class="card-body">
                        <h4 class="card-title">Mahasiswa PKL</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Nama Perusahaan</th>
                                        <th>konfirmasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usulanPkl as $index => $pkl)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $pkl->mahasiswa->nama }}</td>
                                            <td>{{ $pkl->perusahaan->nama_perusahaan }}</td>
                                            <td>
                                                <span class="badge {{ $pkl->konfirmasi == '1' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $pkl->konfirmasi == '1' ? 'Sudah Dikonfirmasi' : 'Belum Dikonfirmasi' }}
                                                </span>
                                            </td>

                                            <td>
                                                <form action="{{ route('usulan_pkl.destroy', $pkl->id_usulan_pkl) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
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


    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mt-0">
                    <div class="card-body">
                        <h4 class="card-title">Usulan Tempat PKL</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Perusahaan</th>
                                        <th>Alamat</th>
                                        <th>Kontak</th>
                                        <th>Kuota</th>
                                        <th>Sisa Kuota</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tempatPkl as $index => $tempat)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $tempat->nama_perusahaan }}</td>
                                            <td>{{ $tempat->alamat }}</td>
                                            <td>{{ $tempat->kontak }}</td>
                                            <td>{{ $tempat->kuota }}</td>
                                            <td>
                                                @php
                                                    $kuotaDefault = 4; // Kuota default
                                                    $mahasiswaCount = $tempat->usulanPkl->count(); // Menggunakan relasi usulanPkl untuk menghitung jumlah mahasiswa
                                                    $sisaKuota = $kuotaDefault - $mahasiswaCount; // Menghitung sisa kuota
                                                @endphp

                                                @if ($sisaKuota > 0)
                                                    {{ $sisaKuota }}
                                                @else
                                                    Tidak ada kuota tersisa
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('usulan_pkl.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="mahasiswa_id"
                                                    value="{{ optional(auth()->user()->mahasiswa)->id_mahasiswa ?? '' }}">


                                                    <input type="hidden" name="tempat_id"
                                                        value="{{ $tempat->id_tempat }}">
                                                    @if (in_array($tempat->id_tempat, $selectedUsulan))
                                                        -
                                                    @else
                                                        <button type="submit" class="btn btn-success btn-sm">Pilih</button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($tempatPkl->isEmpty())
                                <div class="alert alert-warning" role="alert">
                                    Tidak ada tempat PKL yang tersedia.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
