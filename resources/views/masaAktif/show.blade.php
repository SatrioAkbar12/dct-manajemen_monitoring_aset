@extends('adminlte::page')

@section('title', 'Detail Dokumen Kendaraan')

@section('content_header')
    <h1>Detail Dokumen Kendaraan</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Data Kendaraan</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Nomor Polisi</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_kendaraan->nopol }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Merk</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_kendaraan->merk }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Tipe</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_kendaraan->tipe }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Jenis kendaraan</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_kendaraan->jenisKendaraan->nama }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Warna</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_kendaraan->warna }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('masaAktifDokumen.index') }}"><button type="button" class="btn btn-secondary">Kembali</button></a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Dokumen kendaraan</h5>
        </div>
        <div class="card-body">
            @can('masaAktifDokumen.store')
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">Tambah baru</button>
                <hr>
            @endcan

            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Dokumen</th>
                            <th>Masa Aktif Hingga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_kendaraan->masaAktifDokumen as $dokumen)
                            <tr class="text-center">
                                <td>{{ $dokumen->tipeDokumen->id }}</td>
                                <td>{{ $dokumen->tipeDokumen->nama_dokumen }}</td>
                                <td>{{ $dokumen->tanggal_masa_berlaku }}</td>
                                <td>
                                    @can('masaAktifDokumen.update')
                                        <button type="button" class="mx-2 my-1 btn btn-info" data-toggle="modal" data-target="#modalUpdate{{ $dokumen->id_tipe_dokumen }}">Update</button>
                                    @endcan
                                    @can('masaAktifDokumen.del')
                                        <a href="{{ route('masaAktifDokumen.del', [ 'id_kendaraan' => $data_kendaraan->id,'id' => $dokumen->id]) }}" class="mx-2 my-1 btn btn-danger" data-confirm-delete="true">Hapus</button>
                                    @endcan
                                </td>
                            </tr>

                            @can('masaAktifDokumen.update')
                                <div class="modal fade" id="modalUpdate{{ $dokumen->id_tipe_dokumen }}" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Update masa aktif dokumen</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('masaAktifDokumen.update', ['id_kendaraan' => $dokumen->id_kendaraan, 'id' => $dokumen->id]) }}" method="POST">
                                                {{ csrf_field() }}
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Kendaraan</label>
                                                        <input type="text" class="form-control" value="{{ $dokumen->kendaraan->nopol . " - " . $dokumen->kendaraan->jenis_kendaraan . " " . $dokumen->kendaraan->merk . " " . $dokumen->kendaraan->warna }}" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Dokumen</label>
                                                        <input type="text" class="form-control" name="tipe_dokumen" value="{{ $dokumen->tipeDokumen->nama_dokumen }}" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Masa aktif hingga</label>
                                                        <input type="date" class="form-control @error('masa_aktif') is-invalid @enderror" name="masa_aktif" value="{{ $dokumen->tanggal_masa_berlaku }}" value="{{ old('masa_aktif') }}" required>
                                                        @error('masa_aktif')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-defaul" data-dismiss="modal">Batal</button>
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
        </div>
    </div>

    @can('masaAktifDokumen.store')
        <div class="modal fade" id="modalCreate" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah data baru</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('masaAktifDokumen.store', $data_kendaraan->id) }}" method="POST">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label>Kendaraan</label>
                                <input type="text" class="form-control" value="{{ $data_kendaraan->nopol . " - " . $data_kendaraan->jenis_kendaraan . " " . $data_kendaraan->merk . " " . $data_kendaraan->warna }}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Dokumen</label>
                                <select class="form-control @error('tipe_dokumen') is-invalid @enderror" id="dokumenInput" name="tipe_dokumen" required>
                                    @foreach ($data_tipe_dokumen as $dokumen)
                                        <option value="{{ $dokumen->id }}" {{ $dokumen->id == old('tipe_dokumen') ? 'selected' : '' }}>{{ $dokumen->nama_dokumen }}</option>
                                    @endforeach
                                </select>
                                @error('tipe_dokumen')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Masa aktif hingga</label>
                                <input type="date" class="form-control @error('masa_aktif') is-invalid @enderror" name="masa_aktif" value="{{ old('masa_aktif') }}" required>
                                @error('masa_aktif')
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

@section('js')
    <script>
        $(document).ready(function() {
            $('#dokumenInput').select2();
        })
    </script>
@stop
