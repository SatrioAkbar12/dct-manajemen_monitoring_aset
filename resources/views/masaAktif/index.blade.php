@extends('adminlte::page')

@section('title', 'Masa Aktif Dokumen Kendaraan')

@section('content_header')
    <h1>Masa Aktif Dokumen Kendaraan</h1>
@stop

@section('content')
    <p>Semua masa aktif dokumen dari tiap kendaraan</p>

    <div class="card">
        <div class="card-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">Tambah data</button>
            <hr>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Dokumen</th>
                        <th>Nomor Polisi</th>
                        <th>Merk</th>
                        <th>Masa Berlaku Hingga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_masa_aktif as $d)
                        <tr>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->nama_dokumen }}</td>
                            <td>{{ $d->nopol }}</td>
                            <td>{{ $d->merk }}</td>
                            <td>{{ $d->tanggal_masa_berlaku }}</td>
                            <td class="text-center">
                                <a href="/masa-aktif-dokumen/{{ $d->id }}/update"><button type="button" class="btn btn-warning">Update</button></a>
                                <a href="/masa-aktif-dokumen/{{ $d->id }}/delete"><button type="button" class="btn btn-danger">Delete</button></a>
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
                <form action="/masa-aktif-dokumen" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Dokumen</label>
                            <select class="form-control" name="nama_dokumen">
                                @foreach ($data_dokumen as $dokumen)
                                    <option value={{ $dokumen->id }}>{{ $dokumen->nama_dokumen }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kendaraan</label>
                            <select class="form-control" name="kendaraan">
                                @foreach ($data_kendaraan as $kendaraan)
                                    <option value="{{ $kendaraan->id }}">{{ $kendaraan->nopol . " - " . $kendaraan->jenis_kendaraan . " " . $kendaraan->merk . " " . $kendaraan->warna }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Masa Aktif Hingga</label>
                            <input type="date" class="form-control" name="masa_aktif">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primaru">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
