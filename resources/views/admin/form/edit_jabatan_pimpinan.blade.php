@extends('layouts.admin.template')

@section('content')
<div class="container-fluid">
    <h5 class="fw-semibold mb-4">Edit Jabatan Pimpinan</h5>
    <form action="{{ route('jabatan_pimpinan.update', $jabatan->id_jabatan_pimpinan) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="jabatan_pimpinan" class="form-label">Jabatan Pimpinan</label>
            <input type="text" class="form-control" id="jabatan_pimpinan" name="jabatan_pimpinan" value="{{ $jabatan->jabatan_pimpinan }}" required>
        </div>
        <div class="mb-3">
            <label for="kode_jabatan_pimpinan" class="form-label">Kode Jabatan</label>
            <input type="text" class="form-control" id="kode_jabatan_pimpinan" name="kode_jabatan_pimpinan" value="{{ $jabatan->kode_jabatan_pimpinan }}" required>
        </div>
        <div class="mb-3">
            <label for="status_jabatan_pimpinan" class="form-label">Status</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status_jabatan_pimpinan" id="status_active" value="1"
                    {{ $jabatan->status_jabatan_pimpinan == '1' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="status_active">Aktif</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status_jabatan_pimpinan" id="status_inactive" value="0"
                    {{ $jabatan->status_jabatan_pimpinan == '0' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="status_inactive">Tidak Aktif</label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('jabatan_pimpinan') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
