@extends('layouts.app')

@section('content_header')
    <h1 class="text-dark">Data Dokter</h1>
@stop

@section('content')
<div class="container">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h5 class="mb-0">Daftar Dokter</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('dokter.create') }}" class="btn btn-primary mb-3">+ Tambah Dokter</a>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>ID</th>
                            <th>Nama Dokter</th>
                            <th>Email</th>
                            <th>Poli</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dokters as $dokter)
                            <tr>
                                <td class="text-center">{{ $dokter->id }}</td>
                                <td>{{ optional($dokter->user)->name ?? '-' }}</td>
                                <td>{{ optional($dokter->user)->email ?? '-' }}</td>
                                <td>{{ optional($dokter->poli)->nama ?? '-' }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $dokter->id }}">Detail</button>
                                    <a href="{{ route('dokter.edit', $dokter->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('dokter.destroy', $dokter->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus dokter ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                                    </form>
                                </td>
                            </tr>

                            {{-- Modal Detail --}}
                            <div class="modal fade" id="detailModal{{ $dokter->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $dokter->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4">
                                        <div class="modal-header bg-primary text-white rounded-top-4">
                                            <h5 class="modal-title" id="detailModalLabel{{ $dokter->id }}">Detail Dokter</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Nama:</strong> {{ $dokter->user->name ?? '-' }}</p>
                                            <p><strong>Email:</strong> {{ $dokter->user->email ?? '-' }}</p>
                                            <p><strong>Poli:</strong> {{ $dokter->poli->nama ?? '-' }}</p>
                                            <p><strong>Alamat:</strong> {{ $dokter->alamat ?? '-' }}</p>
                                            <p><strong>No HP:</strong> {{ $dokter->no_hp ?? '-' }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada data dokter.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
