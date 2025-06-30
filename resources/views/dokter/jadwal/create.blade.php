@extends('layouts.app')

@section('content_header')
    <h1>Tambah Jadwal Praktik</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('dokter.jadwal.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="hari">Hari</label>
                <select name="hari" class="form-control" required>
                    <option value="">-- Pilih Hari --</option>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                    <option value="Minggu">Minggu</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="jam">Jam Praktik</label>
                <input type="time" name="jam" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
        </form>
    </div>
</div>
@stop
