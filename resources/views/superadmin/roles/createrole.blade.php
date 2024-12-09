@extends('layouts.admin.template')

@section('content')
    <div class="container">
        <h2>Tambah Role</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url ('roles') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="">Nama Roles</label>
                <input type="text" name="name" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
@endsection
