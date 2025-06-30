@extends('layouts.app')

@section('css')
    <link rel="icon" type="image/png" href="{{ asset('image.png') }}">
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">

        {{-- ADMIN LOGIN --}}
        <div class="col-md-4">
            <div class="card shadow-sm rounded-lg"> {{-- Menambahkan shadow dan rounded --}}
                <div class="card-header bg-dark text-white text-center py-3 rounded-top-lg"> {{-- Menyesuaikan padding dan rounded --}}
                    <div class="text-center">
                        <i class="fas fa-clinic-medical fa-2x mb-2"></i> {{-- Menambahkan margin bawah --}}
                        <h1 class="h4 mb-1">Poliklinik</h1> {{-- Mengurangi margin bawah --}}
                        <span class="d-block">Login Admin</span> {{-- Memastikan span menjadi block untuk margin --}}
                    </div>
                </div>
                <div class="card-body p-4"> {{-- Menyesuaikan padding --}}
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" name="role" value="admin">

                        <div class="mb-3"> {{-- Mengganti form-group dengan mb-3 --}}
                            <label for="adminEmail" class="form-label text-muted fw-semibold">Email Admin</label>
                            <input type="email" name="email" id="adminEmail" class="form-control form-control-modern @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3"> {{-- Mengganti form-group mt-2 dengan mb-3 --}}
                            <label for="adminPassword" class="form-label text-muted fw-semibold">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="adminPassword" class="form-control form-control-modern @error('password') is-invalid @enderror" required autocomplete="current-password">
                                <button class="btn btn-outline-secondary password-toggle-btn" type="button" data-target="adminPassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark btn-block btn-modern mt-3">Login Admin</button> {{-- Mengganti btn-block dengan btn-modern --}}
                    </form>
                </div>
            </div>
        </div>

        {{-- DOKTER LOGIN --}}
        <div class="col-md-4">
            <div class="card shadow-sm rounded-lg">
                <div class="card-header bg-primary text-white text-center py-3 rounded-top-lg">
                    <div class="text-center">
                        <i class="fas fa-clinic-medical fa-2x mb-2"></i>
                        <h1 class="h4 mb-1">Poliklinik</h1>
                        <span class="d-block">Login Dokter</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" name="role" value="dokter">

                        <div class="mb-3">
                            <label for="dokterEmail" class="form-label text-muted fw-semibold">Email Dokter</label>
                            <input type="email" name="email" id="dokterEmail" class="form-control form-control-modern @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="dokterPassword" class="form-label text-muted fw-semibold">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="dokterPassword" class="form-control form-control-modern @error('password') is-invalid @enderror" required autocomplete="current-password">
                                <button class="btn btn-outline-secondary password-toggle-btn" type="button" data-target="dokterPassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-modern mt-3">Login Dokter</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- PASIEN LOGIN --}}
        <div class="col-md-4">
            <div class="card shadow-sm rounded-lg">
                <div class="card-header bg-success text-white text-center py-3 rounded-top-lg">
                    <div class="text-center">
                        <i class="fas fa-clinic-medical fa-2x mb-2"></i>
                        <h1 class="h4 mb-1">Poliklinik</h1>
                        <span class="d-block">Login Pasien</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" name="role" value="pasien">

                        <div class="mb-3">
                            <label for="pasienEmail" class="form-label text-muted fw-semibold">Email Pasien</label>
                            <input type="email" name="email" id="pasienEmail" class="form-control form-control-modern @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pasienPassword" class="form-label text-muted fw-semibold">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="pasienPassword" class="form-control form-control-modern @error('password') is-invalid @enderror" required autocomplete="current-password">
                                <button class="btn btn-outline-secondary password-toggle-btn" type="button" data-target="pasienPassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-block btn-modern mt-3">Login Pasien</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    body {
        background-color: #f0f2f5; /* Light grey background for the page */
    }
    .card {
        border-radius: 0.75rem; /* Rounded corners for cards */
        overflow: hidden; /* Ensure header corners are respected */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08); /* Soft shadow */
    }
    .card-header {
        border-bottom: none; /* Remove header border */
        padding: 1.5rem 1rem; /* More vertical padding */
    }
    .card-header h1 {
        font-weight: 700;
        margin-bottom: 0.5rem !important; /* Ensure minimal margin */
    }
    .card-header span {
        font-size: 0.9rem;
        opacity: 0.9;
    }
    .card-header .fa-clinic-medical {
        margin-bottom: 0.75rem !important;
    }

    .card-body {
        padding: 2rem !important; /* Generous padding for content */
    }

    .form-label {
        font-weight: 500;
        color: #555;
        margin-bottom: 0.5rem;
    }

    .form-control-modern {
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .form-control-modern:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
        outline: none;
    }
    .form-control-modern.is-invalid {
        border-color: #dc3545;
        padding-right: 0.75rem; /* Adjust for input-group */
        background-image: none; /* Remove default validation icon */
    }

    /* Input group for password toggle */
    .input-group .form-control-modern {
        border-right: none;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        padding: 0.65rem 1rem;
        font-size: 1rem;
        height: 48px; /* tinggi yang seragam */
    }

    .input-group .password-toggle-btn {
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
        border-left: none;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        color: #6c757d;
        padding: 0.65rem 1rem;
        font-size: 1rem;
        height: 48px; /* samakan dengan input */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .input-group .password-toggle-btn i {
        font-size: 1.1rem;
    }
    .input-group .password-toggle-btn:hover {
        background-color: #e9ecef;
        color: #495057;
    }
    .input-group .password-toggle-btn:focus {
        box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25); /* Match form-control focus shadow */
        border-color: #80bdff;
        outline: none;
        z-index: 3; /* Keep button on top during focus */
    }
    /* Specific invalid feedback styling for input-group */
    .input-group .invalid-feedback {
        display: block !important; /* Force display */
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.875em;
    }

    .btn-modern {
        padding: 0.75rem 1.5rem;
        font-size: 1.05rem;
        font-weight: 600;
        border-radius: 0.5rem;
        transition: all 0.2s ease-in-out;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .btn-modern:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }

    /* Specific button colors for consistency */
    .btn-dark {
        background-color: #343a40;
        border-color: #343a40;
    }
    .btn-dark:hover {
        background-color: #23272b;
        border-color: #23272b;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }
    .btn-success:hover {
        background-color: #1e7e34;
        border-color: #1e7e34;
    }

    /* Footer link for Pasien Register */
    .card-body hr {
        border-top: 1px solid rgba(0,0,0,.1);
    }
    .card-body p.small {
        font-size: 0.85rem;
    }
</style>
@stop

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Find all password toggle buttons
        const passwordToggleButtons = document.querySelectorAll('.password-toggle-btn');

        passwordToggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Get the target input ID from data-target attribute
                const targetInputId = this.dataset.target;
                const passwordInput = document.getElementById(targetInputId);

                if (passwordInput) {
                    // Toggle the type attribute
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);

                    // Toggle the eye icon
                    this.querySelector('i').classList.toggle('fa-eye');
                    this.querySelector('i').classList.toggle('fa-eye-slash');
                }
            });
        });

        // Optional: Add animation for cards on load (if using Animate.css)
        document.querySelectorAll('.card.animate__animated').forEach(card => {
            card.classList.add('animate__fadeIn');
        });
    });
</script>
{{-- Make sure Animate.css is included in your main layout if you want animations --}}
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/> --}}
@stop