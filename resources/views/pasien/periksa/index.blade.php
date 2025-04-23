@extends('layouts.app')

@section('content_header')
    <h1>Pasien Periksa</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">Form Periksa</div>
    <div class="card-body">
        <form action="{{ route('pasien.periksa.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="dokter_id">Pilih Dokter</label>
                <select name="dokter_id" id="dokter_id" class="form-control" required>
                    <option value="">-- Pilih Dokter --</option>
                    @foreach($dokterList as $dokter)
                        <option value="{{ $dokter->id }}">{{ $dokter->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="keluhan">Keluhan</label>
                <textarea name="keluhan" id="keluhan" class="form-control" rows="3" required></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="tanggal">Tanggal Periksa</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
    </div>
</div>
@endsection
