@extends('layouts.admin.template')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Jurusan</h5>

                    <form action="{{ route('jurusan.update', $jurusan->id_jurusan) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Add this line for method spoofing -->

                        <div class="mb-3">
                            <label for="kode_jurusan" class="form-label">Kode Jurusan</label>
                            <input type="text" class="form-control" id="kode_jurusan" name="kode_jurusan"
                                value="{{ old('kode_jurusan', $jurusan->kode_jurusan) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Nama Jurusan</label>
                            <input type="text" class="form-control" id="jurusan" name="jurusan"
                                value="{{ old('jurusan', $jurusan->jurusan) }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('jurusan.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
