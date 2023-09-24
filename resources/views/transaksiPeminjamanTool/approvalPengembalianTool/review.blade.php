@extends('adminlte::page')

@section('title', 'Review Data Pengembalian Tools')

@section('content_header')
    <h1>Review Data Pengembalian Tools</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Tanggal waktu peminjaman</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_peminjaman->tanggal_waktu_pinjam }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Tanggal waktu kembali</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_peminjaman->tanggal_waktu_kembali }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Peminjam</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_peminjaman->user->nama }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Keperluan</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_peminjaman->keperluan }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Lokasi tujuan</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_peminjaman->lokasi_tujuan }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Lokasi peminjaman</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>:</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <iframe width="100%" height="250px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q={{ $data_peminjaman->geolocation_pinjam }}&z=15&output=embed"></iframe>
                        <div class="card-body">
                            <h6 class="text-center">Lokasi pinjam</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <iframe width="100%" height="250px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q={{ $data_peminjaman->geolocation_kembali }}&z=15&output=embed"></iframe>
                        <div class="card-body">
                            <h6 class="text-center">Lokasi kembali</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">List Tools Yang Dipinjam</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center">
                        <tr>
                            <th>Tools</th>
                            <th>Status Kondisi</th>
                            <th>Deskripsi</th>
                            <th>Foto Kondisi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_peminjaman->listTools as $list_tools)
                            <tr>
                                <td>{{ $list_tools->aset->kode_aset . " - " . $list_tools->aset->tool->nama . " " .  $list_tools->aset->tool->merk . " " . $list_tools->aset->tool->model }}</td>
                                <td class="text-center">{{ $list_tools->kondisiToolsTransaksiPeminjaman->status_kondisi }}</td>
                                <td>{{ $list_tools->kondisiToolsTransaksiPeminjaman->deskripsi }}</td>
                                <td class="text-center">
                                    <button type="button" class="mx-2 my-1 btn btn-info" data-toggle="modal" data-target="#modalFotoKondisiSebelum{{ $list_tools->id }}">Sebelum</button>
                                    <button type="button" class="mx-2 my-1 btn btn-info" data-toggle="modal" data-target="#modalFotoKondisiSesudah{{ $list_tools->id }}">Sesudah</button>
                                </td>
                            </tr>

                            <div class="modal fade" id="modalFotoKondisiSebelum{{ $list_tools->id }}" role="dialog">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Foto Kondisi Sebelum</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img class="img-fluid" src="{{ url('storage/' . $list_tools->kondisiToolsTransaksiPeminjaman->foto_sebelum) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="modalFotoKondisiSesudah{{ $list_tools->id }}" role="dialog">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Foto Kondisi Sesudah</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img class="img-fluid" src="{{ url('storage/' . $list_tools->kondisiToolsTransaksiPeminjaman->foto_sesudah) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <a href="{{ url()->previous() }}" class="mr-2 mb-3 btn btn-secondary">Kembali</a>
    @can('approvalPengembalianTools.approval')
        <button type="button" class="mx-2 mb-3 btn btn-primary" data-toggle="modal" data-target="#modalApproval">Approval</button>
    @endcan

    @can('approvalPengembalianTools.approval')
        <div class="modal fade" id="modalApproval" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Approval Data Pengembalian Kendaraan</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('approvalPengembalianTools.approval', $data_peminjaman->id) }}" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Approved?</label>
                                <select class="form-control @error('approved') is-invalid @enderror" name="approved" required>
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
                                @error('approved')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"></textarea>
                                @error('keterangan')
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
