@extends('layouts.admin.template')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <!-- Page Heading -->
                <h5 class="card-title mb-4">Tambah Sesi</h5>
                <div class="container-fluid">
                    <!-- Form Tambah Data -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0">Form Tambah Data</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('sesi.store') }}" method="POST"> <!-- Changed route -->
                                @csrf
                                <div class="form-group">
                                    <label for="sesi">Sesi</label>
                                    <input type="text" name="sesi" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="jam">Jam</label>
                                    <input type="text" name="jam" class="form-control" required>
                                </div>

                                    <button type="submit" class="btn btn-success">Simpan</button>
                                    <a href="{{ route('sesi.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
