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
                        @method('PUT')

                        <div class="mb-3">
                            <label for="kode_prodi" class="form-label">Kode Prodi</label>
                            <input type="text" class="form-control" id="kode_prodi" name="kode_prodi" value="{{ old('kode_prodi', $prodi->kode_prodi) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="prodi" class="form-label">Nama Prodi</label>
                            <input type="text" class="form-control" id="prodi" name="prodi" value="{{ old('prodi', $prodi->prodi) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="jurusan_id" class="form-label">Jurusan</label>
                            <select class="form-control" id="jurusan_id" name="jurusan_id" required>
                                @foreach($jurusan as $j)
                                    <option value="{{ $j->id_jurusan }}" {{ $j->id_jurusan == $prodi->jurusan_id ? 'selected' : '' }}>
                                        {{ $j->jurusan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jenjang" class="form-label">Jenjang</label>
                            <select class="form-control" id="jenjang" name="jenjang" required>
                                <option value="D2" {{ $prodi->jenjang == 'D2' ? 'selected' : '' }}>D2</option>
                                <option value="D3" {{ $prodi->jenjang == 'D3' ? 'selected' : '' }}>D3</option>
                                <option value="D4" {{ $prodi->jenjang == 'D4' ? 'selected' : '' }}>D4</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('prodi.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
