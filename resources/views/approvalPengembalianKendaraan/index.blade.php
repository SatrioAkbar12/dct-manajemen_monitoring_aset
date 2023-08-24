@extends('adminlte::page')

@section('title', 'Approval Pengembalian Kendaraan')

@section('content_header')
    <h1>Approval Pengembalian Kendaraan</h1>
@stop

@section('content')
    <p>Semua data tentang pengembalian kendaraan yang perlu persetujuan</p>

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
                            @unlessrole('admin')
                                <th>Keterangan</th>
                            @endunlessrole
                            @hasrole('admin')
                                <th>Aksi</th>
                            @endhasrole
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_peminjaman as $peminjaman)
                            <tr>
                                <td class="text-center">{{ $peminjaman->tanggal_waktu_pinjam }}</td>
                                <td class="text-center">{{ $peminjaman->tanggal_waktu_kembali }}</td>
                                <td>{{ $peminjaman->kendaraan->nopol . " - " . $peminjaman->kendaraan->merk . " " . $peminjaman->kendaraan->tipe . " " . $peminjaman->kendaraan->warna }}</td>
                                <td>{{ $peminjaman->user->nama }}</td>
                                <td>{{ $peminjaman->keperluan}}</td>
                                @unlessrole('admin')
                                    <td class="text-center text-info">Sedang proses approval oleh admin</td>
                                @endunlessrole
                                @hasrole('admin')
                                    <td class="text-center">
                                        @can('approvalPengembalianKendaraan.review')
                                            <a href="{{ route('approvalPengembalianKendaraan.review', $peminjaman->id) }}" class="btn btn-info">Review</a>
                                        @endcan
                                    </td>
                                @endhasrole
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <br>
            <div class="d-flex justify-content-center">
                {{ $data_peminjaman->links() }}
            </div>
        </div>
    </div>
@stop
