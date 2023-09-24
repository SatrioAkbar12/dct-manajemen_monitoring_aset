@extends('adminlte::page')

@section('title', 'Master Data Kendaraan')

@section('content_header')
    <h1>Master Data Kendaraan</h1>
@stop

@section('content')
    <p>Semua data mengenai aset kendaraan yang dimiliki</p>

    <div class="card">
        <div class="card-body">
            @can('kendaraan.index')
                <button type="button" class="mx-1 btn btn-primary" data-toggle="modal" data-target="#modalCreate">Tambah data</button>
            @endcan
            @can('kendaraan.storeExist')
                <button type="button" class="mx-1 btn btn-primary" data-toggle="modal" data-target="#modalCreateExist">Tambah data yang telah ada</button>
            @endcan
            <hr>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Kode Aset</th>
                            <th>Nomor Polisi</th>
                            <th>Jenis Kendaraan</th>
                            <th>Merk</th>
                            <th>Tipe</th>
                            <th>Warna</th>
                            <th>KM saat ini</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $d->aset->kode_aset }}</td>
                                <td>{{ $d->nopol}}</td>
                                <td>{{ $d->jenisKendaraan->nama }}</td>
                                <td>{{ $d->merk }}</td>
                                <td>{{ $d->tipe }}</td>
                                <td>{{ $d->warna }}</td>
                                <td class="text-center">{{ number_format($d->km_saat_ini, 0 , ".", ".") }}</td>
                                <td class="text-center">
                                    @can('kendaraan.update')
                                        <a href="{{ route('kendaraan.show', $d->id) }}"><button type="button" class="mx-2 my-1 btn btn-info">Update</button></a>
                                    @endcan
                                    @can('kendaraan.del')
                                        <a href="{{ route('kendaraan.del', $d->id) }}" class="mx-2 my-1 btn btn-danger" data-confirm-delete="true">Delete</a>
                                    @endcan
                                </td>
                            </tr>
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

    @can('kendaraan.store')
        <div class="modal fade" id="modalCreate" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah data baru</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('kendaraan.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <h5 class="lead">Data Kendaraan</h5>
                            </div>
                            <div class="form-group">
                                <label>Kepemilikan aset</label>
                                <select class="form-control @error('kepemilikan_aset') is-invalid @enderror" id="kepemilikanAsetInput" name="kepemilikan_aset" required>
                                    @foreach ($data_kepemilikan_aset as $kepemilikan_aset)
                                        <option value={{ $kepemilikan_aset->id }}>{{ $kepemilikan_aset->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kepemilikan_aset')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nomor Polisi</label>
                                <input type="text" class="form-control @error('nopol') is-invalid @enderror" name="nopol" required>
                                @error('nopol')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Jenis kendaraan</label>
                                <select class="form-control @error('jenis_kendaraan') is-invalid @enderror" id="jenisKendaraanInput" name="jenis_kendaraan" required>
                                    @foreach ($data_jenis_kendaraan as $jenis_kendaraan)
                                        <option value="{{ $jenis_kendaraan->id }}">{{ $jenis_kendaraan->nama }}</option>
                                    @endforeach
                                </select>
                                @error('jenis_kendaraan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Merk</label>
                                <input type="text" class="form-control @error('merk') is-invalid @enderror" name="merk" required>
                                @error('merk')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Tipe</label>
                                <input type="text" class="form-control @error('tipe') is-invalid @enderror" name="tipe" required>
                                @error('tipe')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Warna</label>
                                <input type="text" class="form-control @error('warna') is-invalid @enderror" name="warna" required>
                                @error('warna')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>KM saat ini</label>
                                <input type="number" class="form-control @error('km_saat_ini') is-invalid @enderror" name="km_saat_ini" required>
                                @error('km_saat_ini')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- <div class="form-group">
                                <h5 class="lead">Servis Rutin Kendaraan</h5>
                            </div>
                            <div class="form-group">
                                <label>Tanggal servis rutin terakhir</label>
                                <input type="date" class="form-control @error('tanggal_servis_terakhir') is-invalid @enderror" name="tanggal_servis_terakhir" required>
                                @error('tanggal_servis_terakhir')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>KM target servis</label>
                                <input type="number" class="form-control @error('km_target_servis') is-invalid @enderror" name="km_target_servis" required>
                                @error('km_target_servis')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div> --}}
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

    @can('kendaraan.storeExist')
        <div class="modal fade" id="modalCreateExist" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah data yang telah ada</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('kendaraan.storeExist') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <h5 class="lead">Data Kendaraan</h5>
                            </div>
                            <div class="form-group">
                                <label>Kode aset</label>
                                <input type="text" class="form-control @error('kode_aset') is-invalid @enderror" name="kode_aset" required>
                                @error('kode_aset')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nomor Polisi</label>
                                <input type="text" class="form-control @error('nopol') is-invalid @enderror" name="nopol" required>
                                @error('nopol')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Jenis kendaraan</label>
                                <select class="form-control @error('jenis_kendaraan') is-invalid @enderror" id="jenisKendaraanInput" name="jenis_kendaraan" required>
                                    @foreach ($data_jenis_kendaraan as $jenis_kendaraan)
                                        <option value="{{ $jenis_kendaraan->id }}">{{ $jenis_kendaraan->nama }}</option>
                                    @endforeach
                                </select>
                                @error('jenis_kendaraan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Merk</label>
                                <input type="text" class="form-control @error('merk') is-invalid @enderror" name="merk" required>
                                @error('merk')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Tipe</label>
                                <input type="text" class="form-control @error('tipe') is-invalid @enderror" name="tipe" required>
                                @error('tipe')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Warna</label>
                                <input type="text" class="form-control @error('warna') is-invalid @enderror" name="warna" required>
                                @error('warna')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>KM saat ini</label>
                                <input type="number" class="form-control @error('km_saat_ini') is-invalid @enderror" name="km_saat_ini" required>
                                @error('km_saat_ini')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- <div class="form-group">
                                <h5 class="lead">Servis Rutin Kendaraan</h5>
                            </div>
                            <div class="form-group">
                                <label>Tanggal servis rutin terakhir</label>
                                <input type="date" class="form-control @error('tanggal_servis_terakhir') is-invalid @enderror" name="tanggal_servis_terakhir" required>
                                @error('tanggal_servis_terakhir')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>KM target servis</label>
                                <input type="number" class="form-control @error('km_target_servis') is-invalid @enderror" name="km_target_servis" required>
                                @error('km_target_servis')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div> --}}
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
            $('#kepemilikanAsetInput').select2();
            $('#jenisKendaraanInput').select2();
        })
    </script>
@stop
