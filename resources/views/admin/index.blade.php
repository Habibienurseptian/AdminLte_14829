@extends('layouts.app')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-dark">Dashboard Admin</h1>
    </div>
@stop

@section('content')
<div class="card mt-3">
    <div class="card-header">
        <h5 class="mb-0">Selamat Datang, Admin {{ Auth::user()->name }}.</h5>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $jumlahPasien }}</h3>
                <p>Jumlah Pasien</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ route('pasien.index') }}" class="small-box-footer">
                Lihat Data <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $jumlahDokter }}</h3>
                <p>Jumlah Dokter</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-md"></i>
            </div>
            <a href="{{ route('dokter.index') }}" class="small-box-footer">
                Lihat Data <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $jumlahObat }}</h3>
                <p>Jumlah Obat</p>
            </div>
            <div class="icon">
                <i class="fas fa-pills"></i>
            </div>
            <a href="{{ route('obat.index') }}" class="small-box-footer">
                Lihat Data <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $jumlahPoli }}</h3>
                <p>Jumlah Poli</p>
            </div>
            <div class="icon">
                <i class="fas fa-clinic-medical"></i>
            </div>
            <a href="{{ route('poli.index') }}" class="small-box-footer">
                Lihat Data <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>{{ $jumlahUser }}</h3>
                <p>Total Pengguna</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-friends"></i>
            </div>
            <span class="small-box-footer">Admin, Dokter, Pasien</span>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $uniqueVisitors }}</h3>
                <p>Pengunjung Hari Ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-eye"></i>
            </div>
            <span class="small-box-footer">Realtime</span>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    .small-box .icon {
        top: 10px;
        right: 10px;
        font-size: 3rem;
        opacity: 0.6;
    }

    .small-box-footer {
        display: block;
        padding: 5px 10px;
        background: rgba(0, 0, 0, 0.1);
        color: #fff;
        text-align: center;
        font-weight: 600;
        text-decoration: none;
    }
</style>
@endsection
