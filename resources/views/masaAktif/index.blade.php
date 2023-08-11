@extends('adminlte::page')

@section('title', 'Masa Aktif Dokumen Kendaraan')

@section('content_header')
    <h1>Masa Aktif Dokumen Kendaraan</h1>
@stop

@section('content')
    <p>Semua masa aktif dokumen dari tiap kendaraan</p>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Id</th>
                            <th>Nomor Polisi</th>
                            <th>Kendaraan</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_kendaraan as $kendaraan)
                            <tr>
                                <td>{{ $kendaraan->id }}</td>
                                <td>{{ $kendaraan->nopol }}</td>
                                <td>{{ $kendaraan->jenisKendaraan->nama . " " . $kendaraan->merk . " " . $kendaraan->tipe . " " . $kendaraan->warna }}</td>
                                <td>
                                    @if($kendaraan->masaAktifDokumen->count() == 0)
                                        <div class="text-center">Kendaraan perlu dilengkapi data dokumen kendaraan</div>
                                    @endif
                                    <ul class="text-danger">
                                        @foreach ($kendaraan->masaAktifDokumen as $dokumen)
                                            @if(\Carbon\Carbon::createFromFormat('Y-m-d', $dokumen->tanggal_masa_berlaku, 'Asia/Jakarta')->diffInDays(\Carbon\Carbon::now('Asia/Jakarta'), false) >= -7)
                                                <li>{{ $dokumen->tipeDokumen->nama_dokumen }} perlu diperpanjang sebelum tanggal {{ $dokumen->tanggal_masa_berlaku }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="text-center">
                                    @can('masaAktifDokumen.getKendaraan')
                                        <a href="{{ route('masaAktifDokumen.getKendaraan', $kendaraan->id) }}"><button type="button" class="btn btn-info">Detail</button>
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
