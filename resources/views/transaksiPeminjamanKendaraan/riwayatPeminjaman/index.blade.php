@extends('adminlte::page')

@section('title', 'Riwayat Peminjaman Kendaraan')

@section('content_header')
    <h1>Riyawat Peminjaman Kendaraan</h1>
@stop

@section('content')
    <p>Semua riwayat peminjaman kendaraan</p>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Tanggal Waktu Pinjam</th>
                            <th>Tanggal Waktu Kembali</th>
                            <th>Kendaraan</th>
                            <th>Peminjam</th>
                            <th>Keperluan</th>
                            <th>Lokasi Tujuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_riwayat_peminjaman as $riwayat_peminjaman)
                            <tr>
                                <td>{{ $riwayat_peminjaman->tanggal_waktu_pinjam }}</td>
                                <td>{{ $riwayat_peminjaman->tanggal_waktu_kembali }}</td>
                                <td>{{ $riwayat_peminjaman->kendaraan->aset->kode_aset . " - " . $riwayat_peminjaman->kendaraan->nopol . " - " . $riwayat_peminjaman->kendaraan->jenisKendaraan->nama . " " . $riwayat_peminjaman->kendaraan->merk . " " . $riwayat_peminjaman->kendaraan->tipe . " " . $riwayat_peminjaman->kendaraan->warna }}</td>
                                <td>{{ $riwayat_peminjaman->user->nama }}</td>
                                <td>{{ $riwayat_peminjaman->keperluan }}</td>
                                <td>{{ $riwayat_peminjaman->lokasi_tujuan }} KM</td>
                                <td class="text-center">
                                    @can('riwayatPeminjamanKendaraan.detail')
                                        <a href="{{ route('riwayatPeminjamanKendaraan.detail', $riwayat_peminjaman->id) }}"><button type="button" class="btn btn-info">Detail</button></a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <br>
            <div class="d-flex justify-content-center">
                {{ $data_riwayat_peminjaman->links() }}
            </div>
        </div>
    </div>
@stop
