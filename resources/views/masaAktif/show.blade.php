@extends('adminlte::page')

@section('title', 'Detail Dokumen Kendaraan')

@section('content_header')
    <h1>Detail Dokumen Kendaraan</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Data Kendaraan</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Nomor Polisi</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_kendaraan->nopol }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Merk</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_kendaraan->merk }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Jenis kendaraan</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_kendaraan->jenis_kendaraan }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Warna</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_kendaraan->warna }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Dokumen kendaraan</h5>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">Tambah baru</button>
            <hr>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Dokumen</th>
                            <th>Masa Aktif Hingga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_masa_aktif as $dokumen)
                            <tr>
                                <td>{{ $dokumen->tipeDokumen->id }}</td>
                                <td>{{ $dokumen->tipeDokumen->nama_dokumen }}</td>
                                <td>{{ $dokumen->tanggal_masa_berlaku }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalUpdate{{ $dokumen->id_tipe_dokumen }}">Update</button>
                                    <a href="/masa-aktif-dokumen/{{ $dokumen->id_kendaraan }}/{{ $dokumen->id }}/delete"><button type="button" class="btn btn-danger">Hapus</button></a>
                                </td>
                            </tr>

                            <div class="modal fade" id="modalUpdate{{ $dokumen->id_tipe_dokumen }}" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Update masa aktif dokumen</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <form action="/masa-aktif-dokumen/{{ $dokumen->id_kendaraan }}/{{ $dokumen->id }}" method="POST">
                                            {{ csrf_field() }}
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Kendaraan</label>
                                                    <input type="text" class="form-control" value="{{ $dokumen->kendaraan->nopol . " - " . $dokumen->kendaraan->jenis_kendaraan . " " . $dokumen->kendaraan->merk . " " . $dokumen->kendaraan->warna }}" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label>Dokumen</label>
                                                    <input type="text" class="form-control" value="{{ $dokumen->tipeDokumen->nama_dokumen }}" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label>Masa aktif hingga</label>
                                                    <input type="date" class="form-control" name="masa_aktif" value="{{ $dokumen->tanggal_masa_berlaku }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-defaul" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCreate" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah data baru</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="/masa-aktif-dokumen/{{ $data_kendaraan->id }}" method="POST">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label>Kendaraan</label>
                            <input type="text" class="form-control" value="{{ $data_kendaraan->nopol . " - " . $data_kendaraan->jenis_kendaraan . " " . $data_kendaraan->merk . " " . $data_kendaraan->warna }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Dokumen</label>
                            <select class="form-control" name="tipe_dokumen" required>
                                @foreach ($data_tipe_dokumen as $dokumen)
                                    <option value="{{ $dokumen->id }}">{{ $dokumen->nama_dokumen }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Masa aktif hingga</label>
                            <input type="date" class="form-control" name="masa_aktif" required>
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
