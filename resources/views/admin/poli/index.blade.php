@extends('layouts.app')

@section('content_header')
    <h1 class="text-dark">Data Poli</h1>
@stop

@section('content')
<div class="container">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h5 class="mb-0">Daftar Poli</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('poli.create') }}" class="btn btn-primary mb-3">+ Tambah Poli</a>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>ID</th>
                            <th>Nama Poli</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($polis as $poli)
                            <tr>
                                <td class="text-center">{{ $poli->id }}</td>
                                <td>{{ $poli->nama }}</td>
                                <td>{{ $poli->keterangan }}</td>
                                <td class="text-center">
                                    <a href="{{ route('poli.edit', $poli->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('poli.destroy', $poli->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus poli ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada data poli.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
