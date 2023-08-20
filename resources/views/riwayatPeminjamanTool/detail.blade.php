@extends('adminlte::page')

@section('title', 'Detail Riwayat Peminjaman Tools')

@section('content_header')
    <h1>Detail Riwayat Peminjaman Tools
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Detail data peminjaman</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Tanggal waktu pinjam</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_riwayat_peminjaman->tanggal_waktu_pinjam }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Tanggal waktu kembali</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_riwayat_peminjaman->tanggal_waktu_kembali }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Peminjam</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_riwayat_peminjaman->user->nama }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Kembali di gudang</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_riwayat_peminjaman->gudang->nama }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">List Tools Yang Dipinjam</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center">
                        <tr>
                            <th>Tools</th>
                            <th>Status Kondisi</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_riwayat_peminjaman->listTools as $list_tools)
                            <tr>
                                <td>{{ $list_tools->aset->kode_aset . " - " . $list_tools->aset->tool->nama . " " .  $list_tools->aset->tool->merk . " " . $list_tools->aset->tool->model }}</td>
                                <td class="text-center">{{ $list_tools->kondisiToolsTransaksiPeminjaman->status_kondisi }}</td>
                                <td>{{ $list_tools->kondisiToolsTransaksiPeminjaman->deskripsi }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
