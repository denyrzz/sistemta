@extends('layouts.admin.template')

@section('content')
<div class="container">
    <h2>Tambah Logbook</h2>

    <!-- Logbook Creation Form -->
    <form action="{{ route('mhs_logbook.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="pkl_id" value="{{ $pklId }}">

        <div class="form-group">
            <label for="tgl_awal">Tanggal Awal</label>
            <input type="date" name="tgl_awal" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="tgl_akhir">Tanggal Akhir</label>
            <input type="date" name="tgl_akhir" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="kegiatan">Kegiatan</label>
            <textarea name="kegiatan" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="dokumentasi">Dokumentasi</label>
            <input type="file" name="dokumentasi" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
</div>
@endsection
