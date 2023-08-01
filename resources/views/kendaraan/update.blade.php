@extends('adminlte::page')

@section('title', 'Update Data Kendaraan')

@section('content_header')
    <h1>Update Data Kendaraan</h1>
@stop

@section('content')
    <div class="card">
        <form action="/kendaraan/{{ $data->id }}/update" method="POST">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group">
                    <label for="nomorPolisi">Nomor Polisi</label>
                    <input type="text" class="form-control" id="nomorPolisi" name="nopol" value="{{ $data->nopol }}">
                </div>
                <div class="form-group">
                    <label for="merk">Merk</label>
                    <input type="text" class="form-control" id="merk" name="merk" value="{{ $data->merk }}">
                </div>
                <div class="form-group">
                    <label for="jenisKendaraan">Jenis Kendaraan</label>
                    <select class="form-control" name="jenis_kendaraan">
                        <option selected={{ $data->jenis_kendaraan === 'Motor' ? 1 : 0}}>Motor</option>
                        <option selected={{ $data->jenis_kendaraan === 'Mobil' ? 1 : 0}}>Mobil</option>
                        <option selected={{ $data->jenis_kendaraan === 'Van' ? 1 : 0}}>Van</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="warna">Warna</label>
                    <input type="text" class="form-control" id="warna" name="warna" value="{{ $data->warna }}">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
