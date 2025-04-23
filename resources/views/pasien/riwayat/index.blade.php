@extends('layouts.app')

@section('content_header')
    <h1>Riwayat Pasien</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">Riwayat Pemeriksaan</div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">ID Periksa</th>
                    <th scope="col">Dokter</th>
                    <th scope="col">Tanggal Periksa</th>
                    <th scope="col">Catatan</th>
                    <th scope="col">Obat</th>
                    <th scope="col">Biaya Periksa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($riwayatPeriksa as $index => $periksa)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $periksa->id }}</td>
                        <td>{{ $periksa->dokter->name }}</td>
                        <td>{{ $periksa->tgl_periksa->format('d-m-Y') }}</td>
                        <td>{{ $periksa->catatan }}</td>
                        <td>
                            <!-- Obat dapat diambil dari relasi lain jika ada, misalnya tabel obat -->
                            @foreach($periksa->obats as $obat)
                                <li>{{ $obat->nama_obat }}</li>
                            @endforeach
                        </td>
                        <td>{{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
