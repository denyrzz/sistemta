@extends('layouts.admin.template')
@section('content')
<div class="container-fluid">
    <h2 class="fw-semibold mb-4">Tambah Pimpinan</h2>

    <form action="{{ route('pimpinan.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="dosen_id" id="dosen_id" class="form-label">Dosen</label>
            <select name="dosen_id" class="form-select" required>
                <option value="" selected disabled>Pilih Dosen</option>
                @foreach ($dosens as $d)
                    <option value="{{ $d->id_dosen }}">{{ $d->nama_dosen }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jabatan_id" class="form-label">Jabatan</label>
            <select name="jabatan_id" class="form-select" required>
                <option value="" selected disabled>Pilih Jabatan</option>
                @foreach ($jabatanPimpinans as $j)
                    <option value="{{ $j->id_jabatan }}">{{ $j->jabatan_pimpinan }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="periode" class="form-label">Periode</label>
            <input type="text" name="periode" class="form-control" value="{{ old('periode') }}" placeholder="Periode" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status_pimpinan" id="statusAktif" value="1"
                        {{ old('status') == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="statusAktif">Aktif</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status_pimpinan" id="statusTidakAktif" value="0"
                        {{ old('status') == '0' ? 'checked' : '' }}>
                    <label class="form-check-label" for="statusTidakAktif">Tidak Aktif</label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Tambah</button>
        <a href="{{ route('pimpinan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
