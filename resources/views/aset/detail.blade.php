@extends('adminlte::page')

@section('title', 'Detail Master Data Aset')

@section('content_header')
    <h1>Detail Master Data Aset</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Data Aset</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Kode aset</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_aset->kode_aset }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Tipe aset</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ ucfirst($data_aset->tipe_aset) }}</p>
                </div>
            </div>
            @if ($data_aset->tipe_aset == 'kendaraan')
                <div class="row">
                    <div class="col-4 col-md-2">
                        <p>Nomor polisi</p>
                    </div>
                    <div class="col-8 col-md-10">
                        <p>: {{ $data_aset->kendaraan->nopol }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 col-md-2">
                        <p>Jenis kendaraan</p>
                    </div>
                    <div class="col-8 col-md-10">
                        <p>: {{ $data_aset->kendaraan->jenisKendaraan->nama }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 col-md-2">
                        <p>Merk</p>
                    </div>
                    <div class="col-8 col-md-10">
                        <p>: {{ $data_aset->kendaraan->merk}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 col-md-2">
                        <p>Tipe</p>
                    </div>
                    <div class="col-8 col-md-10">
                        <p>: {{ $data_aset->kendaraan->tipe }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 col-md-2">
                        <p>Warna</p>
                    </div>
                    <div class="col-8 col-md-10">
                        <p>: {{ $data_aset->kendaraan->warna }}
                    </div>
                </div>
            @else
                {{-- aset tools --}}
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ url()->previous() }}"><button type="button" class="btn btn-secondary">Kembali</button></a>
        </div>
    </div>
@stop
