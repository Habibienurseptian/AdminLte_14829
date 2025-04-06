@extends('layouts.app')


{{-- Customize layout sections --}}

@section('content_header')
    <h1>Riwayat Pasien</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">Periksa</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">No.</th>
                    <th scope="col">ID Periksa</th>
                    <th scope="col">Dokter</th>
                    <th scope="col">Tanggal Periksa</th>
                    <th scope="col">Catatan</th>
                    <th scope="col">Obat</th>
                    <th scope="col">Biaya Periksa</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td>P001</td>
                    <td>Yono</td>
                    <td>04-04-2025</td>
                    <td>Perlu Banyak Tidur</td>
                    <td>Obat Tidur Ganja</td>
                    <td>170.000</td>
                    </tr>
                    <tr>
                    <th scope="row">2</th>
                    <td>P002</td>
                    <td>Yono</td>
                    <td>04-04-2025</td>
                    <td>Perlu Banyak Tidur</td>
                    <td>Obat Tidur Ganja</td>
                    <td>170.000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection