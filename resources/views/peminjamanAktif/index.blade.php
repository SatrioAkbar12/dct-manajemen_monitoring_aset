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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">Tambah peminjaman</button>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Tanggal Pinjam</th>
                            <th>Kendaraan</th>
                            <th>Peminjam</th>
                            <th>Target Tanggal Waktu Kembali</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_peminjaman_aktif as $peminjaman_aktif)
                            <tr>
                                <td>{{ $peminjaman_aktif->created_at }}</td>
                                <td>{{ $peminjaman_aktif->kendaraan->nopol . " - " . $peminjaman_aktif->kendaraan->jenis_kendaraan . " " . $peminjaman_aktif->kendaraan->merk . " " . $peminjaman_aktif->kendaraan->warna }}</td>
                                <td>{{ $peminjaman_aktif->user->nama }}</td>
                                <td>{{ $peminjaman_aktif->target_tanggal_waktu_kembali }}</td>
                                <td class="text-center">
                                    <a href="{{ route('peminjamanAktif.returning', $peminjaman_aktif->id) }}"><button type="button" class="btn btn-success">Selesaikan</button></a>
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

    <div class="modal fade" id="modalCreate" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah peminjaman baru</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('peminjamanAktif.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="userPeminjam">Peminjam</label>
                            <select class="form-control" id="userPeminjam" name="user" required>
                                @foreach ($data_user as $user)
                                    <option value="{{ $user->id }}">{{ $user->nama }}</option>
                                @endforeach
                            </select>
                            @error('user')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- <div class="form-group">
                            <label for="userPeminjam">Peminjam</label>
                            <select class="form-control select2multiple" id="userPeminjam" name="user" multiple="multiple">
                                @foreach ($data_user as $user)
                                    <option value="{{ $user->id }}">{{ $user->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <x-adminlte-select label="Test select" name="selBasic">
                            <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                        </x-adminlte-select>

                        <x-adminlte-select2 label="Test select2" name="sel2Basic">
                            <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                        </x-adminlte-select2> --}}

                        <div class="form-group">
                            <label>Kendaraan</label>
                            <select class="form-control" name="kendaraan" required>
                                @foreach ($data_kendaraan as $kendaraan)
                                    <option value="{{ $kendaraan->id }}">{{ $kendaraan->nopol . " - " . $kendaraan->jenis_kendaraan . " " . $kendaraan->merk . " " . $kendaraan->warna }}</option>
                                @endforeach
                            </select>
                            @error('kendaraan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Target tanggal waktu kembali</label>
                            <input type="datetime-local" class="form-control" name="target_tanggal_waktu_kembali" required>
                            @error('target_tanggal_waktu_kembali')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    {{-- <style>
        .select2-container{
            width: 1120.74px;
            border: 1px solid #ccc!important;
            padding: 5px;
        }
    </style> --}}

    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
@endsection


@section('js')
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> --}}
    {{-- <script>
        $(document).ready(function() {
            $('.select2').select2();
            $('.select2multiple').select2();
        });
    </script> --}}
@stop
