@extends('adminlte::page')

@section('title', 'Reporting - Detail Statistik Penggunaan Kendaraan')

@section('content_header')
    <h1>Detail Statistik Penggunaan Kendaraan</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Kendaraan</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4 col-md-2">
                    Kode aset
                </div>
                <div class="col-8 col-md-10">
                    : {{ $data_aset->kode_aset }}
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    Jenis kendaraan
                </div>
                <div class="col-8 col-md-10">
                    : {{ $data_aset->kendaraan->jenisKendaraan->nama }}
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    Nomor polisi
                </div>
                <div class="col-8 col-md-10">
                    : {{ $data_aset->kendaraan->nopol }}
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    Merk
                </div>
                <div class="col-8 col-md-10">
                    : {{ $data_aset->kendaraan->merk }}
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    Tipe
                </div>
                <div class="col-8 col-md-10">
                    : {{ $data_aset->kendaraan->tipe }}
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    Warna
                </div>
                <div class="col-8 col-md-10">
                    : {{ $data_aset->kendaraan->warna }}
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    Total penggunaan
                </div>
                <div class="col-8 col-md-10">
                    : {{ $data_aset->kendaraan->transaksiPeminjamanKendaraan->count() }}
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    Total penggunaan bulan ini
                </div>
                <div class="col-8 col-md-10">
                    : {{ $jumlah_penggunaan_bulan_ini }}
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Statistik Pengguna Kendaraan</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center">
                        <tr>
                            <th>User</th>
                            <th>Jumlah penggunaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_aset->statistikPenggunaanAset as $statistik)
                            @if ($statistik->user != null)
                                <tr>
                                    <td>{{ $statistik->user->nama }}</td>
                                    <td class="text-center">{{ $statistik->jumlah }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
