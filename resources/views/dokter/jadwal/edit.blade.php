@extends('layouts.app')

@section('content_header')
    <h1>Edit Jadwal Praktik</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('dokter.jadwal.update', $jadwal->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Hari --}}
            <div class="form-group mb-3">
                <label for="hari">Hari</label>
                <select name="hari" class="form-control" required>
                    @php
                        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                    @endphp
                    <option value="">-- Pilih Hari --</option>
                    @foreach($hariList as $hari)
                        <option value="{{ $hari }}" {{ $jadwal->hari === $hari ? 'selected' : '' }}>
                            {{ $hari }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tanggal --}}
            <div class="form-group mb-3">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ $jadwal->tanggal }}" required>
            </div>

            {{-- Jam --}}
            <div class="form-group mb-3">
                <label for="jam">Jam Praktik</label>
                <input type="time" name="jam" class="form-control" value="{{ $jadwal->jam }}" required>
            </div>

            {{-- Tombol --}}
            <button type="submit" class="btn btn-primary">Update Jadwal</button>
            <a href="{{ route('dokter.jadwal.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@stop
