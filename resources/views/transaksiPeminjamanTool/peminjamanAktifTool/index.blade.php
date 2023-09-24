@extends('adminlte::page')

@section('title', 'Peminjaman Aktif Tools')

@section('content_header')
    <h1>Peminjaman Aktif Tools</h1>
@endsection

@section('content')
    <p>Semua data peminjaman tools yang saat ini aktif</p>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Tanggal Waktu Pinjam</th>
                            <th>Target Tanggal Waktu Kembali</th>
                            <th>Peminjam</th>
                            <th>Tools</th>
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
                                <td>{{ $peminjaman_aktif->target_tanggal_waktu_kembali }}</td>
                                <td>{{ $peminjaman_aktif->user->nama }}</td>
                                <td>
                                    <ul>
                                        @foreach ($peminjaman_aktif->listTools as $list_tools)
                                            <li>{{ $list_tools->aset->kode_aset . " - " . $list_tools->aset->tool->nama . " " .  $list_tools->aset->tool->merk . " " . $list_tools->aset->tool->model }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $peminjaman_aktif->keperluan }}</td>
                                <td>{{ $peminjaman_aktif->lokasi_tujuan }}</td>
                                <td class="text-danger">
                                    <ul>
                                        @if($peminjaman_aktif->keterangan_approved != null && $peminjaman_aktif->approved == 0)
                                            <li>{{ $peminjaman_aktif->keterangan_approved }}</li>
                                        @endif
                                        @if (\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $peminjaman_aktif->target_tanggal_waktu_kembali, 'Asia/Jakarta')->lessThan(\Carbon\Carbon::now('Asia/Jakarta')))
                                            <li>
                                                @if(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $peminjaman_aktif->target_tanggal_waktu_kembali, 'Asia/Jakarta')->diffInDays(\Carbon\Carbon::now('Asia/Jakarta'), false) == 0)
                                                    Peminjaman tools sudah melebihi target tanggal waktu pengembalian
                                                @else
                                                    Peminjaman tools sudah melebihi {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $peminjaman_aktif->target_tanggal_waktu_kembali, 'Asia/Jakarta')->diffInDays(\Carbon\Carbon::now('Asia/Jakarta'), false) }} hari dari target tanggal waktu pengembalian
                                                @endif
                                            </li>
                                        @endif
                                    </ul>
                                </td>
                                <td class="text-center">
                                    @can('peminjamanAktifTools.returning')
                                        <a href="{{ route('peminjamanAktifTools.returning', $peminjaman_aktif->id ) }}"><button type="button" class="btn btn-success">Kembalikan</button></a>
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
