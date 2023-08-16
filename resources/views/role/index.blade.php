@extends('adminlte::page')

@section('title', 'Master Data Roles')

@section('content_header')
    <h1>Master Data Roles User</h1>
@stop

@section('content')
    <p>Semua data tentang roles user</p>

    <div class="card">
        <div class="card-body">
            @can('roles.store')
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">Tambah role</button>
                <hr>
            @endcan

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Id</th>
                            <th>Nama role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $d)
                            <tr>
                                <td class="text-center">{{ $d->id }}</td>
                                <td>{{ $d->name }}</td>
                                <td class="text-center">
                                    @can('roles.del')
                                        <form action="{{ route('roles.del', $d->id) }}" method="POST">
                                            {{ csrf_field() }}
                                    @endcan
                                    @can('roles.update')
                                            <button type="button" class="my-1 mx-2 btn btn-success" data-toggle="modal" data-target="#modalUpdate{{ $d->id }}">Update</button>
                                    @endcan
                                    @can('roles.del')
                                            <a href="{{ route('roles.del', $d->id) }}" class="my-1 mx-2 btn btn-danger" data-confirm-delete="true">Hapus</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>

                            @can('roles.update')
                                <div class="modal fade" id="modalUpdate{{ $d->id }}" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Update data</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('roles.update', $d->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nama role</label>
                                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $d->name }}" required>
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

    @can('roles.store')
        <div class="modal fade" id="modalCreate" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah data baru</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('roles.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama role</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required>
                                @error('nama')
                                    <div class="text-danger">{{ $message }}
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
