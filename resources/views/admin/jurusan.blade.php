@extends('layouts.template')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    @if (session('success')) 
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-primary">Daftar Jurusan</h5>
            <a href="{{ route('jurusan.create') }}" class="btn btn-primary">Tambah</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="example" width="100%" cellspacing="0">
                    <thead>
                        <tr class="table-dark">
                            <th>NO</th>
                            <th>Kode Jurusan</th>
                            <th>Jurusan</th>
                            <th>Aksi</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_jurusan as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data->kode_jurusan }}</td>
                                <td>{{ $data->jurusan }}</td>
                                <td>
                                    <a href="{{ route('jurusan.edit', $data->id_jurusan) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('jurusan.destroy', $data->id_jurusan) }}" method="POST" style="display:inline;">
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
@endsection

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
