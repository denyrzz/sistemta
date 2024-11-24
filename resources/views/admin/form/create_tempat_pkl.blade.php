@extends('layouts.admin.template')

@section('content')
<div class="container">
    <h2>Tambah Tempat PKL</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tempat_pkl.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_perusahaan">Nama Perusahaan</label>
            <input type="text" name="nama_perusahaan" class="form-control" value="{{ old('nama_perusahaan') }}" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" class="form-control" required>{{ old('alamat') }}</textarea>
        </div>
        <div class="form-group">
            <label for="kontak">Kontak</label>
            <input type="text" name="kontak" class="form-control" value="{{ old('kontak') }}">
        </div>
        <div class="form-group">
            <label>Status</label>
            <div class="form-check">
                <input type="radio" name="status" id="status0" value="0" class="form-check-input" {{ old('status') == '0' ? 'checked' : '' }} required>
                <label for="status0" class="form-check-label">Tidak Aktif</label>
            </div>
            <div class="form-check">
                <input type="radio" name="status" id="status1" value="1" class="form-check-input" {{ old('status') == '1' ? 'checked' : '' }}>
                <label for="status1" class="form-check-label">Aktif</label>
            </div>
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('tempat_pkl.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
