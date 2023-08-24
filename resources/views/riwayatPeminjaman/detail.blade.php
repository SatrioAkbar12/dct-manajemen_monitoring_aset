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
                    <p>Kode aset</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_riwayat_peminjaman->kendaraan->aset->kode_aset }}</p>
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
                    <p>Keperluan</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_riwayat_peminjaman->keperluan }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Lokasi tujuan</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_riwayat_peminjaman->lokasi_tujuan }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>KM terakhir</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_riwayat_peminjaman->kondisiKendaraan->km_terakhir }} KM</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Jumlah KM</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_riwayat_peminjaman->kondisiKendaraan->jumlah_km }} KM</p>
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
                    <p>Lokasi peminjaman</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>:</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <iframe width="100%" height="250px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q={{ $data_riwayat_peminjaman->geolocation_pinjam }}&z=15&output=embed"></iframe>
                        <div class="card-body">
                            <h6 class="text-center">Lokasi pinjam</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <iframe width="100%" height="250px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q={{ $data_riwayat_peminjaman->geolocation_kembali }}&z=15&output=embed"></iframe>
                        <div class="card-body">
                            <h6 class="text-center">Lokasi kembali</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Foto speedometer</p>
                </div>
                <div class="col-8 col-md-10">
                    :
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <img class="card-img-top" src="{{ url('storage/' . $data_riwayat_peminjaman->kondisiKendaraan->foto_speedometer_sebelum) }}">
                        <div class="card-body">
                            <h6 class="text-center">Foto speedometer sebelum</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <img class="card-img-top" src="{{ url('storage/' . $data_riwayat_peminjaman->kondisiKendaraan->foto_speedometer_sesudah) }}">
                        <div class="card-body">
                            <h6 class="text-center">Foto speedometer sesudah</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-4 col-md-2">
                    <p>Foto kondisi</p>
                </div>
                <div class="col-8 col-md-10">
                    :
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <img class="card-img-top" src="{{ url('storage/' . $data_riwayat_peminjaman->kondisiKendaraan->foto_depan) }}">
                        <div class="card-body">
                            <h6 class="text-center">Foto Depan</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <img class="card-img-top" src="{{ url('storage/' . $data_riwayat_peminjaman->kondisiKendaraan->foto_belakang) }}">
                        <div class="card-body">
                            <h6 class="text-center">Foto Belakang</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <img class="card-img-top" src="{{ url('storage/' . $data_riwayat_peminjaman->kondisiKendaraan->foto_kanan) }}">
                        <div class="card-body">
                            <h6 class="text-center">Foto Kanan</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <img class="card-img-top" src="{{ url('storage/' . $data_riwayat_peminjaman->kondisiKendaraan->foto_kiri) }}">
                        <div class="card-body">
                            <h6 class="text-center">Foto Kiri</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ URL::previous() }}"><button type="button" class="btn btn-secondary">Kembali</button></a>
        </div>
    </div>
@stop
