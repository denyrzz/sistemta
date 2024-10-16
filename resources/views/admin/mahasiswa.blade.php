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
                        <li class="breadcrumb-item active" aria-current="page">Data Mahasiswa</li>
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
                            <h4 class="card-title">Tabel Mahasiswa</h4>
                            <div class="d-flex">
                                <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary text-white me-2">Tambah</a>
                                <a href="{{ route('mahasiswa.export') }}" class="btn btn-success  me-2"></i> Export</a>
                                <button type="button" class="btn btn-info"
                                    onclick="document.getElementById('fileInput').click()"><i
                                        class="fas fa-file-import"></i> Import</button>
                                <form id="importForm" action="{{ route('mahasiswa.import') }}" method="POST"
                                    enctype="multipart/form-data" style="display:none;">
                                    @csrf
                                    <input type="file" id="fileInput" name="file" style="display:none;"
                                        onchange="document.getElementById('importForm').submit()">
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead class="table">
                                    <tr>
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Program Studi</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_mahasiswa as $index => $data)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $data->nim }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>{{ $data->prodi_nama }}</td>
                                            <td>{{ $data->jenis_kelamin }}</td>
                                            <td>
                                                @if($data->image)
                                                    <img src="{{ asset('images/mahasiswa/' . $data->image) }}" alt="Gambar {{ $data->nama }}" style="width: 50px; height: auto;">
                                                @else
                                                    <img src="{{ asset('images/default.png') }}" alt="Default Image" style="width: 50px; height: auto;">
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('mahasiswa.edit', $data->id_mahasiswa) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('mahasiswa.destroy', $data->id_mahasiswa) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
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
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "responsive": true,
                "lengthChange": false,
                "pageLength": 10,
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ entri",
                    "zeroRecords": "Tidak ada data ditemukan",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada entri tersedia",
                    "infoFiltered": "(disaring dari _MAX_ total entri)",
                    "paginate": {
                        "next": "Berikutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });
        });
    </script>
@endsection
