@extends('layouts.admin.template')

@section('content')
<div class="container">
    <h2>Tambah Bimbingan</h2>

    <form action="{{ route('mhs_bimbingan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="sempro_id" value="{{ $semproId }}">

        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="keterangan">keterangan</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="dokumentasi">File</label>
            <input type="file" name="dokumentasi" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
</div>
@endsection
