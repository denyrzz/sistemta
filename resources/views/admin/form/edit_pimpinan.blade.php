@extends('layouts.admin.template')

@section('content')
<div class="container-fluid">
    <h5 class="fw-semibold mb-4">Edit Pimpinan</h5>

    <form action="{{ route('pimpinan.update', $pimpinan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="dosen_id" class="form-label">Dosen</label>
            <select name="dosen_id" class="form-select" required>
                <option value="">Pilih Dosen</option>
                @foreach ($dosens as $dosen)
                    <option value="{{ $dosen->id_dosen }}" {{ $dosen->id_dosen == $pimpinan->dosen_id ? 'selected' : '' }}>{{ $dosen->nama_dosen }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="jabatan_id" class="form-label">Jabatan Pimpinan</label>
            <select name="jabatan_id" class="form-select" required>
                <option value="">Pilih Jabatan Pimpinan</option>
                @foreach ($jabatanPimpinans as $jabatan)
                    <option value="{{ $jabatan->id_jabatan }}" {{ $jabatan->id_jabatan == $pimpinan->jabatan_id ? 'selected' : '' }}>{{ $jabatan->jabatan_pimpinan }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="periode" class="form-label">Periode</label>
            <input type="text" name="periode" class="form-control" value="{{ $pimpinan->periode }}" required>
        </div>
        <div class="mb-3">
            <label for="status_pimpinan" class="form-label">Status</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status_pimpinan" id="status_aktif" value="1"
                    {{ $pimpinan->status_pimpinan == '1' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="status_aktif">Aktif</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status_pimpinan" id="status_tidak_aktif" value="0"
                    {{ $pimpinan->status_pimpinan == '0' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="status_tidak_aktif">Tidak Aktif</label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pimpinan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
