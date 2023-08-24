@extends('adminlte::page')

@section('title', 'Approval Pengembalian Tools')

@section('content_header')
    <h1>Approval Pengembalian Tools</h1>
@stop

@section('content')
    <p>Semua data tentang pengembalian tools yang perlu persetujuan</p>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Tanggal Waktu Pinjam</th>
                            <th>Tanggal Waktu Kembali</th>
                            <th>Peminjam</th>
                            <th>Tools</th>
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
                                <td>{{ $peminjaman->tanggal_waktu_pinjam }}</td>
                                <td>{{ $peminjaman->tanggal_waktu_kembali }}</td>
                                <td>{{ $peminjaman->user->nama }}</td>
                                <td>
                                    <ul>
                                        @foreach ($peminjaman->listTools as $listTools)
                                            <li>{{ $listTools->aset->kode_aset . " - " . $listTools->aset->tool->nama . " " . $listTools->aset->tool->merk . " " . $listTools->aset->tool->model }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $peminjaman->keperluan }}</td>
                                @unlessrole('admin')
                                    <td class="text-center text-info">Sedang proses approval oleh admin</td>
                                @endunlessrole
                                @hasrole('admin')
                                    <td class="text-center">
                                        @can('approvalPengembalianTools.review')
                                            <a href="{{ route('approvalPengembalianTools.review', $peminjaman->id) }}" class="btn btn-info">Review</a>
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
