@extends('adminlte::page')

@section('title', 'Master Data Jenis Kendaraan')

@section('content_header')
    <h1>Master Data Jenis Kendaraan</h1>
@stop

@section('content')
    <p>Semua data tentang jenis kendaraan yang ada</p>

    <div class="card">
        <div class="card-body">
            @can('jenisKendaraan.store')
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">Tambah data</button>
                <hr>
            @endcan

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Id</th>
                            <th>Jenis Kendaraan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $d->id }}</td>
                                <td>{{ $d->nama }}</td>
                                <td class="text-center">
                                    @can('jenisKendaraan.update')
                                        <button type="button" class="mx-2 my-1 btn btn-info" data-toggle="modal" data-target="#modalUpdate{{ $d->id }}">Update</button>
                                    @endcan
                                    @can('jenisKendaraan.del')
                                        <a href="{{ route('jenisKendaraan.del', $d->id) }}" class="mx-2 my-1 btn btn-danger" data-confirm-delete="true">Delete</button>
                                    @endcan
                                </td>
                            </tr>

                            @can('jenisKendaraan.update')
                                <div class="modal fade" id="modalUpdate{{ $d->id }}" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Update data</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('jenisKendaraan.update', $d->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Jenis kendaraan</label>
                                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $d->nama }}" required>
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

    @can('jenisKendaraan.store')
        <div class="modal fade" id="modalCreate" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah data baru</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('jenisKendaraan.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Jenis Kendaraan</label>
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
