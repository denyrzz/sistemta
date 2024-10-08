@extends('layouts.admin.template')

@section('content')
<div class="container-fluid">
    <h5 class="fw-semibold mb-4">Add Pimpinan</h5>

    <form action="{{ route('pimpinan') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="dosen_id" class="form-label">Dosen</label>
            <select name="dosen_id" class="form-select" required>
                <option value="">Pilih Dosen</option>
                @foreach ($dosens as $dosen)
                    <option value="{{ $dosen->id_dosen }}">{{ $dosen->nama_dosen }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="jabatan_pimpinan_id" class="form-label">Jabatan Pimpinan</label>
            <select name="jabatan_pimpinan_id" class="form-select" required>
                <option value="">Pilih Jabatan Pimpinan</option>
                @foreach ($jabatanPimpinans as $jabatan)
                    <option value="{{ $jabatan->id_jabatan_pimpinan }}">{{ $jabatan->jabatan_pimpinan }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="periode" class="form-label">Periode</label>
            <input type="text" name="periode" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="status_pimpinan" class="form-label">Status</label>
            <select name="status_pimpinan" class="form-select" required>
                <option value="1">Aktif</option>
                <option value="0">Tidak Aktif</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
