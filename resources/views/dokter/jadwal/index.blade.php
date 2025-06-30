@extends('layouts.app')

@section('content_header')
    <h1>Jadwal Praktik Dokter</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('dokter.jadwal.create') }}" class="btn btn-primary">Tambah Jadwal</a>
        </div>
        <div class="card-body">
            @if($jadwalList->isEmpty())
                <p>Tidak ada jadwal praktik.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Hari</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwalList as $jadwal)
                            <tr>
                                <td>{{ $jadwal->hari }}</td>
                                <td>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d-m-Y') }}</td>
                                <td>{{ $jadwal->jam }}</td>
                                <td>
                                    <a href="{{ route('dokter.jadwal.edit', $jadwal->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('dokter.jadwal.destroy', $jadwal->id) }}" method="POST" style="display:inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus jadwal ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@stop
