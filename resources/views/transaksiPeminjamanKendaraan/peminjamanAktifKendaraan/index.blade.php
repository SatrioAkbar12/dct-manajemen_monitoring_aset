@extends('adminlte::page')

@section('plugins.Select2', true)

@section('title', 'Peminjaman Aktif')

@section('content_header')
    <h1>Peminjaman Kendaraan Aktif</h1>
@stop

@section('content')
    <p>Semua data peminjaman kendaraan yang aktif saat ini</p>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Tanggal Waktu Pinjam</th>
                            <th>Kendaraan</th>
                            <th>Peminjam</th>
                            <th>Target Tanggal Waktu Kembali</th>
                            <th>Keperluan</th>
                            <th>Lokasi Tujuan</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_peminjaman_aktif as $peminjaman_aktif)
                            <tr>
                                <td>{{ $peminjaman_aktif->tanggal_waktu_pinjam }}</td>
                                <td>{{ $peminjaman_aktif->kendaraan->nopol . " - " . $peminjaman_aktif->kendaraan->jenisKendaraan->nama . " " . $peminjaman_aktif->kendaraan->merk . " " . $peminjaman_aktif->kendaraan->tipe . " " . $peminjaman_aktif->kendaraan->warna }}</td>
                                <td>{{ $peminjaman_aktif->user->nama }}</td>
                                <td>{{ $peminjaman_aktif->target_tanggal_waktu_kembali }}</td>
                                <td>{{ $peminjaman_aktif->keperluan }}</td>
                                <td>{{ $peminjaman_aktif->lokasi_tujuan }}</td>
                                <td class="text-danger">
                                    <ul>
                                        @if($peminjaman_aktif->keterangan_approval_pengembalian != null && $peminjaman_aktif->approval_pengembalian == 0)
                                            <li>Pengembalian tidak diapproved :<br>{{ $peminjaman_aktif->keterangan_approval_pengembalian }}</li>
                                        @endif
                                        @if (\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $peminjaman_aktif->target_tanggal_waktu_kembali, 'Asia/Jakarta')->lessThan(\Carbon\Carbon::now('Asia/Jakarta')))
                                            <li>
                                                @if(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $peminjaman_aktif->target_tanggal_waktu_kembali, 'Asia/Jakarta')->diffInDays(\Carbon\Carbon::now('Asia/Jakarta'), false) == 0)
                                                    Kendaraan sudah melebihi target tanggal waktu pengembalian
                                                @else
                                                    Kendaraan sudah melebihi {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $peminjaman_aktif->target_tanggal_waktu_kembali, 'Asia/Jakarta')->diffInDays(\Carbon\Carbon::now('Asia/Jakarta'), false) }} hari dari target tanggal waktu pengembalian
                                                @endif
                                            </li>
                                        @endif
                                    </ul>

                                </td>
                                <td class="text-center">
                                    @can('peminjamanAktifKendaraan.returning')
                                        <a href="{{ route('peminjamanAktifKendaraan.returning', $peminjaman_aktif->id) }}"><button type="button" class="btn btn-success">Selesaikan</button></a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <br>
            <div class="d-flex justify-content-center">
                {{ $data_peminjaman_aktif->links() }}
            </div>
        </div>
    </div>
@stop
