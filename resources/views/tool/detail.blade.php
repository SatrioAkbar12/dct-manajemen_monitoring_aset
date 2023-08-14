@extends('adminlte::page')

@section('title', 'Detail Data Tool')

@section('content_header')
    <h1>Detail Data Tool</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Data Tool</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Kode Aset</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_tool->aset->kode_aset }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Nama</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_tool->nama }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Model</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_tool->model }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Tools Group</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_tool->toolsGroup->nama }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Status saat ini</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_tool->status_saat_ini }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Tersimpan di</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_tool->gudang->nama }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Deskripsi</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_tool->deskripsi }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ URL::previous() }}"><button type="button" class="btn btn-secondary">Kembali</button></a>
        </div>
    </div>
@stop
