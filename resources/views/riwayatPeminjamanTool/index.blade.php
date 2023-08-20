@extends('adminlte::page')

@section('title', 'Riwayat Peminjaman Tools')

@section('content_header')
    <h1>Riwayat Peminjaman Tools</h1>
@stop

@section('content')
    <p>Semua data tentang riwayat peminjaman tools</p>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="text-center">
                <tr>
                    <th>Tanggal Waktu Peminjaman</th>
                    <th>Tanggal Waktu Kembali</th>
                    <th>Peminjam</th>
                    <th>Tools</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_riwayat_peminjaman as $riwayat_peminjaman)
                    <tr>
                        <td class="text-center">{{ $riwayat_peminjaman->tanggal_waktu_pinjam }}</td>
                        <td class="text-center">{{ $riwayat_peminjaman->tanggal_waktu_kembali }}</td>
                        <td>{{ $riwayat_peminjaman->user->nama }}</td>
                        <td>
                            <ul>
                                @foreach ($riwayat_peminjaman->listTools as $list_tools)
                                    <li>{{ $list_tools->aset->kode_aset . " - " . $list_tools->aset->tool->nama . " " .  $list_tools->aset->tool->merk . " " . $list_tools->aset->tool->model }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="text-center">
                            @can('riwayatPeminjamanTools.detail')
                                <a href="{{ route('riwayatPeminjamanTools.detail', $riwayat_peminjaman->id) }}" class="btn btn-info">Detail</a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
