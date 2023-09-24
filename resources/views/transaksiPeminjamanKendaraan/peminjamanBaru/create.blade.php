@extends('adminlte::page')

@section('title', 'Tambah Peminjaman Kendaraan')

@section('content_header')
    <h1>Tambah Peminjaman Kendaraan Baru</h1>
@stop

@section('content')
    <div class="card">
        <form action="{{ route('peminjamanBaruKendaraan.store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group">
                    <label>Peminjam</label>
                    <input type="text" class="form-control" value="{{ $user }}" disabled>
                    <input type="hidden" name="user" value="{{ $data_peminjaman['user'] }}">
                </div>
                <div class="form-group">
                    <label>Tanggal waktu pinjam</label>
                    <input type="datetime-local" class="form-control" value="{{ $data_peminjaman['tanggal_waktu_pinjam'] }}" disabled>
                    <input type="hidden" name="tanggal_waktu_pinjam" value="{{ $data_peminjaman['tanggal_waktu_pinjam'] }}">
                </div>
                <div class="form-group">
                    <label>Tanggal waktu kembali</label>
                    <input type="datetime-local" class="form-control" value="{{ $data_peminjaman['target_tanggal_waktu_kembali'] }}" disabled>
                    <input type="hidden" name="target_tanggal_waktu_kembali" value="{{ $data_peminjaman['target_tanggal_waktu_kembali'] }}">
                </div>
                <div class="form-group">
                    <label>Kendaraan</label>
                    <input type="text" class="form-control" value="{{ $kendaraan->nopol . " - " . $kendaraan->merk . " " . $kendaraan->tipe . " " . $kendaraan->warna}}" disabled>
                    <input type="hidden" name="kendaraan" value="{{ $data_peminjaman['kendaraan']}}">
                </div>
                <div class="form-group">
                    <label>Keperluan</label>
                    <input type="text" class="form-control" value="{{ $data_peminjaman['keperluan'] }}" disabled>
                    <input type="hidden" name="keperluan" value="{{ $data_peminjaman['keperluan'] }}">
                </div>
                <div class="form-group">
                    <label>Lokasi tujuan</label>
                    <input type="text" class="form-control" value="{{ $data_peminjaman['lokasi_tujuan'] }}" disabled>
                    <input type="hidden" name="lokasi_tujuan" value="{{ $data_peminjaman['lokasi_tujuan'] }}">
                </div>
                <div class="form-group">
                    <label>Foto Speedometer</label>
                    <input type="file" class="form-control-file @error('foto_speedometer') is-invalid @enderror" name="foto_speedometer" accept="image/*"  capture="camera" required>
                </div>
                <div class="form-group">
                    <label>Foto kondisi depan</label>
                    <input type="file" class="form-control-file @error('foto_depan_sebelum') is-invalid @enderror" name="foto_depan_sebelum" accept="image/*" capture="camera" required>
                </div>
                <div class="form-group">
                    <label>Foto kondisi belakang</label>
                    <input type="file" class="form-control-file @error('foto_belakang_sebelum') is-invalid @enderror" name="foto_belakang_sebelum" accept="image/*" capture="camera" required>
                </div>
                <div class="form-group">
                    <label>Foto kondisi kanan</label>
                    <input type="file" class="form-control-file @error('foto_kanan_sebelum') is-invalid @enderror" name="foto_kanan_sebelum" accept="image/*" capture="camera" required>
                </div>
                <div class="form-group">
                    <label>Foto kondisi kiri</label>
                    <input type="file" class="form-control-file @error('foto_kiri_sebelum') is-invalid @enderror" name="foto_kiri_sebelum" accept="image/*" capture="camera" required>
                </div>
                <input type="hidden" name="geo_latitude" value="{{ $data_peminjaman['geo_latitude'] }}">
                <input type="hidden" name="geo_longitude" value="{{ $data_peminjaman['geo_longitude'] }}">
            </div>
            <div class="card-footer">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
                @can('peminjamanBaruKendaraan.store')
                    <button type="submit" class="btn btn-primary">Simpan</button>
                @endcan
            </div>
        </form>
    </div>
@stop
