@extends('layouts.admin.template')

@section('content')
<div class="container">
    <h2>Edit Pengajuan PKL</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pengajuan_pkl.update', $pengajuanPkl->id_pengajuan) }}" method="POST">
        @csrf
        @method('PUT') <!-- Include this to set the request method to PUT -->

        <div class="form-group">
            <label for="mahasiswa_id">Mahasiswa</label>
            <select name="mahasiswa_id" class="form-control" required>
                <option value="" disabled>Pilih Mahasiswa</option>
                @foreach($mahasiswa as $mhs)
                    <option value="{{ $mhs->id_mahasiswa }}" {{ $mhs->id_mahasiswa == $pengajuanPkl->mahasiswa_id ? 'selected' : '' }}>
                        {{ $mhs->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nama_perusahaan">Nama Perusahaan</label>
            <input type="text" name="nama_perusahaan" class="form-control" value="{{ old('nama_perusahaan', $pengajuanPkl->nama_perusahaan) }}" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" class="form-control" required>{{ old('alamat', $pengajuanPkl->alamat) }}</textarea>
        </div>
        <div class="form-group">
            <label for="kontak">Kontak</label>
            <input type="text" name="kontak" class="form-control" value="{{ old('kontak', $pengajuanPkl->kontak) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pengajuan_pkl.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
