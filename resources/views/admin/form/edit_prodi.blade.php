@extends('layouts.admin.template')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Program Studi</h5>

                    <form action="{{ route('prodi.update', $prodi->id_prodi) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="kode_prodi" class="form-label">Kode Prodi</label>
                            <input type="text" class="form-control" id="kode_prodi" name="kode_prodi" value="{{ $prodi->kode_prodi }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="prodi" class="form-label">Nama Prodi</label>
                            <input type="text" class="form-control" id="prodi" name="prodi" value="{{ $prodi->prodi }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="id_jurusan" class="form-label">Jurusan</label>
                            <select class="form-control" id="id_jurusan" name="id_jurusan" required>
                                @foreach($jurusan as $j)
                                    <option value="{{ $j->id_jurusan }}" {{ $j->id_jurusan == $prodi->id_jurusan ? 'selected' : '' }}>
                                        {{ $j->jurusan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jenjang" class="form-label">Jenjang</label>
                            <input type="text" class="form-control" id="jenjang" name="jenjang" value="{{ $prodi->jenjang }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
