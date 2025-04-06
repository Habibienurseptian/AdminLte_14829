@extends('layouts.app')

@section('content_header')
    <h1>Obat</h1>
@stop

@section('content')
<div class="container">
    <!-- Form Tambah Obat -->
    <div class="card mb-4">
        <div class="card-header">
            <h4>Tambah Obat</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('obat.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_obat" class="form-label">Nama Obat</label>
                    <input type="text" name="nama_obat" id="nama_obat" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="kemasan" class="form-label">Kemasan</label>
                    <input type="text" name="kemasan" id="kemasan" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control" min="0" required>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Obat</button>
            </form>
        </div>
    </div>

    <!-- Tabel Daftar Obat -->
    <div class="card">
        <div class="card-header">
            <h4>Daftar Obat</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Obat</th>
                        <th>Kemasan</th>
                        <th>Harga</th>
                        <th>Aksi</th> <!-- Kolom baru -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($obats as $obat)
                        <tr>
                            <td>{{ $obat->id }}</td>
                            <td>{{ $obat->nama_obat }}</td>
                            <td>{{ $obat->kemasan }}</td>
                            <td>Rp {{ number_format($obat->harga, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('obat.edit', $obat->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('obat.destroy', $obat->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus obat ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
