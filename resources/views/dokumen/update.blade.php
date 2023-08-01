@extends('adminlte::page')

@section('title', 'Update Data Tipe Dokumen')

@section('content_header')
    <h1>Update Tipe Dokumen Kendaraan</h1>
@stop

@section('content')
    <div class="card">
        <form action="/tipe-dokumen/{{ $data->id }}/update" method="POST">
            {{ csrf_field() }}
            {{-- {{ method_field('PUT') }} --}}
            <div class="card-body">
                <div class="form-group">
                    <label for="nomorPolisi">Nama</label>
                    <input type="text" class="form-control" id="nomorPolisi" name="nama" value="{{ $data->nama_dokumen }}">
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
