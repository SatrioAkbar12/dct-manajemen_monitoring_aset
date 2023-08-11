@extends('adminlte::page')

@section('title', 'Detail Servis Rutin Kendaraan')

@section('content_header')
    <h1>Detail Servis Rutin Kendaraan</h1>
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
                    <p>Jenis kendaraan</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_kendaraan->jenisKendaraan->nama }}</p>
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
                    <p>: {{ $data_kendaraan->tipe}}</p>
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
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Jumlah servis rutin</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $jumlah_servis }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Terakhir servis rutin</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $jumlah_servis != 0 ? $data_servis[0]->tanggal_servis : "-" }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('servisRutin.index') }}"><button type="button" class="btn btn-secondary">Kembali</button></a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">List Servis Rutin Kendaraan</h5>
        </div>
        <div class="card-body">
            @can('servisRutin.store')
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">Tambah data</button>
                <hr>
            @endcan

            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            {{-- <th>Penggantian Oli</th>
                            <th>Cek Aki</th>
                            <th>Cek Rem</th>
                            <th>Cek Kopling</th>
                            <th>Cek Ban</th>
                            <th>Cek Lampu</th>
                            <th>Cek AC</th> --}}
                            <th>Deskripsi</th>
                            <th>KM Target Servis Selanjutnya</th>
                            <th>Tanggal Target Servis Selanjutnya</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_servis as $servis)
                            <tr>
                                <td>{{ $servis->tanggal_servis }}</td>
                                {{-- <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" {{ $servis->penggantian_oli == 1 ? "checked" : "" }} disabled>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" {{ $servis->cek_aki == 1 ? "checked" : "" }} disabled>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" {{ $servis->cek_rem == 1 ? "checked" : "" }} disabled>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" {{ $servis->cek_kopling == 1 ? "checked" : "" }} disabled>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" {{ $servis->cek_ban == 1 ? "checked" : "" }} disabled>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" {{ $servis->cek_lampu == 1 ? "checked" : ""}} disabled>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" {{ $servis->cek_ac == 1 ? "checked" : "" }} disabled>
                                    </div>
                                </td> --}}
                                <td>{{ $servis->detail_servis }}</td>
                                <td>{{ $servis->km_target }}</td>
                                <td>{{ $servis->tanggal_target }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @can('servisRutin.store')
        <div class="modal fade" id="modalCreate" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah data baru</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('servisRutin.store', $data_kendaraan->id) }}" method="POST">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tanggal servis</label>
                                <input type="date" class="form-control @error('tanggal_servis') is-invalid @enderror" name="tanggal_servis" required>
                                @error('tanggal_servis')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" id="penggantianOli" name="penggantian_oli">
                                <label class="form-check-label" for="penggantianOli">Penggantian oli</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" id="cekAki" name="cek_aki">
                                <label class="form-check-label" for="cekAki">Cek aki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" id="cekRem" name="cek_rem">
                                <label class="form-check-label" for="cekRem">Cek rem</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" id="cekKopling" name="cek_kopling">
                                <label class="form-check-label" for="cekKopling">Cek kopling</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" id="cekBan" name="cek_ban">
                                <label class="form-check-label" for="cekBan">Cek ban</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" id="cekLampu" name="cek_lampu">
                                <label class="form-check-label" for="cekLampu">Cek lampu</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" id="cekAc" name="cek_ac">
                                <label class="form-check-label" for="cekAc">Cek AC</label>
                            </div> --}}
                            <div class="from-group">
                                <label>Detail servis</label>
                                <textarea class="form-control @error('detail_servis') is-invalid @enderror" name="detail_servis" required></textarea>
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
