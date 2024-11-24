@extends('layouts.admin.template')

@section('content')
    <div class="container">
        <h2>Tambah Data Dosen</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('dosen.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nama Dosen -->
            <div class="form-group">
                <label for="nama_dosen">Nama Dosen</label>
                <input type="text" name="nama_dosen" id="nama_dosen" class="form-control" value="{{ old('nama_dosen') }}" required>
            </div>

            <!-- NIDN -->
            <div class="form-group">
                <label for="nidn">NIDN</label>
                <input type="text" name="nidn" id="nidn" class="form-control" value="{{ old('nidn') }}" required>
            </div>

            <!-- NIP -->
            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="text" name="nip" id="nip" class="form-control" value="{{ old('nip') }}" required>
            </div>

            <!-- Gender -->
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="LakiLaki" value="Laki-Laki"
                            {{ old('jenis_kelamin') == 'Laki-Laki' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="LakiLaki">Laki-Laki</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="Perempuan" value="Perempuan"
                            {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="Perempuan">Perempuan</label>
                    </div>
                </div>
            </div>

            <!-- Jurusan -->
            <div class="form-group">
                <label for="jurusan_id">Jurusan</label>
                <select name="jurusan_id" id="jurusan_id" class="form-control" required>
                    <option value="" disabled selected>Pilih Jurusan</option>
                    @foreach ($jurusan as $j)
                        <option value="{{ $j->id_jurusan }}" {{ old('jurusan_id') == $j->id_jurusan ? 'selected' : '' }}>
                            {{ $j->jurusan }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Prodi -->
            <div class="form-group">
                <label for="prodi_id">Prodi</label>
                <select name="prodi_id" id="prodi_id" class="form-control" required>
                    <option value="" disabled selected>Pilih Prodi</option>
                    @foreach ($prodi as $p)
                        <option value="{{ $p->id_prodi }}" {{ old('prodi_id') == $p->id_prodi ? 'selected' : '' }}>
                            {{ $p->prodi }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Golongan -->
            <div class="form-group">
                <label for="golongan">Golongan</label>
                <select name="golongan" id="golongan" class="form-control" required>
                    <option value="" disabled selected>Pilih Golongan</option>
                    <option value="1">Assisten Ahli</option>
                    <option value="2">Lector</option>
                    <option value="3">Lector Kepala</option>
                    <option value="4">Guru Besar</option>
                </select>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <!-- Password Confirmation -->
            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>

            <!-- Image Upload -->
            <div class="form-group">
                <label for="image">Upload Gambar Dosen</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
            </div>

            <!-- Status -->
            <div class="mb-3">
                <label class="form-label">Status</label>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="statusAktif" value="1"
                            {{ old('status') == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="statusAktif">Aktif</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="statusTidakAktif" value="0"
                            {{ old('status') == '0' ? 'checked' : '' }}>
                        <label class="form-check-label" for="statusTidakAktif">Tidak Aktif</label>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('dosen.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
