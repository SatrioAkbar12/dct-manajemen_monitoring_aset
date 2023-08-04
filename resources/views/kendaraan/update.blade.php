@extends('adminlte::page')

@section('title', 'Update Data Kendaraan')

@section('content_header')
    <h1>Update Data Kendaraan</h1>
@stop

@section('content')
    <div class="card">
        <form action="{{ route('kendaraan.update', $data->id) }}" method="POST">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group">
                    <label for="nomorPolisi">Nomor Polisi</label>
                    <input type="text" class="form-control" id="nomorPolisi" name="nopol" value="{{ $data->nopol }}" required>
                </div>
                <div class="form-group">
                    <label for="merk">Merk</label>
                    <input type="text" class="form-control" id="merk" name="merk" value="{{ $data->merk }}" required>
                </div>
                <div class="form-group">
                    <label for="jenisKendaraan">Jenis Kendaraan</label>
                    <select class="form-control" name="jenis_kendaraan" required>
                        <option {{ $data->jenis_kendaraan == 'Motor' ? "selected" : "" }}>Motor</option>
                        <option {{ $data->jenis_kendaraan == 'Mobil' ? "selected" : "" }}>Mobil</option>
                        <option {{ $data->jenis_kendaraan == 'Van' ? "selected" : "" }}>Van</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="warna">Warna</label>
                    <input type="text" class="form-control" id="warna" name="warna" value="{{ $data->warna }}" required>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('kendaraan.index') }}"><button type="button" class="btn btn-secondary">Kembali</button></a>
            </div>
        </form>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
