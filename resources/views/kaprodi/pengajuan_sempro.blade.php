@extends('layouts.admin.template')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="card-title">Tabel Sempro Mahasiswa</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="example" width="100%" cellspacing="0">
                                <thead class="table">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Judul</th>
                                        <th>File</th>
                                        <th>Verif Berkas</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $counter = 1;
                                    @endphp
                                    @forelse ($data_sempro as $sempro)
                                        <tr>
                                            <td>{{ $counter++ }}</td>
                                            <td>{{ $sempro->mahasiswa->nama ?? 'N/A' }}</td>
                                            <td>{{ $sempro->judul ?? 'N/A' }}</td>
                                            <td>
                                                @if (!empty($sempro->file_sempro))
                                                    <a href="{{ asset('storage/uploads/mahasiswa/sempro/' . $sempro->file_sempro) }}"
                                                        target="_blank">Lihat File</a>
                                                @else
                                                    <span>No file uploaded</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span
                                                    class="badge {{ $sempro->verif_berkas == '1' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $sempro->verif_berkas == '1' ? 'Sudah' : 'Belum' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge {{ $sempro->status == '1' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $sempro->status == '1' ? 'Sudah DiVerifikasi' : 'Belum DiVerifikasi' }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($sempro->status != '1')
                                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#addDosenModal" data-id="{{ $sempro->id_sempro }}">
                                                        Verifikasi
                                                    </button>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data Sempro ditemukan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk verifikasi Sempro -->
        <div class="modal fade" id="addDosenModal" tabindex="-1" aria-labelledby="addDosenModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="verifySemproForm" method="POST" action="{{ route('kaprodi_sempro.verify', ['id' => $sempro->id_sempro]) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addDosenModalLabel">Verifikasi Sempro</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin memverifikasi data Sempro ini?</p>

                            <!-- Pembimbing 1 -->
                            <div class="mb-3">
                                <label for="pembimbing_satu" class="form-label">Pembimbing 1</label>
                                <select id="pembimbing_satu" name="pembimbing_satu" class="form-select" required>
                                    <option value="">Pilih Pembimbing 1</option>
                                    @foreach ($dosen as $dosen_item)
                                        <option value="{{ $dosen_item->id_dosen }}">{{ $dosen_item->nama_dosen }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Pembimbing 2 -->
                            <div class="mb-3">
                                <label for="pembimbing_dua" class="form-label">Pembimbing 2</label>
                                <select id="pembimbing_dua" name="pembimbing_dua" class="form-select">
                                    <option value="">Pilih Pembimbing 2</option>
                                    @foreach ($dosen as $dosen_item)
                                        <option value="{{ $dosen_item->id_dosen }}">{{ $dosen_item->nama_dosen }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Verifikasi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#addDosenModal').on('show.bs.modal', function (event) {
                const button = $(event.relatedTarget);
                const semproId = button.data('id');

                // Set hidden input for sempro_id
                const form = document.getElementById('verifySemproForm');
                form.action = `{{ url('kaprodi_sempro/verify') }}/${semproId}`;
            });
        });
    </script>
@endsection
