@extends('adminlte::page')

@section('title', 'Master Data Kepemilikan Aset')

@section('content_header')
    <h1>Master Data Kepemilikan Aset</h1>
@stop

@section('content')
    <p>Semua data tentang seluruh kepemilikan aset yang ada</p>

    <div class="card">
        <div class="card-body">
            @can('kepemilikanAset.store')
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">Tambah data</button>
                <hr>
            @endcan

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Prefix</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_kepemilikan_aset as $kepemilikan_aset)
                            <tr>
                                <td class="text-center">{{ $kepemilikan_aset->prefix }}</td>
                                <td>{{ $kepemilikan_aset->nama }}</td>
                                <td class="text-center">
                                    @can('kepemilikanAset.update')
                                        <button type="button" class="mx-2 my-1 btn btn-info" data-toggle="modal" data-target="#modalUpdate{{ $kepemilikan_aset->id }}">Update data</button>
                                    @endcan
                                    @can('kepemilikanAset.del')
                                        <a href="{{ route('kepemilikanAset.del', $kepemilikan_aset->id) }}" class="mx-2 my-1 btn btn-danger" data-confirm-delete="true">Hapus data</a>
                                    @endcan
                                </td>
                            </tr>

                            @can('kepemilikanAset.update')
                                <div class="modal fade" id="modalUpdate{{ $kepemilikan_aset->id }}" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Update data</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('kepemilikanAset.update', $kepemilikan_aset->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nama</label>
                                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $kepemilikan_aset->nama }}">
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
                {{ $data_kepemilikan_aset->links() }}
            </div>
        </div>

        @can('kepemilikanAset.store')
            <div class="modal fade" id="modalCreate" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah data baru</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action={{ route('kepemilikanAset.store') }} method="POST">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value={{ old('nama') }}>
                                    @error('nama')
                                        <div class="text-danger">
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Prefix kode aset</label>
                                    <input type="text" class="form-control @error('prefix') is-invalid @enderror" name="prefix" value={{ old('prefixx') }}>
                                    @error('prefix')
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
    </div>
@stop
