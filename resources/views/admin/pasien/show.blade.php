@extends('layouts.app')

@section('content_header')
    <h1 class="text-dark">Detail Pasien</h1>
@stop

@section('content')
<div class="container">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Informasi Detail Pasien</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('pasien.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

            <table class="table table-bordered">
                <tr>
                    <th>Nama Lengkap</th>
                    <td>{{ $pasien->user->name ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $pasien->user->email ?? '-' }}</td>
                </tr>
                <tr>
                    <th>No RM</th>
                    <td>{{ $pasien->no_rm ?? '-' }}</td>
                </tr>
                <tr>
                    <th>No KTP</th>
                    <td>{{ $pasien->no_ktp ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $pasien->alamat ?? '-' }}</td>
                </tr>
                <tr>
                    <th>No HP</th>
                    <td>{{ $pasien->no_hp ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Registrasi</th>
                    <td>{{ $pasien->created_at->format('d-m-Y') }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
