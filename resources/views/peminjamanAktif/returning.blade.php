@extends('adminlte::page')

@section('title', 'Pengembalian Barang')

@section('content_header')
    <h1>Pengembalian Kendaraan</h1>
@stop

@section('content')
    <div class="card">
        <form action="{{ route('peminjamanAktif.update', $data_peminjaman_aktif->id )}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group">
                    <label>Kendaraan</label>
                    <input type="text" class="form-control-plaintext" value="{{ $data_peminjaman_aktif->kendaraan->nopol . " - " . $data_peminjaman_aktif->kendaraan->jenisKendaraan->nama . " " . $data_peminjaman_aktif->kendaraan->merk . " " . $data_peminjaman_aktif->kendaraan->tipe . " " . $data_peminjaman_aktif->kendaraan->warna }}" disabled>
                </div>
                <div class="form-group">
                    <label>Status kondisi kendaraan</label>
                    <select class="form-control @error('status_kondisi') is-invalid @enderror" name="status_kondisi" required>
                        <option value="Aman">Aman</option>
                        <option value="Ada kerusakan">Ada kerusakan</option>
                    </select>
                    @error('status_kondisi')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Deskripsi kondisi kendaraan</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" required></textarea>
                    @error('deskripsi')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>KM terakhir kendaraan</label>
                    <input type="number" class="form-control @error('km_terakhir') is-invalid @enderror" name="km_terakhir" required>
                    *KM peminjaman terakhir : {{ $data_peminjaman_aktif->kendaraan->km_saat_ini }}
                    @error('km_terakhir')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Foto depan kendaraan</label>
                    <input type="file" class="form-control-file" name="foto_depan" accept="image/*" required>
                    @error('foto_depan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Foto belakang kendaraan</label>
                    <input type="file" class="form-control-file" name="foto_belakang" accept="image/*" required>
                    @error('foto_belakang')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Foto kanan kendaraan</label>
                    <input type="file" class="form-control-file" name="foto_kanan" accept="image/*" required>
                    @error('foto_kanan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Foto kiri kendaraan</label>
                    <input type="file" class="form-control-file" name="foto_kiri" accept="image/*" required>
                    @error('foto_kiri')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                @can('peminjamanAktif.update')
                    <button type="submit" class="btn btn-success">Simpan</button>
                @endcan
                <a href="{{ route('peminjamanAktif.index') }}"><button type="button" class="btn btn-secondary">Kembali</button></a>
            </div>
        </form>
    </div>
@stop
