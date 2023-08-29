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
                    <p>Kepemilikan Aset</p>
                </div>
                <div class="col-8 col-md-10">
                    @if ($data_aset->id_kepemilikan_aset != null)
                        <p>: {{ $data_aset->kepemilikanAset->nama }}</p>
                    @else
                        <p>: &minus;</p>
                    @endif
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
                <div class="row">
                    <div class="col-4 col-md-2">
                        <p>KM saat ini</p>
                    </div>
                    <div class="col-8 col-md-10">
                        <p>: {{ $data_aset->kendaraan->km_saat_ini }} KM</p>
                    </div>
                </div>
            @elseif($data_aset->tipe_aset == 'tool')
                {{-- aset tools --}}
                <div class="row">
                    <div class="col-4 col-md-2">
                        <p>Nama</p>
                    </div>
                    <div class="col-8 col-md-10">
                        <p>: {{ $data_aset->tool->nama }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 col-md-2">
                        <p>Merk</p>
                    </div>
                    <div class="col-8 col-md-10">
                        <p>: {{ $data_aset->tool->merk }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 col-md-2">
                        <p>Model</p>
                    </div>
                    <div class="col-8 col-md-10">
                        <p>: {{ $data_aset->tool->model }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 col-md-2">
                        <p>Tools group</p>
                    </div>
                    <div class="col-8 col-md-10">
                        @if ( $data_aset->tool->id_tools_group != null)
                            <p>: {{ $data_aset->tool->toolsGroup->nama }}</p>
                        @else
                            <p>: &minus;</p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 col-md-2">
                        <p>Deskripsi</p>
                    </div>
                    <div class="col-8 col-md-10">
                        <p>: {{ $data_aset->tool->deskripsi }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 col-md-2">
                        <p>Status saat ini</p>
                    </div>
                    <div class="col-8 col-md-10">
                        <p>: {{ $data_aset->tool->status_saat_ini }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 col-md-2">
                        <p>Tersimpan di</p>
                    </div>
                    <div class="col-8 col-md-10">
                        @if ($data_aset->tool->id_gudang != null)
                            <p>: {{ $data_aset->tool->gudang->nama }}</p>
                        @else
                            <p>: &times;</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ url()->previous() }}"><button type="button" class="btn btn-secondary">Kembali</button></a>
        </div>
    </div>
@stop
