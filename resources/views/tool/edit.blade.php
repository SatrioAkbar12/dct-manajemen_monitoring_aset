@extends('adminlte::page')

@section('title', 'Update Data Tool')

@section('content_header')
    <h1>Update Data Tool</h1>
@stop

@section('content')
    <div class="card">
        <form action="{{ route('tools.update', $data_tool->id) }}" method="POST">
            {{ csrf_field() }}
            <div class="card-body">
                @if($errors->any())
                    {!! implode('', $errors->all('<div>:message</div>')) !!}
                @endif
                <div class="form-group">
                    <label>Kode Aset</label>
                    <input type="text" class="form-control" value="{{ $data_tool->aset->kode_aset }}" readonly>
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $data_tool->nama }}" required>
                    @error('nama')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Merk</label>
                    <input type="text" class="form-control @error('merk') is-invalid @enderror" name="merk" value="{{ $data_tool->merk }}" required>
                    @error('merk')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Model</label>
                    <input type="text" class="form-control @error('model') is-invalid @enderror" name="model" value="{{ $data_tool->model }}">
                    @error('model')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" required>{{ $data_tool->deskripsi }}</textarea>
                    @error('deskripsi')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="toolsGroup">Tools Group</label>
                    <select class="form-control @error('tools_group') is-invalid @enderror" id="toolsGroup" name="tools_group" required>
                        @foreach ($data_tools_group as $grup)
                            <option value="{{ $grup->id }}" {{ $data_tool->id_tools_group == $grup->id ? 'selected' : '' }}>{{ $grup->nama }}</option>
                        @endforeach
                    </select>
                    @error('tools_group')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="gudang">Tersimpan di gudang</label>
                    @if ($data_tool->status_saat_ini == 'Keluar')
                        <input type="text" class="form-control" value="-" disabled>
                        <span class="text-info">Tools saat ini sedang digunakan</span>
                    @else
                        <select class="form-control @error('gudang') is-invalid @enderror" id="gudang" name="gudang" required>
                            @foreach ($data_gudang as $gudang)
                                <option value="{{ $gudang->id }}" {{ $data_tool->id_gudang == $gudang->id ? 'selected' : '' }}>{{ $gudang->nama }}</option>
                            @endforeach
                        </select>
                        @error('gudang')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    @endif
                </div>
                <input type="hidden" name="status_saat_ini" value="{{ $data_tool->status_saat_ini}}" required>
            </div>
            <div class="card-footer">
                <a href="{{ URL::previous() }}"><button type="button" class="btn btn-default">Kembali</button></a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@stop
