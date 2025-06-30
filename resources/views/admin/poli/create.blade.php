@extends('layouts.app')

@section('content_header')
    <h1>Tambah Poli</h1>
@stop

@section('content')
<div class="container">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h5 class="mb-0">Form Tambah Poli</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('poli.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Poli</label>
                    <input type="text" name="nama" class="form-control" required value="{{ old('nama') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan') }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('poli.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
