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
                    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $data->username }}" required>
                    @error('username')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $data->nama }}" required>
                    @error('nama')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $data->email }}" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Memiliki SIM</label>
                    <select class="form-control @error('memiliki_sim') is-invalid @enderror" name="memiliki_sim" required>
                        <option value="1" {{ $data->memiliki_sim == 1 ? "selected" : "" }}>Ya</option>
                        <option value="0" {{ $data->memiliki_sim == 0 ? "selected" : "" }}>Tidak</option>
                    </select>
                    @error('memiliki_sim')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
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
