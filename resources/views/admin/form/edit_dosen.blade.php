@extends('layouts.admin.template')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Dosen</h5>
                        <form action="{{ route('dosen.update', $dosen->id_dosen) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Nama Dosen -->
                            <div class="form-group">
                                <label for="nama_dosen">Nama Dosen</label>
                                <input type="text" name="nama_dosen" class="form-control" value="{{ old('nama_dosen', $dosen->nama_dosen) }}" required>
                            </div>

                            <!-- NIDN -->
                            <div class="form-group">
                                <label for="nidn">NIDN</label>
                                <input type="text" name="nidn" class="form-control" value="{{ old('nidn', $dosen->nidn) }}" required>
                            </div>

                            <!-- NIP -->
                            <div class="form-group">
                                <label for="nip">NIP</label>
                                <input type="text" name="nip" class="form-control" value="{{ old('nip', $dosen->nip) }}" required>
                            </div>

                            <!-- Gender -->
                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="laki-laki" name="jenis_kelamin"
                                        value="Laki-Laki" {{ old('jenis_kelamin', $dosen->jenis_kelamin) == 'Laki-Laki' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="laki-laki">Laki-Laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="perempuan" name="jenis_kelamin"
                                        value="Perempuan" {{ old('jenis_kelamin', $dosen->jenis_kelamin) == 'Perempuan' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="perempuan">Perempuan</label>
                                </div>
                            </div>

                            <!-- Jurusan -->
                            <div class="form-group">
                                <label for="jurusan">Jurusan</label>
                                <select name="jurusan_id" class="form-control" required>
                                    @foreach ($jurusan as $j)
                                        <option value="{{ $j->id_jurusan }}" {{ old('jurusan_id', $dosen->jurusan_id) == $j->id_jurusan ? 'selected' : '' }}>
                                            {{ $j->jurusan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Prodi -->
                            <div class="form-group">
                                <label for="prodi">Prodi</label>
                                <select name="prodi_id" class="form-control" required>
                                    @foreach ($prodi as $p)
                                        <option value="{{ $p->id_prodi }}" {{ old('prodi_id', $dosen->prodi_id) == $p->id_prodi ? 'selected' : '' }}>
                                            {{ $p->prodi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Golongan -->
                            <div class="form-group">
                                <label for="golongan">Golongan</label>
                                <select name="golongan" class="form-control" required>
                                    <option value="1" {{ old('golongan', $dosen->golongan) == 1 ? 'selected' : '' }}>Assisten Ahli</option>
                                    <option value="2" {{ old('golongan', $dosen->golongan) == 2 ? 'selected' : '' }}>Lector</option>
                                    <option value="3" {{ old('golongan', $dosen->golongan) == 3 ? 'selected' : '' }}>Lector Kepala</option>
                                    <option value="4" {{ old('golongan', $dosen->golongan) == 4 ? 'selected' : '' }}>Guru Besar</option>
                                </select>
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $dosen->email) }}" required>
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Leave blank if not changing">
                            </div>

                            <!-- Image -->
                            <div class="form-group">
                                <label for="image">Upload Image</label>
                                <input type="file" name="image" class="form-control">
                                @if ($dosen->image)
                                    <img src="{{ asset('images/dosen/' . $dosen->image) }}" alt="{{ $dosen->nama_dosen }}" class="img-thumbnail mt-2" width="150">
                                @endif
                            </div>

                            <!-- Status -->
                            <div class="mb-3">
                                <label>Status</label>
                                <div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="1" {{ old('status', $dosen->status) == 1 ? 'checked' : '' }} required>
                                        <label class="form-check-label">Aktif</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="0" {{ old('status', $dosen->status) == 0 ? 'checked' : '' }} required>
                                        <label class="form-check-label">Tidak Aktif</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit -->
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('dosen.index') }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
