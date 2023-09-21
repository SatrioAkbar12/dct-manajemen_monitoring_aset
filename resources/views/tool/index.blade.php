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
                <button type="button" class="mx-1 btn btn-primary" data-toggle="modal" data-target="#modalCreate">Tambah data</button>
            @endcan
            @can('tools.storeExist')
                <button type="button" class="mx-1 btn btn-primary" data-toggle="modal" data-target="#modalCreateExist">Tambah data yang telah ada</button>
            @endcan
            <hr>

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
                                <label>Kepemilikan Aset</label>
                                <select class="form-control @error('kepemilikan_aset') is-invalid @enderror" id="kepemilikanAsetInput" name="kepemilikan_aset" required>
                                    @foreach ($data_kepemilikan_aset as $kepemilikan_aset)
                                        <option value="{{ $kepemilikan_aset->id }}">{{ $kepemilikan_aset->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kepemilikan_aset')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
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
                                <select class="form-control @error('tools_group') is-invalid @enderror" id="toolsGroupInput" name="tools_group" required>
                                    @foreach ($data_tools_group as $grup)
                                        <option value="{{ $grup->id }}">{{ $grup->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="gudang">Tersimpan di gudang</label>
                                <select class="form-control @error('gudang') is-invalid @enderror" id="gudangInput" name="gudang" required>
                                    @foreach ($data_gudang as $gudang)
                                        <option value="{{ $gudang->id }}">{{ $gudang->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jumlah barang</label>
                                <input type="number" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" required>
                                <span>* data akan diduplikasi dengan kode aset yang berbeda</span>
                                @error('jumlah')
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

    @can('tools.storeExist')
        <div class="modal fade" id="modalCreateExist" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Data Yang Telah Ada</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('tools.storeExist') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Kode aset</label>
                                <input type="text" class="form-control @error('kode_aset') is-invalid @enderror" name="kode_aset" value="{{ old('kode_aset') }}" required>
                                @error('kode_aset')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
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
                                <select class="form-control @error('tools_group') is-invalid @enderror" id="toolsGroupInput" name="tools_group" required>
                                    @foreach ($data_tools_group as $grup)
                                        <option value="{{ $grup->id }}">{{ $grup->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="gudang">Tersimpan di gudang</label>
                                <select class="form-control @error('gudang') is-invalid @enderror" id="gudangInput" name="gudang" required>
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

@section('js')
    <script>
        $('document').ready(function() {
            $('#kepemilikanAsetInput').select2();
            $('#toolsGroupInput').select2();
            $('#gudangInput').select2();
        })
    </script>
@stop
