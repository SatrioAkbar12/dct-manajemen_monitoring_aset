@extends('adminlte::page')

@section('title', 'Master Data Role Permission')

@section('content_header')
    <h1>Master Data Role Permission</h1>
@stop

@section('content')
    <p>Semua data tentang permission tiap role yang ada</p>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Id</th>
                            <th>Nama Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_role as $role)
                            <tr>
                                <td class="text-center">{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td class="text-center">
                                    @can('rolePermission.detail')
                                        <a href="{{ route('rolePermission.detail', $role->id) }}"><button type="button" class="btn btn-info">Detail</button>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <br>
            <div class="d-flex justify-content-center">
                {{ $data_role->links() }}
            </div>
        </div>
    </div>
@stop
