@extends('layouts.admin.template')

@section('content')
<div class="container-fluid">
    <h5 class="fw-semibold mb-4">Tambah Jabatan Pimpinan</h5>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jabatan_pimpinan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="jabatan_pimpinan" class="form-label">Jabatan Pimpinan</label>
            <input type="text" class="form-control" id="jabatan_pimpinan" name="jabatan_pimpinan" value="{{ old('jabatan_pimpinan') }}" required>
        </div>

        <div class="mb-3">
            <label for="kode_jabatan" class="form-label">Kode Jabatan</label>
            <input type="text" class="form-control" id="kode_jabatan" name="kode_jabatan" value="{{ old('kode_jabatan_pimpinan') }}" required>
        </div>

        <div class="mb-3">
            <label for="status_jabatan" class="form-label">Status</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status_jabatan" id="status_active" value="1" {{ old('status_jabatan_pimpinan') == '1' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="status_active">Aktif</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status_jabatan" id="status_inactive" value="0" {{ old('status_jabatan_pimpinan') == '0' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="status_inactive">Tidak Aktif</label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('jabatan_pimpinan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
