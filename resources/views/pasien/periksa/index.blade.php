@extends('layouts.app')

@section('content_header')
    <h1>Daftar Pemeriksaan</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">Form Daftar Periksa</div>
    <div class="card-body">
        <form action="{{ route('pasien.periksa.store') }}" method="POST">
            @csrf

            {{-- Notifikasi --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Pilih Dokter --}}
            <div class="form-group mb-3">
                <label for="dokter_id">Pilih Dokter</label>
                <select name="dokter_id" id="dokter_id" class="form-control" required>
                    <option value="">-- Pilih Dokter --</option>
                    @foreach($dokterList as $dokter)
                        <option 
                            value="{{ $dokter->user->id }}" 
                            data-poli="{{ $dokter->poli->nama ?? 'Tidak Ada Poli' }}"
                            {{ old('dokter_id') == $dokter->user->id ? 'selected' : '' }}>
                            {{ $dokter->user->name ?? 'Nama tidak ditemukan' }} - {{ $dokter->poli->nama ?? 'Tidak Ada Poli' }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Poli --}}
            <div class="form-group mb-3">
                <label for="nama_poli">Poli</label>
                <input type="text" id="nama_poli" class="form-control" readonly>
            </div>

            {{-- Catatan --}}
            <div class="form-group mb-3">
                <label for="catatan">Catatan</label>
                <textarea name="catatan" id="catatan" class="form-control" rows="3" required>{{ old('catatan') }}</textarea>
            </div>

            {{-- Tanggal --}}
            <div class="form-group mb-3">
                <label for="tanggal">Tanggal Periksa</label>
                <select name="tanggal" id="tanggal" class="form-control" required disabled>
                    <option value="">-- Pilih Tanggal Sesuai Jadwal --</option>
                </select>
            </div>

            {{-- Info Jadwal --}}
            <div class="form-group mb-3">
                <label>Jadwal Dokter</label>
                <ul id="jadwal_dokter" class="list-group">
                    <li class="list-group-item text-info">Silakan pilih dokter untuk melihat jadwal.</li>
                </ul>
            </div>

            <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
    </div>
</div>
@stop

@section('js')
<script>
    const jadwalPraktik = @json($jadwalPraktik);

    function updatePoliName() {
        const select = document.getElementById('dokter_id');
        const poli = select.options[select.selectedIndex]?.getAttribute('data-poli') || '';
        document.getElementById('nama_poli').value = poli;
    }

    function updateTanggalOptions() {
        const dokterId = document.getElementById('dokter_id').value;
        const tanggalSelect = document.getElementById('tanggal');
        const jadwalInfo = document.getElementById('jadwal_dokter');

        tanggalSelect.innerHTML = '<option value="">-- Pilih Tanggal Sesuai Jadwal --</option>';
        jadwalInfo.innerHTML = '';

        if (!dokterId || !jadwalPraktik[dokterId]) {
            tanggalSelect.setAttribute('disabled', true);
            jadwalInfo.innerHTML = '<li class="list-group-item text-info">Silakan pilih dokter untuk melihat jadwal.</li>';
            return;
        }

        const jadwals = jadwalPraktik[dokterId] || [];

        if (jadwals.length === 0) {
            tanggalSelect.setAttribute('disabled', true);
            jadwalInfo.innerHTML = '<li class="list-group-item text-danger">Tidak ada jadwal praktik yang tersedia.</li>';
            return;
        }

        tanggalSelect.removeAttribute('disabled');
        const addedDates = new Set();
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        jadwals.forEach(j => {
            const jadwalDate = new Date(j.tanggal);
            jadwalDate.setHours(0, 0, 0, 0);
            if (jadwalDate < today) return;

            const formattedDate = jadwalDate.toLocaleDateString('id-ID', {
                weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
            });

            // Tambah ke info jadwal
            const li = document.createElement('li');
            li.textContent = `${formattedDate} jam ${j.jam}`;
            li.className = 'list-group-item';
            jadwalInfo.appendChild(li);

            if (!addedDates.has(j.tanggal)) {
                const option = document.createElement('option');
                option.value = j.tanggal;
                option.textContent = formattedDate;
                tanggalSelect.appendChild(option);
                addedDates.add(j.tanggal);
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        updatePoliName();
        updateTanggalOptions();

        document.getElementById('dokter_id').addEventListener('change', function () {
            updatePoliName();
            updateTanggalOptions();
        });
    });
</script>
@endsection
