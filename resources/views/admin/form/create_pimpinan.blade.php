@extends('layouts.admin.template')

@section('content')
<div class="container-fluid">
    <h2 class="fw-semibold mb-4">Tambah Logbook</h2>

    <!-- Logbook Creation Form -->
    <form action="{{ route('mhs_logbook.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="pkl_id" value="{{ $pklId }}">

        <div class="mb-3">
            <label for="tgl_awal" class="form-label">Tanggal Awal</label>
            <input type="date" name="tgl_awal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tgl_akhir" class="form-label">Tanggal Akhir</label>
            <input type="date" name="tgl_akhir" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="kegiatan" class="form-label">Kegiatan</label>
            <textarea name="kegiatan" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="dokumentasi" class="form-label">Dokumentasi (Opsional)</label>
            <input type="file" name="dokumentasi" class="form-control-file">
        </div>

        <div class="mb-3">
            <label for="komentar" class="form-label">Komentar</label>
            <textarea name="komentar" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="validasi" class="form-label">Validasi</label>
            <select name="validasi" class="form-select" required>
                <option value="0">Belum Validasi</option>
                <option value="1">Tervalidasi</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Tambah</button>
        <a href="{{ route('mhs_logbook.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
