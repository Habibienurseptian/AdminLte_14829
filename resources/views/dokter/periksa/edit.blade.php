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

            {{-- Biaya Tetap --}}
            <div class="form-group mb-3">
                <label>Biaya Tetap (Rp)</label>
                <input type="text" class="form-control" value="150000" readonly>
            </div>

            {{-- Pilih Obat --}}
            <div class="form-group mb-3">
                <label for="obat_id">Pilih Obat</label>
                <select name="obat_id[]" id="obat_id" class="form-control" multiple required>
                    @foreach($obatList as $obat)
                        <option 
                            value="{{ $obat->id }}" 
                            data-harga="{{ $obat->harga }}"
                            {{ $periksa->obats->contains($obat->id) ? 'selected' : '' }}>
                            {{ $obat->nama_obat }} (Rp{{ number_format($obat->harga, 0, ',', '.') }})
                        </option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Gunakan Ctrl (Windows) / Cmd (Mac) untuk memilih lebih dari satu.</small>
            </div>

            {{-- Total Biaya --}}
            <div class="form-group mb-3">
                <label for="biaya_periksa">Total Biaya Periksa (Rp)</label>
                <input type="number" name="biaya_periksa" id="biaya_periksa" class="form-control" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    const biayaTetap = 150000;

    function hitungTotal() {
        let total = biayaTetap;
        const selected = document.querySelectorAll('#obat_id option:checked');
        selected.forEach(option => {
            total += parseInt(option.dataset.harga);
        });
        document.getElementById('biaya_periksa').value = total;
    }

    document.getElementById('obat_id').addEventListener('change', hitungTotal);
    window.addEventListener('DOMContentLoaded', hitungTotal);
</script>
@endsection
