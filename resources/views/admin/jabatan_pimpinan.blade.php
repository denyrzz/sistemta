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
                    <li class="breadcrumb-item active" aria-current="page">Jabatan Pimpinan</li>
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
                        <h4 class="card-title">Tabel Jabatan Pimpinan</h4>
                        <a href="{{ route('jabatan_pimpinan.create') }}" class="btn btn-primary text-white">Tambah Jabatan Pimpinan</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="jabatanPimpinanTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Jabatan Pimpinan</th>
                                    <th>Kode Jabatan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jabatanPimpinan as $jabatan)
                                    <tr>
                                        <td>{{ $jabatan->id_jabatan_pimpinan }}</td>
                                        <td>{{ $jabatan->jabatan_pimpinan }}</td>
                                        <td>{{ $jabatan->kode_jabatan_pimpinan }}</td>
                                        <td>{{ $jabatan->status_jabatan_pimpinan == '1' ? 'Aktif' : 'Tidak Aktif' }}</td>
                                        <td>
                                            <a href="{{ route('jabatan_pimpinan.edit', $jabatan->id_jabatan_pimpinan) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('jabatan_pimpinan.destroy', $jabatan->id_jabatan_pimpinan) }}" method="POST" style="display:inline;">
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
        $('#jabatanPimpinanTable').DataTable({
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
