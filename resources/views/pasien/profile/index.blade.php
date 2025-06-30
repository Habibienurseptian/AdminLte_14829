@extends('layouts.app')

@section('content_header')
    <h1 class="mb-3">
        <i class="fas fa-user me-2 text-dark"></i> Profil Pasien
    </h1>
@stop

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
    </div>
@endif

<div class="card shadow border-0 rounded-3 animate__animated animate__fadeIn mx-auto w-100" style="max-width: 720px;">
    <div class="card-body p-4">
        <form action="{{ route('pasien.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Foto Profil --}}
            <div class="text-center mb-4">
                <div class="position-relative d-inline-block">
                    <img src="{{ $pasien->photo ? asset('storage/' . $pasien->photo) : asset('images/default-patient.png') }}"
                         alt="Foto Pasien"
                         id="profilePhotoPreview"
                         class="rounded-circle shadow-sm"
                         style="width: 140px; height: 140px; object-fit: cover; border: 3px solid var(--bs-success); cursor: pointer;">
                    <label for="photoUpload" class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-2" style="cursor: pointer;">
                        <i class="fas fa-camera"></i>
                    </label>
                    <input type="file" name="photo" id="photoUpload" class="d-none @error('photo') is-invalid @enderror">
                </div>
                @error('photo')
                    <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                @enderror
                <small class="text-muted d-block mt-2">Klik foto untuk mengubah</small>
            </div>

            {{-- Data User --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Lengkap</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $pasien->user->name ?? '') }}" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $pasien->user->email ?? '') }}" required>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Password Baru <span class="text-muted">(Opsional)</span></label>
                <div class="input-group">
                    <input type="password" name="password" id="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Biarkan kosong jika tidak diubah">
                    <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
                        <i class="fas fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
                @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
                <div class="input-group">
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="form-control"
                        placeholder="Ulangi password baru">
                    <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordConfirm()">
                        <i class="fas fa-eye" id="eyeIconConfirm"></i>
                    </button>
                </div>
            </div>

            {{-- Data Pasien --}}
            <h5 class="fw-bold text-success mb-3">Detail Informasi Pasien</h5>

            <div class="mb-3">
                <label class="form-label fw-semibold">Nomor Rekam Medis</label>
                <input type="text" class="form-control" value="{{ $pasien->no_rm }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Alamat</label>
                <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                       value="{{ old('alamat', $pasien->alamat ?? '') }}">
                @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Nomor KTP</label>
                <input type="text" name="no_ktp" class="form-control @error('no_ktp') is-invalid @enderror"
                       value="{{ old('no_ktp', $pasien->no_ktp ?? '') }}">
                @error('no_ktp') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Nomor HP</label>
                <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                       value="{{ old('no_hp', $pasien->no_hp ?? '') }}">
                @error('no_hp') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary shadow-sm">
                    <i class="fas fa-save me-2"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    document.getElementById('profilePhotoPreview').addEventListener('click', function() {
        document.getElementById('photoUpload').click();
    });

    document.getElementById('photoUpload').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profilePhotoPreview').src = e.target.result;
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    function togglePassword() {
        const password = document.getElementById('password');
        const icon = document.getElementById('eyeIcon');
        if (password.type === 'password') {
            password.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            password.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    function togglePasswordConfirm() {
        const confirmInput = document.getElementById('password_confirmation');
        const icon = document.getElementById('eyeIconConfirm');
        if (confirmInput.type === 'password') {
            confirmInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            confirmInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

</script>
@endsection
