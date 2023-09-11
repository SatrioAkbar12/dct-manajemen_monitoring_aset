@extends('adminlte::page')

@section('title', 'Telegram Data')

@section('content_header')
    <h1>Telegram Data</h1>
@stop

@section('content')
    <p>Semua data tentang telegram yang digunakan untuk tempat mengirimkan notifikasi</p>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Tipe</th>
                            <th>Id Telegram</th>
                            <th>Username</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_telegram as $telegram)
                            <tr class="text-center">
                                <td>{{ $telegram->tipe }}</td>
                                <td>{{ $telegram->id_telegram }}</td>
                                <td>{{ $telegram->username }}</td>
                                <td>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalUpdate{{ $telegram->id }}">Update</button>
                                </td>
                            </tr>

                            <div class="modal fade" id="modalUpdate{{ $telegram->id }}" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Update data</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <form action="{{ route('telegramData.update', $telegram->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Tipe</label>
                                                    <input type="text" class="form-control" name="tipe" value="{{ $telegram->tipe }}" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Id Telegram</label>
                                                    <input type="text" class="form-control @error('id_telegram') is-invalid @enderror" name="id_telegram" value="{{ $telegram->id_telegram }}" placeholder="-1234567" {{ $telegram->tipe == 'group' ? 'required' : '' }}>
                                                    @error('id_telegram')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                @if ($telegram->tipe != 'group')
                                                    <div class="form-group">
                                                        <label>Username</label>
                                                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $telegram->username }}" placeholder="@Username . . .">
                                                        @error('username')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="text-info">
                                                        <i>Harap minimal isi salah satu input form antara Id Telegram atau Username</i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
