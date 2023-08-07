@extends('adminlte::page')

@section('title', 'Master Data Permission')

@section('content_header')
    <h1>Master Data Permission</h1>
@stop

@section('content')
    <p>Semua data tentang permission yang ada</p>

    <div class="card">
        <div class="card-body">
            <a href="{{ route('permission.permissionSync') }}"><button type="button" class="btn btn-primary">Sinkronisasi permission</button></a>
            <hr>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nama permission</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $d->id }}</td>
                                <td>{{ $d->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <br>
            <div class="d-flex justify-content-center">
                {{ $data->links() }}
            </div>
        </div>
    </div>
@stop
