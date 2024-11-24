@extends('layouts.admin.template')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Detail Mahasiswa PKL</h5>

                <!-- Form action updated with correct route and method -->
                <form class="form-sample" method="POST" enctype="multipart/form-data"
                    action="{{ route('mhs_pkl.update', $data_pkl->id_pkl) }}">
                    @csrf
                    @method('PUT')

                    <!-- Nama Mahasiswa -->
                    <div class="form-group row mb-3">
                        <label class="col-sm-4 col-form-label">Nama Mahasiswa</label>
                        <div class="col-sm-8">
                            <label class="col-form-label">: {{ $data_pkl->mahasiswa->nama }}</label>
                        </div>
                    </div>

                    <!-- NIM -->
                    <div class="form-group row mb-3">
                        <label class="col-sm-4 col-form-label">NIM</label>
                        <div class="col-sm-8">
                            <label class="col-form-label">: {{ $data_pkl->mahasiswa->nim }}</label>
                        </div>
                    </div>

                    <!-- Tempat PKL -->
                    <div class="form-group row mb-3">
                        <label class="col-sm-4 col-form-label">Tempat PKL</label>
                        <div class="col-sm-8">
                            <label class="col-form-label">: {{ $data_pkl->tempat->nama_perusahaan ?? 'N/A' }}</label>
                        </div>
                    </div>

                    <!-- Tahun PKL -->
                    <div class="form-group row mb-3">
                        <label class="col-sm-4 col-form-label">Tahun PKL</label>
                        <div class="col-sm-8">
                            <label class="col-form-label">: {{ $data_pkl->tahun_pkl ?? 'N/A' }}</label>
                        </div>
                    </div>

                    <!-- Dosen Pembimbing -->
                    <div class="form-group row mb-3">
                        <label class="col-sm-4 col-form-label">Dosen Pembimbing</label>
                        <div class="col-sm-8">
                            <label class="col-form-label">: {{ $data_pkl->dosenPembimbing->nama_dosen ?? 'N/A' }}</label>
                        </div>
                    </div>

                    <!-- Judul -->
                    <div class="form-group row mb-3">
                        <label class="col-sm-4 col-form-label">Judul</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="judul"
                                value="{{ old('judul', $data_pkl->judul) }}" placeholder="Masukkan Judul">
                        </div>
                    </div>

                    <!-- Pembimbing Industri -->
                    <div class="form-group row mb-3">
                        <label class="col-sm-4 col-form-label">Pembimbing Industri</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="pembimbing_industri"
                                value="{{ old('pembimbing_industri', $data_pkl->pembimbing_industri) }}"
                                placeholder="Masukkan Nama Pembimbing Industri">
                        </div>
                    </div>

                    <!-- Nilai Pembimbing Industri -->
                    <div class="form-group row mb-3">
                        <label class="col-sm-4 col-form-label">Nilai Pembimbing Industri</label>
                        <div class="col-sm-8">
                            <input type="numeric" class="form-control" name="nilai_pembimbing_industri"
                                value="{{ old('nilai_pembimbing_industri', $data_pkl->nilai_pembimbing_industri) }}"
                                placeholder="Masukkan Nilai Pembimbing Industri">
                        </div>
                    </div>

                    <!-- Upload Dokumen Nilai Industri -->
                    <div class="form-group row mb-3">
                        <label class="col-sm-4 col-form-label" style="font-size: 15px;">Dokumen
                            Nilai Industri</label>
                        <div class="col-sm-8">
                            <input type="file" name="dokument_nilai_industri" class="form-control"
                                id="dokument_nilai_industri">
                            @if (isset($data_pkl->dokument_nilai_industri))
                                <p class="mt-2">Current file: <a
                                        href="{{ asset('storage/uploads/mahasiswa/dokument_nilai_industri/' . $data_pkl->dokument_nilai_industri) }}"
                                        target="_blank">{{ $data_pkl->dokument_nilai_industri }}</a></p>
                            @endif
                        </div>
                    </div>

                    <!-- Upload Dokumentasi PKL -->
                    <div class="form-group row mb-3">
                        <label class="col-sm-4 col-form-label" style="font-size: 15px;">Dokument PKL</label>
                        <div class="col-sm-8">
                            <input type="file" name="dokument_pkl" class="form-control" id="dokument_pkl">
                            @if (isset($data_pkl->dokument_pkl))
                                <p class="mt-2">Current file: <a
                                        href="{{ asset('storage/uploads/mahasiswa/dokument_pkl/' . $data_pkl->dokument_pkl) }}"
                                        target="_blank">{{ $data_pkl->dokument_pkl }}</a></p>
                            @endif
                        </div>
                    </div>

                    <!-- Upload Revisi Dokumentasi PKL -->
                    <div class="form-group row mb-3">
                        <label class="col-sm-4 col-form-label" style="font-size: 15px;">Dokumen PKL Revisi</label>
                        <div class="col-sm-8">
                            <input type="file" name="dokument_pkl_revisi" class="form-control" id="dokument_pkl_revisi">
                            @if (isset($data_pkl->dokument_pkl_revisi))
                                <p class="mt-2">Current file: <a
                                        href="{{ asset('storage/uploads/mahasiswa/dokument_pkl_revisi/' . $data_pkl->dokument_pkl_revisi) }}"
                                        target="_blank">{{ $data_pkl->dokument_pkl_revisi }}</a></p>
                            @endif
                        </div>
                    </div>

                    <!-- Update Button -->
                    <div class="form-group row mb-3">
                        <div class="col-sm-8 offset-sm-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection