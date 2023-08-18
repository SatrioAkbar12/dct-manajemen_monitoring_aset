@extends('adminlte::page')

@section('title', 'Pengembalian Tools')

@section('content_header')
    <h1>Pengembalian tools</h1>
@stop

@section('content')
    <div class="card">
        <form action="{{ route('peminjamanAktifTools.update', $data_peminjaman_aktif->id) }}" method="POST">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group">
                    <label>List tools</label>
                    <ul>
                        @foreach ($data_peminjaman_aktif->listTools as $listTools)
                            <li>{{ $listTools->aset->kode_aset . " - " . $listTools->aset->tool->nama . " " . $listTools->aset->tool->merk . " " . $listTools->aset->tool->model }}</li>
                        @endforeach
                    </ul>
                </div>
                @foreach ($data_peminjaman_aktif->listTools as $listTools)
                    <div class="my-5">
                        <p class="lead">Kondisi {{ $listTools->aset->kode_aset . " - " . $listTools->aset->tool->nama . " " . $listTools->aset->tool->merk . " " . $listTools->aset->tool->model }}</p>
                        <div class="form-group">
                            <label>Status kondisi</label>
                            <select class="form-control @error('status_kondisi') is-invalid @enderror" name="status_kondisi" required>
                                <option value="Tidak ada kerusakan">Tidak ada kerusakan</option>
                                <option value="Ada kerusakan">Ada kerusakan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" required></textarea>
                        </div>
                    </div>
                @endforeach
            </div>
        </form>
    </div>
@stop
