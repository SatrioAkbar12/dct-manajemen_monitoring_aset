@extends('adminlte::page')

@section('title', 'Reporting - Statistik Penggunaan Kendaraan')

@section('content_header')
    <h1>Statistik Penggunaan Kendaraan</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Kode Aset</th>
                            <th>Kendaraan</th>
                            <th>Jumlah penggunaan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_aset as $aset)
                            <tr>
                                <td class="text-center">{{ $aset->kode_aset }}</td>
                                <td>{{ $aset->kendaraan->nopol . ' - ' . $aset->kendaraan->merk . ' ' . $aset->kendaraan->tipe . ' ' . $aset->kendaraan->warna }}</td>
                                <td class="text-center">{{ $aset->kendaraan->transaksiPeminjamanKendaraan->count() }}</td>
                                <td class="text-center">
                                    @can('reporting.statistikPenggunaanKendaraan.detail')
                                        <a href="{{ route('reporting.statistikPenggunaanKendaraan.detail', $aset->id) }}" class="btn btn-info">Detail</a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <br>
            <div class="d-flex justify-content-center">
                {{ $data_aset->links() }}
            </div>
        </div>
    </div>
@stop
