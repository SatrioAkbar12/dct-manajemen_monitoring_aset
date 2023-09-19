@extends('adminlte::page')

@section('title', 'Reporting - Detail Statistik Penggunaan Tools')

@section('content_header')
    <h1>Detail Statistik Penggunaan Tools</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Tools</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4 col-md-2">
                    Kode aset
                </div>
                <div class="col-8 col-md-10">
                    : {{ $data_aset->kode_aset }}
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    Tools Group
                </div>
                <div class="col-8 col-md-10">
                    : {{ $data_aset->tool->toolsGroup->nama }}
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    Nama tool
                </div>
                <div class="col-8 col-md-10">
                    : {{ $data_aset->tool->nama }}
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    Merk
                </div>
                <div class="col-8 col-md-10">
                    : {{ $data_aset->tool->merk }}
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    Model
                </div>
                <div class="col-8 col-md-10">
                    : {{ $data_aset->tool->model }}
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    Total penggunaan
                </div>
                <div class="col-8 col-md-10">
                    : {{ $data_aset->listToolsTransaksiPeminjaman->count() }}
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    Total penggunaan bulan ini
                </div>
                <div class="col-8 col-md-10">
                    : {{ $jumlah_penggunaan_bulan_ini }}
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Statistik Pengguna Tools</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center">
                        <tr>
                            <th>User</th>
                            <th>Jumlah penggunaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_aset->statistikPenggunaanAset as $statistik)
                            @if ($statistik->user != null)
                                <tr>
                                    <td>{{ $statistik->user->nama }}</td>
                                    <td class="text-center">{{ $statistik->jumlah }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
