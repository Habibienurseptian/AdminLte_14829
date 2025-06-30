@extends('layouts.app')

@section('content_header')
    <h1>Riwayat Pasien</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">Riwayat Pemeriksaan</div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No.</th>
                    <th>Nama Dokter</th>
                    <th>Email Dokter</th>
                    <th>Tanggal Periksa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($riwayatPeriksa as $index => $periksa)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $periksa->dokter->name ?? '-' }}</td>
                        <td>{{ $periksa->dokter->email ?? '-' }}</td>
                        <td>{{ $periksa->tgl_periksa->format('d-m-Y') }}</td>
                        <td>
                            <a href="{{ route('pasien.riwayat.show', $periksa->id) }}" class="btn btn-sm btn-info">
                                Detail
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
