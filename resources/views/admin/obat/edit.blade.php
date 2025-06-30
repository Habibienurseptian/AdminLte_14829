@extends('layouts.app')

@section('content_header')
    <h1>Obat</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Edit Obat</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('obat.update', $obat->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_obat" class="form-label">Nama Obat</label>
                    <input type="text" name="nama_obat" id="nama_obat" class="form-control" value="{{ $obat->nama_obat }}" required>
                </div>

                <div class="mb-3">
                    <label for="kemasan" class="form-label">Kemasan</label>
                    <input type="text" name="kemasan" id="kemasan" class="form-control" value="{{ $obat->kemasan }}" required>
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control" value="{{ $obat->harga }}" min="0" required>
                </div>

                <a href="{{ route('obat.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update Obat</button>
            </form>
        </div>
    </div>
</div>
@endsection
