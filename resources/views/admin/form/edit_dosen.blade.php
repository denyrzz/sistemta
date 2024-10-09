@extends('layouts.admin.template')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Dosen</h5>
                        <form action="{{ route('dosen.update', $dosen->id_dosen) }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="nama_dosen">Nama Dosen</label>
                                <input type="text" name="nama_dosen" class="form-control"
                                    value="{{ $dosen->nama_dosen }}" required>
                            </div>

                            <div class="form-group">
                                <label for="nidn">NIDN</label>
                                <input type="text" name="nidn" class="form-control" value="{{ $dosen->nidn }}"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="nip">NIP</label>
                                <input type="text" name="nip" class="form-control" value="{{ $dosen->nip }}"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" class="form-control" required>
                                    <option value="Laki-Laki" {{ $dosen->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>
                                        Laki-Laki
                                    </option>
                                    <option value="Perempuan" {{ $dosen->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jurusan">Jurusan</label>
                                <select name="jurusan" class="form-control" required>
                                    @foreach ($jurusan as $j)
                                        <option value="{{ $j->id_jurusan }}"
                                            {{ $j->id_jurusan == $dosen->id_jurusan ? 'selected' : '' }}>
                                            {{ $j->jurusan }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="prodi">Prodi</label>
                                <select name="prodi" class="form-control" required>
                                    @foreach ($prodi as $p)
                                        <option value="{{ $p->id_prodi }}"
                                            {{ $p->id_prodi == $dosen->id_prodi ? 'selected' : '' }}>
                                            {{ $p->prodi }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $dosen->email }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label>Status</label>
                                <div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="statusAktif" value="1" {{ $dosen->status == 1 ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="statusAktif">
                                            Aktif
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="statusTidakAktif" value="0" {{ $dosen->status == 0 ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="statusTidakAktif">
                                            Tidak Aktif
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('dosen') }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                @endsection
