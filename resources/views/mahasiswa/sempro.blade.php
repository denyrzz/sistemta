@extends('layouts.admin.template')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="card-title">Tabel Sempro</h4>
                            <!-- Button to trigger modal -->
                            <button class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#createSemproModal">Ajukan Judul</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="example" width="100%" cellspacing="0">
                                <thead class="table">
                                    <tr>
                                        <th>ID</th>
                                        <th>Judul</th>
                                        <th>File</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data_sempro as $sempro)
                                        <tr>
                                            <td>{{ $sempro->id_sempro }}</td>
                                            <td>{{ $sempro->judul ?? 'N/A' }}</td>
                                            <td>{{ $sempro->file_sempro ?? 'N/A' }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $sempro->status == '1' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $sempro->status == '1' ? 'Sudah Dikonfirmasi' : 'Belum Dikonfirmasi' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data Sempro ditemukan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        @foreach ($data_sempro as $sempro)
                            @if ($sempro->mahasiswa->image)
                                <div class="text-center mb-3">
                                    <img src="{{ asset('storage/uploads/mahasiswa/image/' . $sempro->mahasiswa->image) }}"
                                        style="width: 200px; height: 200px; object-fit: cover; border: 1px solid black; padding: 5px;">
                                </div>
                            @else
                                <p class="text-center">No image available</p>
                            @endif

                            <div class="details">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td><strong>Pembimbing 1</strong></td>
                                            <td>: {{ $sempro->pembimbingSatu->nama_dosen ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Pembimbing 2</strong></td>
                                            <td>: {{ $sempro->pembimbingDua->nama_dosen ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Penguji</strong></td>
                                            <td>: {{ $sempro->penguji->nama_dosen ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jadwal Sidang</strong></td>
                                            <td>: {{ $sempro->tanggal_sempro }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Ruangan</strong></td>
                                            <td>:
                                                @if ($sempro->ruangan)
                                                    {{ $sempro->ruangan->nama_ruangan }} / {{ $sempro->ruangan->no_ruangan }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><strong>Sesi-Jam</strong></td>
                                            <td>:
                                                @if ($sempro->sesi)
                                                    {{ $sempro->sesi->sesi }} - {{ $sempro->sesi->jam }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><strong>Nilai Sidang</strong></td>
                                            <td>: {{ $sempro->nilai_mahasiswa ?? 'N/A' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for creating Sempro -->
    <div class="modal fade" id="createSemproModal" tabindex="-1" aria-labelledby="createSemproModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createSemproModalLabel">Ajukan Judul Sempro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('mhs_sempro.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Sempro</label>
                            <input type="text" class="form-control" id="judul" name="judul" required>
                        </div>
                        <div class="mb-3">
                            <label for="file_sempro" class="form-label">File Sempro</label>
                            <input type="file" class="form-control" id="file_sempro" name="file_sempro" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
