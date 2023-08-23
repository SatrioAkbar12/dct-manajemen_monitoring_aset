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
                    <p>Foto kondisi tools</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>:</p>
                </div>
            </div>
            @foreach ($data_peminjaman->listTools as $listTools)
                <div class="row">
                    <div class="col-12">
                        <p><b>{{ $listTools->aset->kode_aset . " - " . $listTools->aset->tool->nama . " " . $listTools->aset->tool->merk . " " . $listTools->aset->tool->model }}</b></p>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="card">
                            <img class="card-img-top" src="{{ url('storage/' . $listTools->kondisiToolsTransaksiPeminjaman->foto_sebelum )}}">
                            <div class="card-body">
                                <h6 class="text-center">Foto sebelum</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <img class="card-img-top" src="{{ url('storage/' . $listTools->kondisiToolsTransaksiPeminjaman->foto_sesudah )}}">
                            <div class="card-body">
                                <h6 class="text-center">Foto sesudah</h6>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="card-footer">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
            @can('approvalPengembalianTools.approval')
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalApproval">Approval</button>
            @endcan
        </div>
    </div>

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
