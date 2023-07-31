@extends('adminlte::page')

@section('title', 'Master Data Kendaraan')

@section('content_header')
    <h1>Master Data Kendaraan</h1>
@stop

@section('content')
    <p>Semua data mengenai aset kendaraan yang dimiliki</p>

    <div class="card">
        {{-- <div class="card-header">
            <div class="card-title">
            </div>
        </div> --}}
        <div class="card-body">
            <button type="button" class="btn btn-primary">Tambah data</button>
            <hr>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nomor Polisi</th>
                        <th>Merk</th>
                        <th>Jenis Kendaraan</th>
                        <th>Warna</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>B 123 A</td>
                        <td>Daihatsu</td>
                        <td>Van</td>
                        <td>Putih</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-warning">Update</button>
                            <button type="button" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>B 123 B</td>
                        <td>Daihatsu</td>
                        <td>Van</td>
                        <td>Putih</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-warning">Update</button>
                            <button type="button" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>B 123 C</td>
                        <td>Daihatsu</td>
                        <td>Van</td>
                        <td>Putih</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-warning">Update</button>
                            <button type="button" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>B 123 D</td>
                        <td>Daihatsu</td>
                        <td>Van</td>
                        <td>Putih</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-warning">Update</button>
                            <button type="button" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
