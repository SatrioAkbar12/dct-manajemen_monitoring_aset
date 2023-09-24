@extends('adminlte::page')

@section('title', 'Review Peminjaman Baru Kendaraan')

@section('content_header')
    <h1>Review Peminjaman Baru Kendaraan</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="">Data Peminjaman Baru Kendaraan</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Tanggal waktu peminjaman</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_peminjaman->tanggal_waktu_pinjam }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Target tanggal waktu kembali</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_peminjaman->target_tanggal_waktu_kembali }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Peminjam</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_peminjaman->user->nama }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Kode aset</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_peminjaman->kendaraan->aset->kode_aset }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Kendaraan</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_peminjaman->kendaraan->nopol . " - " . $data_peminjaman->kendaraan->jenisKendaraan->nama . " " . $data_peminjaman->kendaraan->merk . " " . $data_peminjaman->kendaraan->tipe . " " . $data_peminjaman->kendaraan->warna }}
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Keperluan</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_peminjaman->keperluan }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Lokasi tujuan</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_peminjaman->lokasi_tujuan }}</p>
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
                        <iframe width="100%" height="250px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q={{ $data_peminjaman->geolocation_pinjam }}&z=15&output=embed"></iframe>
                        <div class="card-body">
                            <h6 class="text-center">Lokasi pinjam</h6>
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
                        <img class="card-img-top" src="{{ url('storage/' . $data_peminjaman->kondisiKendaraan->foto_speedometer_sebelum) }}">
                        <div class="card-body">
                            <h6 class="text-center">Foto speedometer awal</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-4 col-md-2">
                    <p>Foto kondisi awal</p>
                </div>
                <div class="col-8 col-md-10">
                    :
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <img class="card-img-top" src="{{ url('storage/' . $data_peminjaman->kondisiKendaraan->foto_depan_pinjam) }}">
                        <div class="card-body">
                            <h6 class="text-center">Foto Depan</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <img class="card-img-top" src="{{ url('storage/' . $data_peminjaman->kondisiKendaraan->foto_belakang_pinjam) }}">
                        <div class="card-body">
                            <h6 class="text-center">Foto Belakang</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <img class="card-img-top" src="{{ url('storage/' . $data_peminjaman->kondisiKendaraan->foto_kanan_pinjam) }}">
                        <div class="card-body">
                            <h6 class="text-center">Foto Kanan</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <img class="card-img-top" src="{{ url('storage/' . $data_peminjaman->kondisiKendaraan->foto_kiri_pinjam) }}">
                        <div class="card-body">
                            <h6 class="text-center">Foto Kiri</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
            @can('peminjamanBaruKendaraan.approval')
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalApproval">Approval</button>
            @endcan
        </div>
    </div>

    @can('peminjamanBaruKendaraan.approval')
        <div class="modal fade" id="modalApproval" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Approval Peminjaman Baru Kendaraan</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('peminjamanBaruKendaraan.approval', $data_peminjaman->id) }}" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Approved?</label>
                                <select class="form-control @error('approved') is-invalid @enderror" name="approved" required>
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
                                @error('approved')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"></textarea>
                                @error('keterangan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
@stop
