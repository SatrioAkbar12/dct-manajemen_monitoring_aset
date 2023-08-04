@extends('adminlte::page')

@section('title', 'Update Data User')

@section('content_header')
    <h1>Update User</h1>
@stop

@section('content')
    <div class="card">
        <form action="{{ route('user.update', $data->id) }}" method="POST">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" value="{{ $data->username }}" required>
                </div>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" value="{{ $data->nama }}" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $data->email }}" required>
                </div>
                <div class="form-group">
                    <label>Memiliki SIM</label>
                    <select class="form-control" name="memiliki_sim">
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('user.index') }}"><button type="button" class="btn btn-secondary">Kembali</button></a>
            </div>
        </form>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
