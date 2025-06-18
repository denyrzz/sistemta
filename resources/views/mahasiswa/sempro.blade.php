@extends('layouts.admin.template')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="card-title">Tabel Seminar Proposal</h4>
                            @if ($data_sempro->isEmpty())
                                <button class="btn btn-primary text-white" data-bs-toggle="modal"
                                    data-bs-target="#createSemproModal">Ajukan Judul</button>
                            @endif
                            @php
                                $counter = 1;
                            @endphp
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                                <tbody>
                                    @forelse ($data_sempro as $sempro)
                                        <tr>
                                            <td>Judul</td>
                                            <td>{{ $sempro->judul ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td>File Sempro</td>
                                            <td>
                                                @if (!empty($sempro->file_sempro))
                                                    <a href="{{ asset('storage/uploads/mahasiswa/sempro/' . $sempro->file_sempro) }}"
                                                        target="_blank">
                                                        Lihat File
                                                    </a>
                                                @else
                                                    <span>No file uploaded</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>
                                                <span
                                                    class="badge {{ $sempro->status == '1' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $sempro->status == '1' ? 'Sudah Dikonfirmasi' : 'Belum Dikonfirmasi' }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Aksi</td>
                                            <td>
                                                <!-- Edit Button -->
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editSemproModal{{ $sempro->id_sempro }}">
                                                    Edit
                                                </button>

                                                <!-- Delete Form -->
                                                <form action="{{ route('mhs_sempro.destroy', $sempro->id_sempro) }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Modal for editing Sempro -->
                                        <div class="modal fade" id="editSemproModal{{ $sempro->id_sempro }}" tabindex="-1"
                                            aria-labelledby="editSemproModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editSemproModalLabel">Edit Judul Sempro
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('mhs_sempro.update', $sempro->id_sempro) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="judul" class="form-label">Judul
                                                                    Sempro</label>
                                                                <input type="text" class="form-control" id="judul"
                                                                    name="judul" value="{{ $sempro->judul }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="file_sempro" class="form-label">File
                                                                    Sempro</label>
                                                                <input type="file" class="form-control" id="file_sempro"
                                                                    name="file_sempro">
                                                                <small class="text-muted">Biarkan kosong jika tidak ingin
                                                                    mengubah file.</small>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data Sempro ditemukan.</td>
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
                                            <td>: {{ $sempro->Penguji->nama_dosen ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jadwal Sempro</strong></td>
                                            <td>: {{ $sempro->tanggal_sempro ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Ruangan</strong></td>
                                            <td>: {{ $sempro->ruangan ? $sempro->ruangan->nama_ruangan : 'N/A' }} /
                                                {{ $sempro->ruangan ? $sempro->ruangan->no_ruangan : 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Sesi-Jam</strong></td>
                                            <td>: {{ $sempro->sesi?->sesi ?? 'N/A' }} - {{ $sempro->sesi?->jam ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Nilai Sempro</strong></td>
                                            <td>: {{ $sempro->nilai_mahasiswa ?? 'N/A' }} </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for creating Sempro -->
        <div class="modal fade" id="createSemproModal" tabindex="-1" aria-labelledby="createSemproModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createSemproModalLabel">Ajukan Judul Sempro</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('mhs_sempro.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
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
