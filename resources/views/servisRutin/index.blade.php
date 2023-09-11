@extends('adminlte::page')

@section('title', 'Servis Rutin Kendaraan')

@section('content_header')
    <h1>Servis Rutin Kendaraan</h1>
@stop

@section('content')
    <p>Semua data tentang servis rutin kendaraan</p>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Id</th>
                            <th>Kode Aset</th>
                            <th>Nomor Polisi</th>
                            <th>Kendaraan</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_kendaraan as $kendaraan)
                            <tr>
                                <td>{{ $kendaraan->id }}</td>
                                <td>{{ $kendaraan->aset->kode_aset }}</td>
                                <td>{{ $kendaraan->nopol }}</td>
                                <td>{{ $kendaraan->jenisKendaraan->nama . " " . $kendaraan->merk . " " . $kendaraan->tipe . " " . $kendaraan->warna }}</td>
                                <td class="text-center">
                                    @if ($kendaraan->servisRutin->count() == 0)
                                        <div class="text-center">Kendaraan perlu dilengkapi data servis rutin kendaraan</div>
                                    @endif
                                    @foreach ($kendaraan->servisRutin as $servis_rutin)
                                        @if($loop->first)
                                            @if($kendaraan->perlu_servis)
                                                <div class="text-danger">Kendaraan perlu dilakukan servis rutin</div>
                                            @else
                                                &minus;
                                            @endif
                                            @break
                                        @endif

                                    @endforeach
                                </td>
                                <td class="text-center">
                                    @can('servisRutin.getKendaraan')
                                        <a href="{{ route('servisRutin.getKendaraan', $kendaraan->id) }}"><button type="button" class="btn btn-info">Detail</button>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <br>
            <div class="d-flex justify-content-center">
                {{ $data_kendaraan->links() }}
            </div>
        </div>
    </div>
@stop

@section('css')
@stop
