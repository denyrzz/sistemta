@extends('layouts.admin.template')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="card-title">Tabel Tugas Akhir</h4>
                            @if ($data_ta->isEmpty())
                                <button class="btn btn-primary text-white" data-bs-toggle="modal"
                                    data-bs-target="#createTAModal">Ajukan Sidang TA</button>
                            @endif
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                                <tbody>
                                    @forelse ($data_ta as $ta)
                                        <tr>
                                            <td>Proposal Final</td>
                                            <td>
                                                @if (!empty($ta->proposal_final))
                                                    <a href="{{ asset('storage/uploads/mahasiswa/proposal_final/' . $ta->proposal_final) }}"
                                                        target="_blank">
                                                        Lihat File
                                                    </a>
                                                @else
                                                    <span>No file uploaded</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Laporan TA</td>
                                            <td>
                                                @if (!empty($ta->laporan_ta))
                                                    <a href="{{ asset('storage/uploads/mahasiswa/laporan_ta/' . $ta->laporan_ta) }}"
                                                        target="_blank">
                                                        Lihat File
                                                    </a>
                                                @else
                                                    <span>No file uploaded</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tugas Akhir</td>
                                            <td>
                                                @if (!empty($ta->tugas_akhir))
                                                    <a href="{{ asset('storage/uploads/mahasiswa/tugas_akhir/' . $ta->tugas_akhir) }}"
                                                        target="_blank">
                                                        Lihat File
                                                    </a>
                                                @else
                                                    <span>No file uploaded</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Aksi</td>
                                            <td>
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editTAModal{{ $ta->id_ta }}">
                                                    Edit
                                                </button>

                                                <form action="{{ route('mhs_ta.destroy', $ta->id_ta) }}"
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
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center">Tidak ada data TA ditemukan.</td>
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
                        @foreach ($data_ta as $ta)
                            @if ($ta->mahasiswa->image)
                                <div class="text-center mb-3">
                                    <img src="{{ asset('storage/uploads/mahasiswa/image/' . $ta->mahasiswa->image) }}"
                                        style="width: 200px; height: 200px; object-fit: cover; border: 1px solid black; padding: 5px;">
                                </div>
                            @else
                                <p class="text-center">No image available</p>
                            @endif

                            <div class="details">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td><strong>Ketua Sidang</strong></td>
                                            <td>: {{ $ta->ketuasidang->nama_dosen ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                        <tr>
                                            <td><strong>Pembimbing 1</strong></td>
                                            <td>: {{ $ta->dosenpembimbing1->nama_dosen ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Pembimbing 2</strong></td>
                                            <td>: {{ $ta->dosenpembimbing2->nama_dosen ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Penguji 1</strong></td>
                                            <td>: {{ $ta->Penguji1->nama_dosen ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Penguji 2</strong></td>
                                            <td>: {{ $ta->Penguji2->nama_dosen ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Penguji 3</strong></td>
                                            <td>: {{ $ta->Penguji3->nama_dosen ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jadwal Sidang</strong></td>
                                            <td>: {{ $ta->tanggal_sidang ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Ruangan</strong></td>
                                            <td>: {{ $ta->ruangan ? $ta->ruangan->nama_ruangan : 'N/A' }} /
                                                {{ $ta->ruangan ? $ta->ruangan->no_ruangan : 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Sesi-Jam</strong></td>
                                            <td>: {{ $ta->sesi?->sesi ?? 'N/A' }} - {{ $ta->sesi?->jam ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Nilai TA</strong></td>
                                            <td>: {{ $ta->nilai_mahasiswa ?? 'N/A' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for creating TA -->
        <div class="modal fade" id="createTAModal" tabindex="-1" aria-labelledby="createTAModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createTAModalLabel">Ajukan Sidang TA</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('mhs_ta.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="proposal_final" class="form-label">Proposal Final</label>
                                <input type="file" class="form-control" id="proposal_final" name="proposal_final" required>
                                <small class="text-muted">Upload file proposal final anda</small>
                            </div>
                            <div class="mb-3">
                                <label for="laporan_ta" class="form-label">Laporan TA</label>
                                <input type="file" class="form-control" id="laporan_ta" name="laporan_ta" required>
                                <small class="text-muted">Upload file laporan TA anda</small>
                            </div>
                            <div class="mb-3">
                                <label for="tugas_akhir" class="form-label">Tugas Akhir</label>
                                <input type="file" class="form-control" id="tugas_akhir" name="tugas_akhir" required>
                                <small class="text-muted">Upload file tugas akhir anda</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for editing TA -->
        @foreach($data_ta as $ta)
        <div class="modal fade" id="editTAModal{{ $ta->id_ta }}" tabindex="-1" aria-labelledby="editTAModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTAModalLabel">Edit TA</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('mhs_ta.update', $ta->id_ta) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="proposal_final" class="form-label">Proposal Final</label>
                                <input type="file" class="form-control" id="proposal_final" name="proposal_final">
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah file proposal final.</small>
                            </div>
                            <div class="mb-3">
                                <label for="laporan_ta" class="form-label">Laporan TA</label>
                                <input type="file" class="form-control" id="laporan_ta" name="laporan_ta">
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah file laporan TA.</small>
                            </div>
                            <div class="mb-3">
                                <label for="tugas_akhir" class="form-label">Tugas Akhir</label>
                                <input type="file" class="form-control" id="tugas_akhir" name="tugas_akhir">
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah file tugas akhir.</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
