@extends('adminlte::page')

@section('title', 'Master Data Jenis Dokumen Kendaraan')

@section('content_header')
    <h1>Master Data Tipe Dokumen Kendaraan</h1>
@stop

@section('content')
    <p>Semua data tentang tipe dokumen kendaraan</p>

    <div class="card">
        <div class="card-body">
            @can('tipeDokumen.store')
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">Tambah data</button>
                <hr>
            @endcan

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Id</th>
                            <th>Nama Dokumen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td class="text-center">{{ $d->id }}</td>
                                <td>{{ $d->nama_dokumen }}</td>
                                <td class="text-center">
                                    @can('tipeDokumen.update')
                                        <button type="button" class="mx-2 my-1 btn btn-warning" data-toggle="modal" data-target="#modalUpdate{{ $d->id }}">Update</button>
                                    @endcan
                                    @can('tipeDokumen.del')
                                        <a href="{{ route('tipeDokumen.del', $d->id) }}" class="mx-2 my-1 btn btn-danger" data-confirm-delete="true">Delete</button>
                                    @endcan
                                </td>
                            </tr>

                            @can('tipeDokumen.update')
                                <div class="modal fade" id="modalUpdate{{ $d->id }}" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Update data</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('tipeDokumen.update', $d->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nama dokumen</label>
                                                        <input type="text" class="form-control" name="nama" value="{{ $d->nama_dokumen }}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simmpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endcan
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

    @can('tipeDokumen.store')
        <div class="modal fade" id="modalCreate" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah data baru</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('tipeDokumen.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" required>
                                @error('nama')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
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
    @endcan
@stop
