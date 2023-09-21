@extends('adminlte::page')

@section('title', 'Update Data Kendaraan')

@section('content_header')
    <h1>Update Data Kendaraan</h1>
@stop

@section('content')
    <div class="card">
        <form action="{{ route('kendaraan.update', $data->id) }}" method="POST">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group">
                    <label>Kode Aset</label>
                    <input type="text" class="form-control" value="{{ $data->aset->kode_aset }}" readonly>
                </div>
                <div class="form-group">
                    <label for="nomorPolisi">Nomor Polisi</label>
                    <input type="text" class="form-control @error('nopol') is-invalid @enderror" id="nomorPolisi" name="nopol" value="{{ $data->nopol }}" required>
                    @error('nopol')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jenisKendaraanInput">Jenis Kendaraan</label>
                    <select class="form-control @error('jenis_kendaraan') is-invalid @enderror" id="jenisKendaraanInput" name="jenis_kendaraan" required>
                        @foreach ($data_jenis_kendaraan as $jenis_kendaraan)
                            <option value="{{ $jenis_kendaraan->id }}" {{ $data->id_jenis_kendaraan == $jenis_kendaraan->id ? 'selected' : '' }}>{{ $jenis_kendaraan->nama }}</option>
                        @endforeach
                    </select>
                    @error('jenis_kendaraan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="merk">Merk</label>
                    <input type="text" class="form-control @error('merk') is-invalid @enderror" id="merk" name="merk" value="{{ $data->merk }}" required>
                    @error('merk')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tipe">Tipe</label>
                    <input type="text" class="form-control @error('tipe') is-invalid @enderror" id="tipe" name="tipe" value="{{ $data->tipe }}" required>
                    @error('tipe')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="warna">Warna</label>
                    <input type="text" class="form-control @error('warna') is-invalid @enderror" id="warna" name="warna" value="{{ $data->warna }}" required>
                    @error('warna')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="km_saat_ini">KM saat ini</label>
                    <input type="number" class="form-control @error('km_saat_ini') is-invalid @enderror" id="km_saat_ini" name="km_saat_ini" value="{{ $data->km_saat_ini }}" required>
                    @error('km_saat_ini')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('kendaraan.index') }}"><button type="button" class="btn btn-secondary">Kembali</button></a>
            </div>
        </form>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#jenisKendaraanInput').select2();
        })
    </script>
@stop
