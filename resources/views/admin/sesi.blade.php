@extends('layouts.admin.template')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Breadcrumb -->
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
                        <li class="breadcrumb-item active" aria-current="page">Data Sesi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Tabel Data Sesi -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="card-title">Tabel Sesi</h4>
                            <a href="{{ route('sesi.create') }}" class="btn btn-primary text-white">
                                <i class="bi bi-plus-circle"></i> Tambah Sesi
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="sesiTable" width="100%" cellspacing="0">
                                <thead class="table">
                                    <tr>
                                        <th>No</th>
                                        <th>Dari Jam</th>
                                        <th>Sampai Jam</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_sesi as $index => $data)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $data->dari_jam }}</td>
                                            <td>{{ $data->sampai_jam }}</td>
                                            <td>
                                                <a href="{{ route('sesi.edit', $data->id_sesi) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('sesi.destroy', $data->id_sesi) }}" method="POST" style="display:inline;">
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
            $('#sesiTable').DataTable({
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
