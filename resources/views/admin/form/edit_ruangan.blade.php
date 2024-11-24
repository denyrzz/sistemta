@extends('layouts.admin.template')

@section('content')
<div class="container">
    <h2>Edit Ruangan</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ruangan.update', $ruangan->id_ruangan) }}" method="POST">
        @csrf
        @method('PUT') <!-- Include this to set the request method to PUT -->

        <div class="form-group">
            <label for="nama_ruangan">Nama Ruangan</label>
            <input type="text" name="nama_ruangan" class="form-control" value="{{ old('nama_ruangan', $ruangan->nama_ruangan) }}" required>
        </div>
        <div class="form-group">
            <label for="no_ruangan">No Ruangan</label>
            <input type="text" name="no_ruangan" class="form-control" value="{{ old('no_ruangan', $ruangan->no_ruangan) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('ruangan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
