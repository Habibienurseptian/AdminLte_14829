@extends('layouts.app')

@section('content_header')
    <h1>Dashboard Dokter</h1>
@stop

@section('content')
<div class="row mt-3">
    <div class="col-lg-4 col-12">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $jumlahPeriksa }}</h3>
                <p>Total Pemeriksaan</p>
            </div>
            <div class="icon">
                <i class="fas fa-notes-medical"></i>
            </div>
            <a href="" class="small-box-footer">
                Lihat Pemeriksaan <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-12">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $jumlahPeriksaSelesai }}</h3>
                <p>Pemeriksaan Selesai</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <a href="{{ route('dokter.riwayat.index') }}" class="small-box-footer">
                Lihat Riwayat <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-12">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $jumlahPeriksaBelum }}</h3>
                <p>Menunggu Pemeriksaan</p>
            </div>
            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>
            <a href="{{ route('dokter.periksa.index') }}" class="small-box-footer">
                Lihat Antrian <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .small-box .icon {
        top: 10px;
        right: 10px;
        z-index: 0;
    }
</style>
@stop
