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

    <form action="{{ route('ruangan.update', $ruangan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="no_ruangan">No Ruangan</label>
            <input type="text" name="no_ruangan" class="form-control" value="{{ $ruangan->no_ruangan }}" required>
        </div>

        <div class="form-group">
            <label for="jam">Jam</label>
            <input type="time" name="jam" class="form-control" value="{{ $ruangan->jam }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
