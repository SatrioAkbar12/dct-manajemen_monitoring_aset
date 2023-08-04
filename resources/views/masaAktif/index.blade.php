@extends('adminlte::page')

@section('title', 'Masa Aktif Dokumen Kendaraan')

@section('content_header')
    <h1>Masa Aktif Dokumen Kendaraan</h1>
@stop

@section('content')
    <p>Semua masa aktif dokumen dari tiap kendaraan</p>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nomor Polisi</th>
                            <th>Kendaraan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_kendaraan as $kendaraan)
                            <tr>
                                <td>{{ $kendaraan->id }}</td>
                                <td>{{ $kendaraan->nopol }}</td>
                                <td>{{ $kendaraan->jenis_kendaraan . " " . $kendaraan->merk . " " . $kendaraan->warna }}</td>
                                <td class="text-center">
                                    <a href="{{ route('masaAktifDokumen.getKendaraan', $kendaraan->id) }}"><button type="button" class="btn btn-info">Detail</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <br>
            <div class="d-flex justify-content-center">
                {{ $data_kendaraan->links() }}
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
