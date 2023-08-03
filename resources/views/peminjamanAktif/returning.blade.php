@extends('adminlte::page')

@section('title', 'Pengembalian Barang')

@section('content_header')
    <h1>Pengembalian Kendaraan</h1>
@stop

@section('content')
    <div class="card">
        <form action="/peminjaman-aktif/{{ $data_peminjaman_aktif->id }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group">
                    <label>Kendaraan</label>
                    <input type="text" class="form-control-plaintext" value="{{ $data_peminjaman_aktif->kendaraan->nopol . " - " . $data_peminjaman_aktif->kendaraan->jenis_kendaraan . " " . $data_peminjaman_aktif->kendaraan->merk . " " . $data_peminjaman_aktif->kendaraan->warna }}" disabled>
                </div>
                <div class="form-group">
                    <label>Status kondisi kendaraan</label>
                    <select class="form-control" name="status_kondisi">
                        <option value="Aman">Aman</option>
                        <option value="Ada kerusakan">Ada kerusakan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Deskripsi kondisi kendaraan</label>
                    <textarea class="form-control" name="deskripsi"></textarea>
                </div>
                <div class="form-group">
                    <label>Foto kondisi kendaraan</label>
                    <input type="file" class="form-control-file" name="foto_kondisi" accept="image/*">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
@stop
