@extends('layouts.admin.template')

@section('content')
    <div class="container">
        <h2>Tambah Data Sempro</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('mhs_sempro.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Judul Sempro -->
            <div class="form-group">
                <label for="judul">Judul Sempro</label>
                <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}" required>
            </div>

            <!-- File Sempro -->
            <div class="form-group">
                <label for="file_sempro">File Sempro</label>
                <input type="file" name="file_sempro" id="file_sempro" class="form-control" accept=".pdf,.docx,.doc" required>
            </div>

            <!-- Status -->
            <div class="mb-3">
                <label class="form-label">Status</label>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="statusSudah" value="1"
                            {{ old('status') == '1' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="statusSudah">Sudah Dikonfirmasi</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="statusBelum" value="0"
                            {{ old('status') == '0' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="statusBelum">Belum Dikonfirmasi</label>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('sempro.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
