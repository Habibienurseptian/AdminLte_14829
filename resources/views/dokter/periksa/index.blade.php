@extends('layouts.app')


{{-- Customize layout sections --}}

@section('content_header')
    <h1>Dokter</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">Pasien Periksa</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">No.</th>
                    <th scope="col">ID Periksa</th>
                    <th scope="col">Pasien</th>
                    <th scope="col">Tanggal Periksa</th>
                    <th scope="col">Catatan</th>
                    <th scope="col">Biaya Periksa</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td>1</td>
                    <td>Budi Laud</td>
                    <td>04-04-2025</td>
                    <td>Perlu Banyak Tidur</td>
                    <td>170.000</td>
                    </tr>
                    <tr>
                    <th scope="row">2</th>
                    <td>2</td>
                    <td>Agus</td>
                    <td>04-04-2025</td>
                    <td>Perlu Banyak Tidur</td>
                    <td>170.000</td>
                    </tr>
                </tbody>
                </table>
        </div>
    </div>
</div>
@endsection