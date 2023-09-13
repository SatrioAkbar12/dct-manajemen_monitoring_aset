@extends('adminlte::page')

@section('title', 'Reporting - Statistik Peminjaman User')

@section('content_header')
    <h1>Statistik Peminjaman User</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>User</th>
                            <th>Jumlah peminjaman kendaraan</th>
                            <th>Jumlah peminjaman tools</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_user as $user)
                            <tr>
                                <td>{{ $user->nama }}</td>
                                <td class="text-center">{{ $user->transaksiPeminjamanKendaraan->count() }}</td>
                                <td class="text-center">{{ $user->transaksiPeminjamanTools->count() }}</td>
                                <td class="text-center">
                                    <a href="" class="mx-2 my-1 btn btn-info">Statistik Kendaraan</a>
                                    <a href="" class="mx-2 my-1 btn btn-info">Statistik Tools</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <br>
            <div class="d-flex justify-content-center">
                {{ $data_user->links() }}
            </div>
        </div>
    </div>
@stop
