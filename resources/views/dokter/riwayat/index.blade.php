@extends('layouts.app')

@section('content_header')
    <h1>Riwayat Pemeriksaan</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>No.</th>
                    <th>Dokter</th>
                    <th>Tanggal</th>
                    <th>Keluhan</th>
                    <th>Obat</th>
                    <th>Biaya</th>
                </tr>
            </thead>
            <tbody>
                @foreach($listPeriksa as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->dokter->name }}</td>
                    <td>{{ $item->tgl_periksa->format('d-m-Y') }}</td>
                    <td>{{ $item->keluhan }}</td>
                    <td>
                        @foreach($item->obats as $obat)
                            <span class="badge bg-primary">{{ $obat->nama_obat }}</span>
                        @endforeach
                    </td>
                    <td>Rp {{ number_format($item->biaya_periksa, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
