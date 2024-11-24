@extends('layouts.admin.template')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detail Dosen</h5>

                    <form class="form-sample">
                        <!-- Nama Dosen -->
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 col-form-label">Nama Dosen</label>
                            <div class="col-sm-8">
                                <label class="col-form-label">: {{ $data_dosen->nama_dosen }}</label>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <label class="col-form-label">: {{ $data_dosen->email }}</label>
                            </div>
                        </div>

                        <!-- NIDN -->
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 col-form-label">NIDN</label>
                            <div class="col-sm-8">
                                <label class="col-form-label">: {{ $data_dosen->nidn }}</label>
                            </div>
                        </div>

                        <!-- NIP -->
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 col-form-label">NIP</label>
                            <div class="col-sm-8">
                                <label class="col-form-label">: {{ $data_dosen->nip }}</label>
                            </div>
                        </div>

                        <!-- Gender -->
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 col-form-label">Gender</label>
                            <div class="col-sm-8">
                                <label class="col-form-label">: {{ $data_dosen->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</label>
                            </div>
                        </div>

                        <!-- Jurusan -->
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 col-form-label">Jurusan</label>
                            <div class="col-sm-8">
                                <label class="col-form-label">: {{ $data_dosen->jurusan->jurusan }}</label>
                            </div>
                        </div>

                        <!-- Prodi -->
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 col-form-label">Prodi</label>
                            <div class="col-sm-8">
                                <label class="col-form-label">: {{ $data_dosen->prodi->prodi }}</label>
                            </div>
                        </div>

                        <!-- Golongan -->
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 col-form-label">Golongan</label>
                            <div class="col-sm-8">
                                <label class="col-form-label">:
                                    @if ($data_dosen->golongan == 1)
                                        Assisten Ahli
                                    @elseif ($data_dosen->golongan == 2)
                                        Lector
                                    @elseif ($data_dosen->golongan == 3)
                                        Lector Kepala
                                    @else
                                        Guru Besar
                                    @endif
                                </label>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 col-form-label">Status</label>
                            <div class="col-sm-8">
                                <label class="col-form-label">: {{ $data_dosen->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</label>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 col-form-label">Password</label>
                            <div class="col-sm-8">
                                <label class="col-form-label">: ********</label> <!-- Hiding password for security -->
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- Gambar Dosen -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body text-center">
                    @if($data_dosen->image)
                        <img src="{{ asset('storage/uploads/dosen/image/' . $data_dosen->image) }}"
                             style="width: 200px; height: 250px; object-fit: cover; border: 2px solid black; padding: 5px;">
                    @else
                        <p>No image available</p>
                    @endif
                </div>

                <!-- Button Kembali -->
                <div class="card-footer text-end">
                    <a href="{{ route('dosen.index') }}" class="btn btn-success">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
