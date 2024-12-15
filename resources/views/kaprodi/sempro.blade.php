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
                                        <th>Judul</th>
                                        <th>File</th>
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
                                                    class="badge {{ $sempro->status == '1' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $sempro->status == '1' ? 'Sudah Dikonfirmasi' : 'Belum Dikonfirmasi' }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($sempro->status != '1')
                                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#addDosenModal" data-id="{{ $sempro->id_sempro }}"
                                                        data-pembimbing_satu="{{ $sempro->pembimbing_satu }}"
                                                        data-pembimbing_dua="{{ $sempro->pembimbing_dua }}"
                                                        data-penguji="{{ $sempro->penguji }}"
                                                        data-ruangan="{{ $sempro->ruangan }}"
                                                        data-sesi="{{ $sempro->sesi }}"
                                                        data-tanggal_sempro="{{ $sempro->tanggal_sempro }}">
                                                        Verifikasi
                                                    </button>
                                                @else
                                                    <button class="btn btn-secondary btn-sm" disabled>Terverifikasi</button>
                                                @endif
                                            </td>
                                        </tr>
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
        </div>

        <!-- Modal untuk menambahkan pembimbing dan penguji -->
        <div class="modal fade" id="addDosenModal" tabindex="-1" aria-labelledby="addDosenModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="addDosenForm" method="POST" action="{{ route('kaprodi_sempro.add_dosen', ['id' => $sempro->id_sempro]) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addDosenModalLabel">Tambah Pembimbing dan Penguji</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Hidden input untuk ID Sempro -->
                            <!-- Hidden input untuk ID Sempro -->
                            {{-- <input type="hidden" id="id_sempro" name="id_sempro"> --}}

                            <!-- Ruangan -->
                            <div class="mb-3">
                                <label for="ruangan_id" class="form-label">Ruangan</label>
                                <select id="ruangan_id" name="ruangan_id" class="form-select">
                                    <option value="">Pilih Ruangan</option>
                                    @foreach ($ruangan as $ruang)
                                        <option value="{{ $ruang->id_ruangan }}">{{ $ruang->nama_ruangan }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Sesi -->
                            <div class="mb-3">
                                <label for="sesi_id" class="form-label">Sesi</label>
                                <select id="sesi_id" name="sesi_id" class="form-select">
                                    <option value="">Pilih Sesi</option>
                                    @foreach ($sesi as $session)
                                        <option value="{{ $session->id_sesi }}">{{ $session->sesi }} / {{ $session->jam }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Tanggal Sempro -->
                            <div class="mb-3">
                                <label for="tanggal_sempro" class="form-label">Tanggal Sempro</label>
                                <input type="date" id="tanggal_sempro" name="tanggal_sempro" class="form-control">
                            </div>

                            <!-- Pembimbing 1 -->
                            <div class="mb-3">
                                <label for="pembimbing_satu" class="form-label">Pembimbing 1</label>
                                <select id="pembimbing_satu" name="pembimbing_satu" class="form-select">
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

                            <!-- Penguji -->
                            <div class="mb-3">
                                <label for="penguji" class="form-label">Penguji</label>
                                <select id="penguji" name="penguji" class="form-select">
                                    <option value="">Pilih Penguji</option>
                                    @foreach ($dosen as $dosen_item)
                                        <option value="{{ $dosen_item->id_dosen }}">{{ $dosen_item->nama_dosen }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pembimbingSatu = document.getElementById('pembimbing_satu');
            const pembimbingDua = document.getElementById('pembimbing_dua');
            const penguji = document.getElementById('penguji');

            // Function to update the available options in the select dropdowns
            function updateSelectOptions() {
                const selectedPembimbingSatu = pembimbingSatu.value;
                const selectedPembimbingDua = pembimbingDua.value;
                const selectedPenguji = penguji.value;

                // Function to enable all options in a select dropdown
                function enableAllOptions(selectElement) {
                    Array.from(selectElement.options).forEach(option => {
                        option.disabled = false;
                    });
                }

                // Function to disable options in other selects
                function disableOption(selectElement, value) {
                    Array.from(selectElement.options).forEach(option => {
                        option.disabled = (option.value === value);
                    });
                }

                // Reset disabled state for all selects before applying new state
                enableAllOptions(pembimbingSatu);
                enableAllOptions(pembimbingDua);
                enableAllOptions(penguji);

                // Disable selected options
                disableOption(pembimbingSatu, selectedPembimbingDua);
                disableOption(pembimbingSatu, selectedPenguji);
                disableOption(pembimbingDua, selectedPembimbingSatu);
                disableOption(pembimbingDua, selectedPenguji);
                disableOption(penguji, selectedPembimbingSatu);
                disableOption(penguji, selectedPembimbingDua);

                // Disable selected Pembimbing 1 from Pembimbing 2 and Penguji
                if (selectedPembimbingSatu) {
                    Array.from(pembimbingDua.options).forEach(option => {
                        if (option.value === selectedPembimbingSatu) {
                            option.disabled = true; // Disable Pembimbing 1 in Pembimbing 2
                        }
                    });
                    Array.from(penguji.options).forEach(option => {
                        if (option.value === selectedPembimbingSatu) {
                            option.disabled = true; // Disable Pembimbing 1 in Penguji
                        }
                    });
                }

                // Disable selected Pembimbing 2 from Pembimbing 1 and Penguji
                if (selectedPembimbingDua) {
                    Array.from(pembimbingSatu.options).forEach(option => {
                        if (option.value === selectedPembimbingDua) {
                            option.disabled = true; // Disable Pembimbing 2 in Pembimbing 1
                        }
                    });
                    Array.from(penguji.options).forEach(option => {
                        if (option.value === selectedPembimbingDua) {
                            option.disabled = true; // Disable Pembimbing 2 in Penguji
                        }
                    });
                }

                // Disable selected Penguji from Pembimbing 1 and Pembimbing 2
                if (selectedPenguji) {
                    Array.from(pembimbingSatu.options).forEach(option => {
                        if (option.value === selectedPenguji) {
                            option.disabled = true; // Disable Penguji in Pembimbing 1
                        }
                    });
                    Array.from(pembimbingDua.options).forEach(option => {
                        if (option.value === selectedPenguji) {
                            option.disabled = true; // Disable Penguji in Pembimbing 2
                        }
                    });
                }
            }

            // Event listeners for select changes
            pembimbingSatu.addEventListener('change', updateSelectOptions);
            pembimbingDua.addEventListener('change', updateSelectOptions);
            penguji.addEventListener('change', updateSelectOptions);

            // Initial call to disable already selected options
            updateSelectOptions();

            // Update modal data when opening modal
            $('#addDosenModal').on('show.bs.modal', function(event) {
                const button = $(event.relatedTarget);
                const semproId = button.data('id');
                const pembimbingSatuId = button.data('pembimbing_satu');
                const pembimbingDuaId = button.data('pembimbing_dua');
                const pengujiId = button.data('penguji');
                const ruangan = button.data('ruangan');
                const sesi = button.data('sesi');
                const tanggalSempro = button.data('tanggal_sempro');

                // Set hidden input for sempro_id
                $('#sempro_id').val(semproId);
                $('#ruangan').val(ruangan);
                $('#sesi').val(sesi);
                $('#tanggal_sempro').val(tanggalSempro);

                // Set initial selected values
                $('#pembimbing_satu').val(pembimbingSatuId);
                $('#pembimbing_dua').val(pembimbingDuaId);
                $('#penguji').val(pengujiId);

                // Update dropdown options based on selected values
                updateSelectOptions();
            });
        });
    </script>
@endsection
