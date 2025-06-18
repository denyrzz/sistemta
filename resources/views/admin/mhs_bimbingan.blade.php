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
                        <li class="breadcrumb-item active" aria-current="page">Mahasiswa Bimbingan TA</li>
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
                            <h4 class="card-title">Bimbingan TA Mahasiswa</h4>
                            <a href="{{ route('mhs_bimbingan.create') }}" class="btn btn-primary text-white">Tambah File</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="logbookTable" width="100%" cellspacing="0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>                                                                                                                         </th>
                                        <th>File</th>
                                        <th>Komentar</th>
                                        <th>Validasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bimbingans as $bimbingan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($bimbingan->tanggal)->format('d-m-Y') }}</td>
                                            <td>
                                                @if($bimbingan->dokumentasi)
                                                    <a href="{{ asset('storage/uploads/mahasiswa/bimbingan/dokumentasi/' . $bimbingan->dokumentasi) }}" target="_blank" class="btn btn-info btn-sm">Lihat</a>
                                                @else
                                                    <span class="text-muted">Tidak Ada</span>
                                                @endif
                                            </td>
                                            <td>{{ $bimbingan->komentar }}</td>
                                            <td>
                                                <span class="badge {{ $bimbingan->validasi == '1' ? 'bg-success' : 'bg-warning' }}">
                                                    {{ $bimbingan->validasi == '1' ? 'ACC' : 'Belum ACC' }}
                                                </span>

                                            </td>
                                            <td>
                                                <!-- Edit and Delete actions can be added here if necessary -->
                                                {{-- <a href="{{ route('mhs_logbook.edit', $logbook->id_logbook) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('mhs_logbook.destroy', $logbook->id_logbook) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                </form> --}}
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
            $('#logbookTable').DataTable({
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
