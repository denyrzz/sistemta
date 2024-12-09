@extends('layouts.admin.template')

@section('content')
    <div class="container">
        <h2>Tambah Permission</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url ('permissions') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Nama Permission</label>
                <input type="text" name="name" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>

@endsection
