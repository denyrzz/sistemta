@extends('layouts.admin.template')

@section('content')
<div class="container">
    <h1>Bimbingan Tugas Akhir</h1>
    <table class="table">
        <thead>
            <tr>
                <th>NO</th>
                <th>Nama Mahasiswa</th>
                <th>Judul Seminar Proposal</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bimbinganTA as $index => $bimbingan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $bimbingan->sempro->mahasiswa->nama }}</td>
                    <td>{{ $bimbingan->sempro->judul }}</td>
                    <td>
                        <a href="{{ route('dosen.bimbingan.show', $bimbingan->sempro_id) }}" class="btn btn-primary">Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
