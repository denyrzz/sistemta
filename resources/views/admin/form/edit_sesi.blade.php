@extends('layouts.admin.template')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <!-- Page Heading -->
                <h5 class="card-title mb-4">Edit Sesi</h5>

                <!-- Form Edit Data Sesi -->
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0">Form Edit Data</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('sesi.update', $sesi->id_sesi) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="sesi">Sesi</label>
                                    <input type="text" name="sesi" class="form-control" value="{{ $sesi->sesi }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="jam">Jam</label>
                                    <input type="text" name="jam" class="form-control" value="{{ $sesi->jam }}" required>
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
