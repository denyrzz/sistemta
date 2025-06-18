<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Tugas Seminar Proposal</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 1cm;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            border: none;
        }

        .header-text {
            font-size: 14px;
            text-align: center;
        }

        .header-text h1 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
        }

        .header-text p {
            margin: 2px 0;
            text-align: center;
        }

        .header-logo {
            width: 80px;
            margin-right: 10px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            text-align: left;
            vertical-align: middle;
        }

        h2 {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin: 20px 0;
        }

        .signatures {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
            width: 100%;
        }

        .signature {
            text-align: right;
            margin-left: auto;
            margin-right: 0;
        }

        .signature-line {
            margin-top: 30px;
            border-top: 1px solid black;
            display: inline-block;
            width: 70%;
        }

        .student-info p {
            margin-left: 20px;
        }

        .smaller-row td,
        .smaller-row th {
            height: 25px;
        }

        .header-table td, .header-table th {
            border: none;
        }

        .smaller-row td, .smaller-row th {
            border: none;
            margin-left: 20px;
        }
    </style>
</head>

<body>
    <table class="header-table">
        <tr>
            <td style="width: 20%;">
                <img src="assets/images/logopnp.jpg" alt="Logo PNP" class="header-logo">
            </td>
            <td style="width: 80%;" class="header-text">
                <h1>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</h1>
                <h1>POLITEKNIK NEGERI PADANG</h1>
                <h1>JURUSAN TEKNOLOGI INFORMASI</h1>
                <p>Kampus Politeknik Negeri Padang, Limau Manis, Padang, Sumatera Barat</p>
                <p>Telepon: (0751) 72590, Faks: (0751) 72576</p>
                <p>Laman: https://ti.pnp.ac.id | Surel: ti@pnp.ac.id</p>
            </td>
        </tr>
    </table>

    <hr style="border: 1px solid black;">
    <h2>SURAT TUGAS</h2>
    <p style="text-align: center;">Nomor: 772/PL9.5/Sempro/{{ now()->format('Y') }}</p>

    <p>Yang bertanda tangan di bawah ini Ketua Program Studi Teknologi Rekayasa Perangkat Lunak menugaskan kepada:</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Jabatan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>{{ $pembimbingSatu }}</td>
                <td>{{ $nidn_pembimbingSatu ?? 'N/A' }}</td>
                <td>Dosen Pembimbing Satu</td>
            </tr>
            <tr>
                <td>2</td>
                <td>{{ $pembimbingDua }}</td>
                <td>{{ $nidn_pembimbingDua ?? 'N/A' }}</td>
                <td>Dosen Pembimbing Dua</td>
            </tr>
            <tr>
                <td>3</td>
                <td>{{ $penguji }}</td>
                <td>{{ $nidn_penguji ?? 'N/A' }}</td>
                <td>Dosen Penguji</td>
            </tr>
        </tbody>
    </table>

    <p>Untuk melaksanakan Seminar Proposal Mahasiswa yang disebut di bawah ini:</p>
    <table>
        <tr class="smaller-row">
            <th style="width: 130px">Nama</th>
            <td>: {{ $nama_mahasiswa ?? 'N/A' }}</td>
        </tr>
        <tr class="smaller-row">
            <th>Nim</th>
            <td>: {{ $nim ?? 'N/A' }}</td>
        </tr>
        <tr class="smaller-row">
            <th>Prodi</th>
            <td>: {{ $prodi ?? 'N/A' }}</td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>Tanggal Sempro</th>
                <th>Sesi</th>
                <th>Ruangan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $tanggal_sempro ? \Carbon\Carbon::parse($tanggal_sempro)->format('d F Y') : 'N/A' }}</td>
                <td>{{ $sesi ?? 'N/A' }}</td>
                <td>{{ $ruangan && $no_ruangan ? $ruangan . ' - ' . $no_ruangan : 'N/A' }}</td>
            </tr>
        </tbody>
    </table>

    <div class="signatures">
        <div class="signature">
            <p>Padang, {{ now()->format('d F Y') }}</p>
            <p>Ketua Prodi</p>
            <br><br><br>
            <div class="name">Meri Azmi, S.T, M.Cs</div>
            <p>NIP: 198106292006042001</p>
        </div>
    </div>

</body>

</html>
