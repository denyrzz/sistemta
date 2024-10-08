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
                    <li class="breadcrumb-item active" aria-current="page">Daftar Pimpinan</li>
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
                        <h4 class="card-title">Tabel Pimpinan</h4>
                        <a href="{{ route('pimpinan.create') }}" class="btn btn-primary text-white">Tambah Pimpinan</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="example" width="100%" cellspacing="0">
                            <thead class="table">
                                <tr>
                                    <th>ID</th>
                                    <th>Dosen</th>
                                    <th>Jabatan Pimpinan</th>
                                    <th>Periode</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pimpinans as $pimpinan)
                                    <tr>
                                        <td>{{ $pimpinan->id }}</td>
                                        <td>{{ $pimpinan->dosen->nama_dosen ?? 'N/A' }}</td>
                                        <td>{{ $pimpinan->jabatanPimpinan->jabatan_pimpinan ?? 'N/A' }}</td>
                                        <td>{{ $pimpinan->periode }}</td>
                                        <td>{{ $pimpinan->status_pimpinan == '1' ? 'Aktif' : 'Tidak Aktif' }}</td>
                                        <td>
                                            <a href="{{ route('pimpinan.edit', $pimpinan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('pimpinan.destroy', $pimpinan->id) }}" method="POST" style="display:inline;">
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

@section('scripts')
<script>
    $(document).ready(function() {
        $('#example').DataTable({
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

@endsection
