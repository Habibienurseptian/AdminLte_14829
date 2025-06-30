@extends('layouts.app')

@section('content_header')
    <h1>Detail Riwayat Pemeriksaan</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">Detail Pemeriksaan #{{ $periksa->id }}</div>
    <div class="card-body">
        <p><strong>Dokter:</strong> {{ $periksa->dokter->name ?? '-' }}</p>
        <p><strong>Poli:</strong> {{ $periksa->dokter->dokter->poli->nama ?? '-' }}</p>
        <p><strong>Tanggal Periksa:</strong> {{ $periksa->tgl_periksa->format('d-m-Y') }}</p>
        <p><strong>Catatan:</strong> {{ $periksa->catatan }}</p>
        <p><strong>Biaya Periksa:</strong> Rp {{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</p>

        <h5>Obat yang Diberikan:</h5>
        <ul>
            @forelse($periksa->obats as $obat)
                <li>{{ $obat->nama_obat }}</li>
            @empty
                <li>Tidak ada obat</li>
            @endforelse
        </ul>

        <a href="{{ route('pasien.riwayat') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>
@endsection
