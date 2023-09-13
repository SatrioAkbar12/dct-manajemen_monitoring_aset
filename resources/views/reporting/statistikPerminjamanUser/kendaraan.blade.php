@extends('adminlte::page')

@section('title', 'Reporting - Statistik Peminjaman Kendaraan User')

@section('content_header')
    <h1>Statistik Peminjaman Kendaraan User</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data User</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4 col-md-2">
                    Nama
                </div>
                <div class="col-8 col-md-10">
                    : {{ $data_user->nama }}
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    Total peminjaman
                </div>
                <div class="col-8 col-md-10">
                    : {{ $data_user->transaksiPeminjamanKendaraan->count() }}
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    Total peminjaman bulan ini
                </div>
                <div class="col-8 col-md-10">
                    : {{ $jumlah_peminjaman_bulan_ini }}
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    Total peminjaman aktif saat ini
                </div>
                <div class="col-8 col-md-10">
                    : {{ $jumlah_peminjaman_aktif }}
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Statistik Kendaraan</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center">
                        <tr>
                            <th>Kendaraan</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_user->statistikPeminjamanKendaraanUser as $statistik)
                            <tr>
                                <td>{{ $statistik->kendaraan->nopol . ' - ' . $statistik->kendaraan->merk . ' ' . $statistik->kendaraan->tipe . ' ' . $statistik->kendaraan->warna }}</td>
                                <td class="text-center">{{ $statistik->jumlah }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
