@extends('layouts.app')

@section('content_header')
    <h1>Dokter</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">Pasien Periksa</div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table">
        <thead class="table-primary">
            <tr>
                <th scope="col">No.</th>
                {{-- <th scope="col">ID Periksa</th> --}}
                <th scope="col">Pasien</th>
                <th scope="col">Tanggal Periksa</th>
                <th scope="col">Keluhan</th>
                <th scope="col">Obat</th>
                <th scope="col">Biaya Periksa</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($listPeriksa as $index => $periksa)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    {{-- <td>{{ $periksa->id }}</td> --}}
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
                        @if($periksa->status === 'selesai')
                            <span class="badge bg-success">Selesai</span>
                        @else
                            <span class="badge bg-warning">Belum</span>
                        @endif
                    </td>
                    <td>
                        @if($periksa->status !== 'selesai')
                            <a href="{{ route('dokter.periksa.edit', $periksa->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            @if($periksa->obats->isNotEmpty() && $periksa->biaya_periksa > 0)
                                <form action="{{ route('dokter.periksa.selesai', $periksa->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Tandai sebagai selesai?')">Selesai</button>
                                </form>
                            @endif
                        @endif
                        <form action="{{ route('dokter.periksa.destroy', $periksa->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center">Tidak ada data periksa</td></tr>
            @endforelse
        </tbody>
        </table>
    </div>
</div>
@endsection
