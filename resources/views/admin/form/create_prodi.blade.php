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

    <form action="{{ route('prodi.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="kode_prodi" class="form-label">Kode Prodi</label>
            <input type="text" class="form-control" id="kode_prodi" name="kode_prodi" required>
        </div>

        <div class="mb-3">
            <label for="prodi" class="form-label">Nama Prodi</label>
            <input type="text" class="form-control" id="prodi" name="prodi" required>
        </div>

        <div class="mb-3">
            <label for="jurusan_id" class="form-label">Jurusan</label>
            <select class="form-control" id="jurusan_id" name="jurusan_id" required>
                <option value="">-- Pilih Jurusan --</option>
                @foreach($jurusan as $item)
                    <option value="{{ $item->id_jurusan }}">
                        {{ $item->jurusan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jenjang" class="form-label">Jenjang</label>
            <select class="form-control" id="jenjang" name="jenjang" required>
                <option value="">-- Pilih Jenjang --</option>
                <option value="D2">D2</option>
                <option value="D3">D3</option>
                <option value="D4">D4</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('prodi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
