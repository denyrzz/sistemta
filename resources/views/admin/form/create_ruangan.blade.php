@extends('layouts.admin.template')

@section('content')
<div class="container">
    <h2>Tambah Ruangan</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ruangan') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_ruangan">Nama Ruangan</label>
            <input type="text" name="nama_ruangan" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="no_ruangan">No Ruangan</label>
            <input type="text" name="no_ruangan" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('ruangan') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
