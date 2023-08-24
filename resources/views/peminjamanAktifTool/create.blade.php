@extends('adminlte::page')

@section('title', 'Buat Peminjaman Tools')

@section('content_header')
    <h1>Peminjaman Tools</h1>
@stop

@section('content')
    <div class="card">
        <form action="{{ route('peminjamanAktifTools.store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group">
                    <label>Peminjam</label>
                    <input type="text" class="form-control" value="{{ $user }}" disabled>
                    <input type="hidden" name="user" value="{{ $data_peminjaman_aktif['user'] }}">
                </div>
                <div class="form-group">
                    <label>Tanggal waktu pinjam</label>
                    <input type="datetime-local" class="form-control" value="{{ $data_peminjaman_aktif['tanggal_waktu_pinjam'] }}" disabled>
                    <input type="hidden" name="tanggal_waktu_pinjam" value="{{ $data_peminjaman_aktif['tanggal_waktu_pinjam'] }}">
                </div>
                <div class="form-group">
                    <label>Tanggal waktu kembali</label>
                    <input type="datetime-local" class="form-control" value="{{ $data_peminjaman_aktif['target_tanggal_waktu_kembali'] }}" disabled>
                    <input type="hidden" name="target_tanggal_waktu_kembali" value="{{ $data_peminjaman_aktif['target_tanggal_waktu_kembali'] }}">
                </div>
                <div class="form-group">
                    <label>Keperluan</label>
                    <input type="text" class="form-control" value="{{ $data_peminjaman_aktif['keperluan'] }}" disabled>
                    <input type="hidden" name="keperluan" value="{{ $data_peminjaman_aktif['keperluan'] }}">
                </div>
                <div class="form-group">
                    <label>Lokasi tujuan</label>
                    <input type="text" class="form-control" value="{{ $data_peminjaman_aktif['lokasi_tujuan'] }}" disabled>
                    <input type="hidden" name="lokasi_tujuan" value="{{ $data_peminjaman_aktif['lokasi_tujuan'] }}">
                </div>
                <div class="form-group">
                    <label>List foto tools :</label>
                    <ul>
                        @foreach ($tools as $tools)
                            <div class="mb-3">
                                <li>{{ $tools->aset->kode_aset . " - " . $tools->nama . " " . $tools->merk . " " . $tools->model }}</li>
                                <input type="file" class="form-control-file" name="foto_tool[]" accept="image/*" capture="camera">
                                <input type="hidden" name="tools[]" value="{{ $tools->id_aset }}">
                            </div>
                        @endforeach
                    </ul>
                </div>
                <input type="hidden" name="geo_latitude" value="{{ $data_peminjaman_aktif['geo_latitude'] }}">
                <input type="hidden" name="geo_longitude" value="{{ $data_peminjaman_aktif['geo_longitude'] }}">
            </div>
            <div class="card-footer">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@stop
