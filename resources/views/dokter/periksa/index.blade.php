@extends('layouts.app')

@section('content_header')
    <h1>Dokter</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">Pasien Periksa</div>
    <div class="card-body">
        <table class="table">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">ID Periksa</th>
                <th scope="col">Pasien</th>
                <th scope="col">Tanggal Periksa</th>
                <th scope="col">Catatan</th>
                <th scope="col">Obat</th> {{-- Tambahan --}}
                <th scope="col">Biaya Periksa</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($listPeriksa as $index => $periksa)
            <tr>
                <th>{{ $index + 1 }}</th>
                <td>{{ $periksa->id }}</td>
                <td>{{ $periksa->pasien->name }}</td>
                <td>{{ $periksa->tgl_periksa->format('d-m-Y') }}</td>
                <td>{{ $periksa->catatan }}</td>
                <td>
                    @foreach($periksa->obats as $obat)
                        <span class="badge bg-info">{{ $obat->nama_obat }}</span>
                    @endforeach
                </td>
                <td>{{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('dokter.periksa.edit', $periksa->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('dokter.periksa.destroy', $periksa->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>

        </table>
    </div>
</div>
@endsection
