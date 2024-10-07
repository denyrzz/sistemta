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

            <div class="form-group">
                <label for="gender">Gender</label>
                <select name="gender" class="form-control" required>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
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

            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" name="status" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
