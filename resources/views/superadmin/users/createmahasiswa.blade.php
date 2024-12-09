@extends('layouts.admin.template')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h5 class="card-title fw-semibold mb-4">Tambah Data Mahasiswa</h5>
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form action="{{ route('users.storeMhs') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="nim" class="form-label">NIM</label>
                                    <input type="text" class="form-control" id="nim" name="nim" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="mb-3">
                                    <label for="prodi_id" class="form-label">Program Studi</label>
                                    <select class="form-select" id="prodi_id" name="prodi_id" required>
                                        <option selected disabled>Pilih Program Studi</option>
                                        @foreach ($prodi as $item)
                                            <option value="{{ $item->id_prodi }}">{{ $item->prodi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jenis Kelamin</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="laki-laki" name="jenis_kelamin" value="Laki-Laki" required>
                                        <label class="form-check-label" for="laki-laki">Laki-Laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan" required>
                                        <label class="form-check-label" for="perempuan">Perempuan</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Upload Foto</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
