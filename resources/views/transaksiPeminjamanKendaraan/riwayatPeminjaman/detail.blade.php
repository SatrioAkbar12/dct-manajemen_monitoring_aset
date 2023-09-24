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
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center">
                        <tr>
                            <th>Fase</th>
                            <th>Foto kondisi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Peminjaman</td>
                            <td class="text-center">
                                <button type="button" class="mx-2 my-1 btn btn-info" data-toggle="modal" data-target="#modalFotoKondisiPinjamDepan">Foto depan</button>
                                <button type="button" class="mx-2 my-1 btn btn-info" data-toggle="modal" data-target="#modalFotoKondisiPinjamBelakang">Foto belakang</button>
                                <button type="button" class="mx-2 my-1 btn btn-info" data-toggle="modal" data-target="#modalFotoKondisiPinjamKanan">Foto kanan</button>
                                <button type="button" class="mx-2 my-1 btn btn-info" data-toggle="modal" data-target="#modalFotoKondisiPinjamKiri">Foto kiri</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Pengembalian</td>
                            <td class="text-center">
                                <button type="button" class="mx-2 my-1 btn btn-info" data-toggle="modal" data-target="#modalFotoKondisiKembaliDepan">Foto depan</button>
                                <button type="button" class="mx-2 my-1 btn btn-info" data-toggle="modal" data-target="#modalFotoKondisiKembaliBelakang">Foto belakang</button>
                                <button type="button" class="mx-2 my-1 btn btn-info" data-toggle="modal" data-target="#modalFotoKondisiKembaliKanan">Foto kanan</button>
                                <button type="button" class="mx-2 my-1 btn btn-info" data-toggle="modal" data-target="#modalFotoKondisiKembaliKiri">Foto kiri</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal fade" id="modalFotoKondisiPinjamDepan" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Foto Kondisi Peminjaman - Depan</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body text-center">
                            <img class="img-fluid" src="{{ url('storage/' . $data_riwayat_peminjaman->kondisiKendaraan->foto_depan_pinjam) }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalFotoKondisiPinjamBelakang" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Foto Kondisi Peminjaman - Belakang</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body text-center">
                            <img class="img-fluid" src="{{ url('storage/' . $data_riwayat_peminjaman->kondisiKendaraan->foto_belakang_pinjam) }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalFotoKondisiPinjamKanan" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Foto Kondisi Peminjaman - Kanan</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body text-center">
                            <img class="img-fluid" src="{{ url('storage/' . $data_riwayat_peminjaman->kondisiKendaraan->foto_kanan_pinjam) }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalFotoKondisiPinjamKiri" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Foto Kondisi Peminjaman - Kiri</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body text-center">
                            <img class="img-fluid" src="{{ url('storage/' . $data_riwayat_peminjaman->kondisiKendaraan->foto_kiri_pinjam) }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalFotoKondisiKembaliDepan" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Foto Kondisi Peminjaman - Depan</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body text-center">
                            <img class="img-fluid" src="{{ url('storage/' . $data_riwayat_peminjaman->kondisiKendaraan->foto_depan_kembali) }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalFotoKondisiKembaliBelakang" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Foto Kondisi Peminjaman - Belakang</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body text-center">
                            <img class="img-fluid" src="{{ url('storage/' . $data_riwayat_peminjaman->kondisiKendaraan->foto_belakang_kembali) }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalFotoKondisiKembaliKanan" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Foto Kondisi Peminjaman - Kanan</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body text-center">
                            <img class="img-fluid" src="{{ url('storage/' . $data_riwayat_peminjaman->kondisiKendaraan->foto_kanan_kembali) }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalFotoKondisiKembaliKiri" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Foto Kondisi Peminjaman - Kiri</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body text-center">
                            <img class="img-fluid" src="{{ url('storage/' . $data_riwayat_peminjaman->kondisiKendaraan->foto_kiri_kembali) }}">
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
