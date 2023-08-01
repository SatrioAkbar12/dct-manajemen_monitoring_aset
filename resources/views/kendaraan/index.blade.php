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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">Tambah data</button>
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
                {{-- <tbody>
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
                </tbody> --}}
                <tbody>
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->nopol}}</td>
                            <td>{{ $d->merk }}</td>
                            <td>{{ $d->jenis_kendaraan }}</td>
                            <td>{{ $d->warna }}</td>
                            <td class="text-center">
                                <a href="/kendaraan/{{ $d->id }}/update"><button type="button" class="btn btn-warning">Update</button></a>
                                <a href="/kendaraan/{{ $d->id }}/delete"><button type="button" class="btn btn-danger">Delete</button></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalCreate" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah data baru</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="/kendaraan" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nomor Polisi</label>
                            <input type="text" class="form-control" name="nopol" required>
                        </div>
                        <div class="form-group">
                            <label>Merk</label>
                            <input type="text" class="form-control" name="merk" required>
                        </div>
                        <div class="form-group">
                            <label>Jenis kendaraan</label>
                            <select class="form-control" name="jenis_kendaraan">
                                <option value="Motor">Motor</option>
                                <option value="Mobil">Mobil</option>
                                <option value="Van">Van</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Warna</label>
                            <input type="text" class="form-control" name="warna" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
