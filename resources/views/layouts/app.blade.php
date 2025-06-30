@extends('adminlte::page')

@section('title', 'Poliklinik')

@section('content_header')
    <h1>Login</h1>
@stop

@section('content')
<div class="container mt-4">
    <div class="alert alert-info">
        Selamat datang di halaman login admin panel.
    </div>
</div>
@stop

@section('css')
{{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('image.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('image.ico') }}" type="image/x-icon">
    {{-- Jika menggunakan PNG (opsional tambahan untuk dukungan luas) --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('image-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('image-16x16.png') }}">
    
{{-- Animate CSS --}}
    
    <link rel="icon" type="image/png" href="{{ asset('image.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endsection

@section('js')
    {{-- Bootstrap 5 JS (CDN) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
