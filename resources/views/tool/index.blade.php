@extends('adminlte::page')

@section('title', 'Master Data Tools')

@section('content_header')
    <h1>Master Data Tools</h1>
@stop

@section('content')
    <p>Semua data tentang aset tools yang ada</p>

    <div class="card">
        <div class="card-body">
            @can('tools.store')
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">Tambah data</button>
                <hr>
            @endcan

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Kode Aset</th>
                            <th>Nama</th>
                            <th>Merk</th>
                            <th>Model</th>
                            <th>Tools Group</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_tool as $tool)
                            <tr>
                                <td>{{ $tool->aset->kode_aset }}</td>
                                <td>{{ $tool->nama }}</td>
                                <td>{{ $tool->merk }}</td>
                                <td>{{ $tool->model }}</td>
                                <td>{{ $tool->toolsGroup->nama }}</td>
                                <td class="text-center">{{ $tool->status_saat_ini }}</td>
                                <td class="text-center">
                                    @can('tools.detail')
                                        <a href="{{ route('tools.detail', $tool->id) }}"><button type="button" class="mx-2 my-1 btn btn-info">Detail</button></a>
                                    @endcan
                                    @can('tools.update')
                                        <a href="{{ route('tools.edit', $tool->id) }}"><button type="button" class="mx-2 my-1 btn btn-info">Update</button></a>
                                    @endcan
                                    @can('tools.del')
                                        <a href="{{ route('tools.del', $tool->id) }}" class="mx-2 my-1 btn btn-danger" data-confirm-delete="true">Hapus</a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <br>
            <div class="d-flex justify-content-center">
                {{ $data_tool->links() }}
            </div>
        </div>
    </div>

    @can('tools.store')
        <div class="modal fade" id="modalCreate" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Data Baru</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('tools.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required>
                                @error('nama')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Merk</label>
                                <input type="text" class="form-control @error('merk') is-invalid @enderror" name="merk" value="{{ old('merk') }}" required>
                                @error('merk')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Model</label>
                                <input type="text" class="form-control @error('model') is-invalid @enderror" name="model" value="{{ old('model')}}">
                                @error('model')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" required>{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="toolsGroup">Tools Group</label>
                                <select class="form-control @error('tools_group') is-invalid @enderror" id="toolsGroup" name="tools_group" required>
                                    @foreach ($data_tools_group as $grup)
                                        <option value="{{ $grup->id }}">{{ $grup->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="gudang">Tersimpan di gudang</label>
                                <select class="form-control @error('gudang') is-invalid @enderror" id="gudang" name="gudang" required>
                                    @foreach ($data_gudang as $gudang)
                                        <option value="{{ $gudang->id }}">{{ $gudang->nama }}</option>
                                    @endforeach
                                </select>
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
@stop
