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
        <form action="{{ route('dosen') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama_dosen">Nama Dosen</label>
                <input type="text" name="nama_dosen" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="nidn">NIDN</label>
                <input type="text" name="nidn" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="text" name="nip" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Gender</label>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="genderLakiLaki" value="Laki-Laki" required>
                        <label class="form-check-label" for="genderLakiLaki">
                            Laki-Laki
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="genderPerempuan" value="Perempuan" required>
                        <label class="form-check-label" for="genderPerempuan">
                            Perempuan
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <select name="jurusan" class="form-control" required>
                    @foreach ($jurusan as $j)
                        <option value="{{ $j->id_jurusan }}">{{ $j->jurusan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="prodi">Prodi</label>
                <select name="prodi" class="form-control" required>
                    @foreach ($prodi as $p)
                        <option value="{{ $p->id_prodi }}">{{ $p->prodi }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="statusAktif" value="1" checked>
                        <label class="form-check-label" for="statusAktif">
                            Aktif
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="statusTidakAktif" value="0">
                        <label class="form-check-label" for="statusTidakAktif">
                            Tidak Aktif
                        </label>
                    </div>
                </div>
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
