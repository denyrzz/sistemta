@extends('layouts.admin.template')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
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
                        <li class="breadcrumb-item active" aria-current="page">Konfirmasi Usulan PKL</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Tabel Usulan PKL -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-0">
                    <div class="card-body">
                        <h4 class="card-title">Konfirmasi PKL</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Nama Perusahaan</th>
                                        <th>Konfirmasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usulanPkl as $index => $pkl)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $pkl->mahasiswa->nama }}</td>
                                            <td>{{ $pkl->perusahaan->nama_perusahaan }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $pkl->konfirmasi == '1' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $pkl->konfirmasi == '1' ? 'Sudah Dikonfirmasi' : 'Belum Dikonfirmasi' }}
                                                </span>
                                            </td>
                                            <td>
                                                <!-- Updated Confirmation Modal with Dosen Pembimbing Dropdown -->
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#confirmModal{{ $pkl->id_usulan_pkl }}">
                                                    Konfirmasi
                                                </button>
                                                <div class="modal fade" id="confirmModal{{ $pkl->id_usulan_pkl }}"
                                                    tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Konfirmasi Status dan Pilih
                                                                    Pembimbing</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form
                                                                action="{{ route('usulan_pkl.confirm', $pkl->id_usulan_pkl) }}"
                                                                method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <p>
                                                                        Apakah Anda yakin ingin
                                                                        {{ $pkl->konfirmasi == '1' ? 'membatalkan konfirmasi' : 'mengkonfirmasi' }}
                                                                        usulan ini?
                                                                    </p>

                                                                    <!-- Dosen Pembimbing Selection -->
                                                                    <div class="mb-3">
                                                                        <label
                                                                            for="dosenPembimbing{{ $pkl->id_usulan_pkl }}"
                                                                            class="form-label">Dosen Pembimbing</label>
                                                                        <select name="dosen_pembimbing"
                                                                            id="dosenPembimbing{{ $pkl->id_usulan_pkl }}"
                                                                            class="form-select" required>
                                                                            <option value="">Pilih Dosen Pembimbing
                                                                            </option>
                                                                            @foreach ($dosenList as $dosen)
                                                                                <option value="{{ $dosen->id_dosen }}">
                                                                                    {{ $dosen->nama_dosen }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-primary">
                                                                        {{ $pkl->konfirmasi == '1' ? 'Batalkan Konfirmasi' : 'Konfirmasi dan Tambah Pembimbing' }}
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-0">
                    <div class="card-body">
                        <h4 class="card-title">Dosen Pembimbing PKL</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Nama Perusahaan</th>
                                        <th>Tahun PKL</th>
                                        <th>Dosen Pembimbing</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mhsPklData as $index => $pkl)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $pkl->mahasiswa->nama ?? 'N/A' }}</td>
                                            <td>{{ $pkl->tempat->nama_perusahaan ?? 'N/A' }}</td>
                                            <td>{{ $pkl->tahun_pkl }}</td>
                                            <td>{{ $pkl->dosenpembimbing->nama_dosen ?? 'Belum Ditentukan' }}</td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editModal" data-id="{{ $pkl->id_pkl }}"
                                                    data-dospem="{{ $pkl->dosen_pembimbing }}">
                                                    Edit
                                                </button>

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

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Dosen Pembimbing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('usulan_pkl.updateDospem') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="id_pkl" id="modal-id-pkl">

                        <div class="mb-3">
                            <label for="dosenPembimbing" class="form-label">Dosen Pembimbing</label>
                            <select name="dosen_pembimbing" id="modal-dosen-pembimbing" class="form-select" required>
                                <option value="">Pilih Dosen Pembimbing</option>
                                @foreach ($dosenList as $dosen)
                                    <option value="{{ $dosen->id_dosen }}"
                                        {{ old('dosen_pembimbing') == $dosen->id_dosen ? 'selected' : '' }}>
                                        {{ $dosen->nama_dosen }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editModal = document.getElementById('editModal');
            editModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const idPkl = button.getAttribute('data-id'); // Get the id_pkl from the button
                const dosenPembimbing = button.getAttribute(
                'data-dospem'); // Get the dosen_pembimbing from the button

                // Debugging: Alerting values
                alert(`id_pkl: ${idPkl}, dosen_pembimbing: ${dosenPembimbing}`);

                // Set the value of the id_pkl hidden input field
                const modalIdPklInput = editModal.querySelector('#modal-id-pkl');
                modalIdPklInput.value = idPkl;

                // Set dosen_pembimbing on the dropdown
                const dosenSelect = editModal.querySelector('#modal-dosen-pembimbing');
                for (const option of dosenSelect.options) {
                    option.selected = option.value === dosenPembimbing;
                }
            });
        });
    </script>
@endsection
