@extends('adminlte::page')

@section('title', 'Master Data User')

@section('content_header')
    <h1>Berhasil menambahkan user baru</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <p>Berhasil menambahkan user :</p>
            <ul>
                <li>Username : {{ $data_user->username }}</li>
                <li>Email : {{ $data_user->email }}</li>
                <li>Nama : {{ $data_user->nama }}</li>
            </ul>
            <p>Gunakan password berikut untuk login pertama kali :</p>
            <p><i>Password</i>:</p>
            <div class="py-2 px-3 rounded" style="background-color: #4dc2d4;">
                {{ $generate_password }}
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
@stop
