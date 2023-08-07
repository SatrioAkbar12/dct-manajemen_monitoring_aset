@extends('adminlte::page')

@section('title', 'Update Data Tipe Dokumen')

@section('content_header')
    <h1>Update Tipe Dokumen Kendaraan</h1>
@stop

@section('content')
    <div class="card">
        <form action="{{ route('tipeDokumen.update', $data->id) }}" method="POST">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group">
                    <label for="nomorPolisi">Nama</label>
                    <input type="text" class="form-control" id="nomorPolisi" name="nama" value="{{ $data->nama_dokumen }}" required>
                    @error('nama')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('tipeDokumen.index') }}"><button type="button" class="btn btn-secondary">Kembali</button></a>
            </div>
        </form>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
