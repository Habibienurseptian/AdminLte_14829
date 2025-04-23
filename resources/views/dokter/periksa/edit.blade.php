@extends('layouts.app')

@section('content_header')
    <h1>Edit Periksa</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">Form Edit Periksa</div>
    <div class="card-body">
        <form action="{{ route('dokter.periksa.update', $periksa->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="dokter_id">Pilih Dokter</label>
                <select name="dokter_id" id="dokter_id" class="form-control" required>
                    @foreach($dokterList as $dokter)
                        <option value="{{ $dokter->id }}" {{ $dokter->id == $periksa->dokter_id ? 'selected' : '' }}>{{ $dokter->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="keluhan">Keluhan</label>
                <textarea name="keluhan" id="keluhan" class="form-control" rows="3" required>{{ $periksa->catatan }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="tanggal">Tanggal Periksa</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $periksa->tgl_periksa->format('Y-m-d') }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="biaya_periksa">Biaya Periksa</label>
                <input type="number" name="biaya_periksa" id="biaya_periksa" class="form-control" value="{{ $periksa->biaya_periksa }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="obat_id">Pilih Obat</label>
                <select name="obat_id[]" id="obat_id" class="form-control" multiple>
                    @foreach($obatList as $obat)
                        <option value="{{ $obat->id }}" 
                            {{ $periksa->obats->contains($obat->id) ? 'selected' : '' }}>
                            {{ $obat->nama_obat }}
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">Gunakan Ctrl (Windows) / Cmd (Mac) untuk memilih lebih dari satu</small>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
