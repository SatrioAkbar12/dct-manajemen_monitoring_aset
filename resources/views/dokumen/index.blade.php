@extends('adminlte::page')

@section('title', 'Master Data Jenis Dokumen Kendaraan')

@section('content_header')
    <h1>Master Data Tipe Dokumen Kendaraan</h1>
@stop

@section('content')
    <p>Semua data tentang tipe dokumen kendaraan</p>

    <div class="card">
        <div class="card-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">Tambah data</button>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nama Dokumen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $d->id }}</td>
                                <td>{{ $d->nama_dokumen }}</td>
                                <td class="text-center">
                                    {{-- <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalUpdate">Update</button> --}}
                                    <a href="/tipe-dokumen/{{ $d->id }}/update"><button type="button" class="btn btn-warning">Update</button></a>
                                    {{-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete">Delete</button> --}}
                                    <a href="/tipe-dokumen/{{ $d->id }}/delete"><button type="button" class="btn btn-danger">Delete</button></a>
                                    {{-- <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-light" data-toggle="modal" data-target="#myModal" data-community="{{ json_encode($d) }}">Edit</button>
                                    <a href="{{ URL::to('delete', array($d->id)) }}" class="btn btn-danger dropdown-toggle waves-effect waves-light">Delete</a></td> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <br>
            <div class="d-flex justify-content-center">
                {{ $data->links() }}
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
                <form action="/tipe-dokumen" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" required>
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

    <div class="modal fade" id="modalUpdate" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control">
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

    <div class="modal fade" id="modalDelete" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Apakah ingin menghapus data?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                    {{-- <a href="/tipe-dokumen/{{ $data->id }}/delete/"> --}}
                        <button type="button" class="btn btn-primary">Ya</button>
                    {{-- </a> --}}
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
