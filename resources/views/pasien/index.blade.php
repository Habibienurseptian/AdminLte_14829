@extends('layouts.app')

@section('content_header')
    <h1>Dashboard Pasien</h1>
@stop

@section('content')
<div class="row mt-3">
    <div class="col-lg-6 col-12">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $jumlahPeriksa }}</h3>
                <p>Total Pemeriksaan</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-medical-alt"></i>
            </div>
            <a href="{{ route('pasien.riwayat') }}" class="small-box-footer">
                Lihat Riwayat <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-6 col-12">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>+</h3>
                <p>Periksa Sekarang</p>
            </div>
            <div class="icon">
                <i class="fas fa-notes-medical"></i>
            </div>
            <a href="{{ route('pasien.periksa.create') }}" class="small-box-footer">
                Daftar Periksa <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>
@stop
