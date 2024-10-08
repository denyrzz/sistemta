@extends('layouts.admin.template')

@section('content')
<div class="container-fluid">
    <h5 class="fw-semibold mb-4">Add Jabatan Pimpinan</h5>
    <form action="{{ route('jabatan_pimpinan') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="jabatan_pimpinan" class="form-label">Jabatan Pimpinan</label>
            <input type="text" class="form-control" id="jabatan_pimpinan" name="jabatan_pimpinan" required>
        </div>

        <div class="mb-3">
            <label for="kode_jabatan_pimpinan" class="form-label">Kode Jabatan</label>
            <input type="text" class="form-control" id="kode_jabatan_pimpinan" name="kode_jabatan_pimpinan" required>
        </div>
        <div class="mb-3">
            <label for="status_jabatan_pimpinan" class="form-label">Status</label>
            <select class="form-select" id="status_jabatan_pimpinan" name="status_jabatan_pimpinan" required>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('jabatan_pimpinan') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
