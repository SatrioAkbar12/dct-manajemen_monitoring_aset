@extends('adminlte::page')

@section('title', 'Master Data Gudang')

@section('content_header')
    <h1>Master Data Gudang</h1>
@stop

@section('content')
    <p>Seluruh data gudang yang ada</p>

    <div class="card">
        <div class="card-body">
            @can('gudang.store')
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">Tambah data</button>
                <hr>
            @endcan

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Id</th>
                            <th>Nama Gudang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_gudang as $gudang)
                            <tr>
                                <td class="text-center">{{ $gudang->id }}</td>
                                <td>{{ $gudang->nama }}</td>
                                <td class="text-center">
                                    @can('gudang.update')
                                        <button type="button" class="mx-2 my-1 btn btn-info" data-toggle="modal" data-target="#modalUpdate{{ $gudang->id }}">Update</button>
                                    @endcan
                                    @can('gudang.del')
                                        <a href="{{ route('gudang.del', $gudang->id) }}" class="mx-2 my-1 btn btn-danger" data-confirm-delete="true">Hapus</a>
                                    @endcan
                                </td>
                            </tr>

                            @can('gudang.update')
                                <div class="modal fade" id="modalUpdate{{ $gudang->id }}" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Update Data</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('gudang.update', $gudang->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nama gudang</label>
                                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $gudang->nama }}" required>
                                                        @error('nama')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
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
                {{ $data_gudang->links() }}
            </div>

            @can('gudang.store')
                <div class="modal fade" id="modalCreate" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah Data Baru</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <form action="{{ route('gudang.store') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Nama gudang</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required>
                                        @error('nama')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </div>
@stop
