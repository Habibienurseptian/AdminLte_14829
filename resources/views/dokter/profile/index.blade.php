@extends('layouts.app')

@section('content_header')
    <h1 class="mb-3">
        <i class="fas fa-user-circle me-2 text-dark"></i> Profil Dokter
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
        <form action="{{ route('dokter.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Foto Profil --}}
            <div class="text-center mb-4">
                <div class="position-relative d-inline-block">
                    <img src="{{ $dokter->photo ? asset('storage/' . $dokter->photo) : asset('images/default-doctor.png') }}"
                         alt="Foto Dokter"
                         id="profilePhotoPreview"
                         class="rounded-circle shadow-sm"
                         style="width: 140px; height: 140px; object-fit: cover; border: 3px solid var(--bs-primary); cursor: pointer;">
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
                       value="{{ old('name', $dokter->user->name ?? '') }}" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $dokter->user->email ?? '') }}" required>
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

            {{-- Data Dokter --}}
            <h5 class="fw-bold text-primary mb-3">Detail Informasi Dokter</h5>

            <div class="mb-3">
                <label class="form-label fw-semibold">Alamat</label>
                <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                       value="{{ old('alamat', $dokter->alamat ?? '') }}">
                @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Nomor HP</label>
                <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                       value="{{ old('no_hp', $dokter->no_hp ?? '') }}">
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

@section('css')
<style>
    .form-label {
        font-weight: 500;
        font-size: 0.95rem;
    }

    .form-control-modern {
        border: 1px solid #e0e0e0;
        border-radius: 0.4rem;
        padding: 0.65rem 0.9rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.04);
    }

    .form-control-modern:focus {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 0.2rem rgba(var(--bs-primary-rgb), 0.2);
    }

    .password-toggle-btn {
        border-left: none;
        border-radius: 0 0.4rem 0.4rem 0;
        color: #6c757d;
    }

    .profile-photo-modern {
        border: 3px solid var(--bs-primary);
        box-shadow: 0 0.3rem 0.6rem rgba(0, 0, 0, 0.08);
        transition: transform 0.2s ease;
    }

    .photo-upload-overlay {
        position: absolute;
        bottom: 0;
        right: 0;
        background-color: var(--bs-primary);
        color: white;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .btn-md-custom {
        padding: 0.7rem 2rem;
        font-size: 1rem;
        border-radius: 0.6rem;
        font-weight: 600;
    }

    @media (max-width: 767.98px) {
        .card-body {
            padding: 1rem !important;
        }
        .profile-photo-modern {
            width: 120px;
            height: 120px;
        }
        .photo-upload-overlay {
            width: 28px;
            height: 28px;
        }
        .btn-md-custom {
            width: 100%;
        }
    }
</style>
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