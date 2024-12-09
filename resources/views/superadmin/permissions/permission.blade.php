@extends('layouts.admin.template')

@section('content')
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <!-- Breadcrumb -->
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 d-flex align-items-center">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/dashboard') }}" class="link">
                                <i class="mdi mdi-home-outline fs-4"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Permissions</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="card-title">Tabel Permission</h4>
                            <div class="d-flex">
                                <a href="{{ url('permissions/create') }}" class="btn btn-primary text-white me-2"></i> Tambah
                                    Permission
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="roleTable" width="100%" cellspacing="0">
                                <thead class="table">
                                    <tr>
                                        <th>No</th>
                                        <th>Permissions</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $index => $data)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>
                                                <a href="{{ url('permissions/'.$data->id.'/edit') }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <a href="{{ url('permissions/'.$data->id.'/delete') }}"
                                                    class="btn btn-danger btn-sm">Delete</a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
