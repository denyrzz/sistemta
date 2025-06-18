@extends('layouts.admin.template')

@section('content')
    <div class="container">
        <h1>Detail Bimbingan Tugas Akhir</h1>
        <h2>{{ $sempro->mahasiswa->nama }} - {{ $sempro->judul }}</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>File</th>
                    <th>Komentar</th>
                    <th>Validasi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sempro->bimbinganTA as $bimbingan)
                    <tr>
                        <td>{{ $bimbingan->tanggal }}</td>
                        <td>
                            @if ($bimbingan->dokumentasi)
                                <a href="{{ asset('storage/uploads/mahasiswa/bimbingan/dokumentasi/' . $bimbingan->dokumentasi) }}"
                                    target="_blank">Lihat</a>
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $bimbingan->komentar ?? '-' }}</td>
                        <td>{{ $bimbingan->validasi == '1' ? 'ACC' : 'Belum ACC' }}</td>
                        <td>
                            @if ($bimbingan->validasi == '0')
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#modalValidasi{{ $bimbingan->id_bimbingan }}">
                                    Validasi
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal untuk Validasi -->
    @foreach ($sempro->bimbinganTA as $bimbingan)
        <div class="modal fade" id="modalValidasi{{ $bimbingan->id_bimbingan }}" tabindex="-1"
            aria-labelledby="modalValidasiLabel{{ $bimbingan->id_bimbingan }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalValidasiLabel{{ $bimbingan->id_bimbingan }}">Validasi Bimbingan
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('dosen.bimbingan.update', $bimbingan->id_bimbingan) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="komentar{{ $bimbingan->id_bimbingan }}" class="form-label">Komentar</label>
                                <textarea class="form-control" id="komentar{{ $bimbingan->id_bimbingan }}" name="komentar" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Simpan Validasi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
