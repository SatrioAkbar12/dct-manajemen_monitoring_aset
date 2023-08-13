@extends('adminlte::page')

@section('title', 'Master Data Aset')

@section('content_header')
    <h1>Master Data Aset
@stop

@section('content')
    <p>Semua data tentang aset yang ada</p>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Id</th>
                            <th>Kode Aset</th>
                            <th>Tipe Aset</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_aset as $aset)
                            <tr>
                                <td class="text-center">{{ $aset->id }}</td>
                                <td>{{ $aset->kode_aset }}</td>
                                <td>{{ ucfirst($aset->tipe_aset) }}</td>
                                <td class="text-center">
                                    @can('aset.detail')
                                        <a href="{{ route('aset.detail', $aset->id) }}"><button type="button" class="btn btn-info">Detail</button></a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <br>
            <div class="d-flex justify-content-center">
                {{ $data_aset->links() }}
            </div>
        </div>
    </div>
@stop
