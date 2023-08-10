@extends('adminlte::page')

@section('title', 'Detail Riwayat Peminjaman')

@section('content_header')
    <h1>Detail Riwayat Peminjaman</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Tanggal waktu peminjaman</p>
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
                    <p>Kendaraan</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_riwayat_peminjaman->kendaraan->nopol . " - " . $data_riwayat_peminjaman->kendaraan->jenisKendaraan->nama . " " . $data_riwayat_peminjaman->kendaraan->merk . " " . $data_riwayat_peminjaman->kendaraan->tipe . " " . $data_riwayat_peminjaman->kendaraan->warna }}
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
                    <p>Status kondisi</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_riwayat_peminjaman->kondisiKendaraan->status_kondisi }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Deskripsi kondisi</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_riwayat_peminjaman->kondisiKendaraan->deskripsi }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Foto kondisi</p>
                </div>
                <div class="col-8 col-md-10">
                    :
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <img class="img-fluid" src="{{ url('storage/' . $data_riwayat_peminjaman->kondisiKendaraan->foto_depan) }}">
                    <p class="text-center">Foto Depan</p>
                </div>
                <div class="col-md-6">
                    <img class="img-fluid" src="{{ url('storage/' . $data_riwayat_peminjaman->kondisiKendaraan->foto_belakang) }}">
                    <p class="text-center">Foto Belakang</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <img class="img-fluid" src="{{ url('storage/' . $data_riwayat_peminjaman->kondisiKendaraan->foto_kanan) }}">
                    <p class="text-center">Foto Kanan</p>
                </div>
                <div class="col-md-6">
                    <img class="img-fluid" src="{{ url('storage/' . $data_riwayat_peminjaman->kondisiKendaraan->foto_kiri) }}">
                    <p class="text-center">Foto Kiri</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('riwayatPeminjaman.index') }}"><button type="button" class="btn btn-secondary">Kembali</button></a>
        </div>
    </div>
@stop
