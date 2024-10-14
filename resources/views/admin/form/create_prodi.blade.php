@extends('layouts.admin.template')

@section('content')
<div class="container">
    <h2>Tambah Data Prodi</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('prodi') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="kode_prodi" class="form-label">Kode Prodi</label>
            <input type="text" class="form-control" id="kode_prodi" name="kode_prodi" value="{{ old('kode_prodi') }}" required>
        </div>

        <div class="mb-3">
            <label for="prodi" class="form-label">Nama Prodi</label>
            <input type="text" class="form-control" id="prodi" name="prodi" value="{{ old('prodi') }}" required>
        </div>

        <div class="mb-3">
            <label for="id_jurusan" class="form-label">Jurusan</label>
            <select class="form-control" id="id_jurusan" name="id_jurusan" required>
                <option value="">-- Pilih Jurusan --</option>
                @foreach($jurusan as $item)
                    <option value="{{ $item->id_jurusan }}" {{ old('id_jurusan') == $item->id_jurusan ? 'selected' : '' }}>
                        {{ $item->jurusan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jenjang" class="form-label">Jenjang</label>
            <input type="text" class="form-control" id="jenjang" name="jenjang" value="{{ old('jenjang') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('prodi') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
