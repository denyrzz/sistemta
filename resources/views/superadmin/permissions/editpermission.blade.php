@extends('layouts.admin.template')

@section('content')
    <div class="container">
        <h2>Edit Permissions</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('permissions/'.$permission->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nama Permission</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $permission->name) }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
