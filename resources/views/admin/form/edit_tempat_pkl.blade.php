@extends('layouts.admin.template')

@section('content')
<div class="container">
    <h2>Edit Tempat PKL</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tempat_pkl.update', $tempatPkl->id_perusahaan) }}" method="POST">
        @csrf
        @method('PUT') <!-- This line is important for PUT request -->

        <div class="form-group">
            <label for="nama_perusahaan">Nama Perusahaan</label>
            <input type="text" name="nama_perusahaan" class="form-control" value="{{ old('nama_perusahaan', $tempatPkl->nama_perusahaan) }}" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" class="form-control" required>{{ old('alamat', $tempatPkl->alamat) }}</textarea>
        </div>
        <div class="form-group">
            <label for="kontak">Kontak</label>
            <input type="text" name="kontak" class="form-control" value="{{ old('kontak', $tempatPkl->kontak) }}">
        </div>
        <div class="form-group">
            <label>Status</label>
            <div class="form-check">
                <input type="radio" name="status" id="status0" value="0" class="form-check-input" {{ old('status', $tempatPkl->status) == '0' ? 'checked' : '' }} required>
                <label for="status0" class="form-check-label">Tidak Aktif</label>
            </div>
            <div class="form-check">
                <input type="radio" name="status" id="status1" value="1" class="form-check-input" {{ old('status', $tempatPkl->status) == '1' ? 'checked' : '' }}>
                <label for="status1" class="form-check-label">Aktif</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('tempat_pkl.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
