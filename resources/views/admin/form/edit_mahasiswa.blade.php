@extends('layouts.admin.template')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Edit Data Mahasiswa</h5>
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form action="{{ route('mahasiswa.update', $mahasiswa->id_mahasiswa) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="nim" class="form-label">NIM</label>
                                    <input type="text" class="form-control" id="nim" name="nim"
                                        value="{{ $mahasiswa->nim }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="{{ $mahasiswa->nama }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="prodi_id" class="form-label">Program Studi</label>
                                    <select class="form-select" id="prodi_id" name="prodi_id" required>
                                        <option disabled>Select Program Studi</option>
                                        @foreach ($prodi as $program)
                                            <option value="{{ $program->id_prodi }}"
                                                {{ $mahasiswa->prodi_id == $program->id_prodi ? 'selected' : '' }}>
                                                {{ $program->prodi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Jenis Kelamin</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="laki-laki" name="jenis_kelamin"
                                            value="Laki-Laki"
                                            {{ $mahasiswa->jenis_kelamin == 'Laki-Laki' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="laki-laki">Laki-Laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="perempuan" name="jenis_kelamin"
                                            value="Perempuan"
                                            {{ $mahasiswa->jenis_kelamin == 'Perempuan' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="perempuan">Perempuan</label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $mahasiswa->email }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password (Leave blank to keep current password)</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Upload Photo</label>
                                    <input type="file" class="form-control" id="image" name="image"
                                        accept="image/*">
                                    @if ($mahasiswa->image)
                                        <div class="mt-2">
                                            <img src="{{ asset('images/mahasiswa/' . $mahasiswa->image) }}" alt="Photo"
                                                width="100">
                                        </div>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
