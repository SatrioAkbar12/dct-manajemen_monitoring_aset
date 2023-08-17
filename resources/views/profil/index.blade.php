@extends('adminlte::page')

@section('title', 'Data Profil')

@section('content_header')
    <h1>Data Profil</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Detail data profil</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Nama profil</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data->nama }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Username</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data->username }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Role</p>
                </div>
                <div class="col-8 col-md-10">
                    @foreach ($data->getRoleNames() as $role)
                        <p>: {{ $role }}</p>
                        @break
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Email</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data->email }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Memiliki SIM</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>:
                        @if ($data->memiliki_sim == 1)
                            Ya
                        @else
                            Tidak
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ url()->previous() }}" class=" btn btn-secondary">Kembali</a>
            <button type="button" class=" btn btn-success" data-toggle="modal" data-target="#modalUpdate">Update data</button>
            <button type="button" class=" btn btn-info" data-toggle="modal" data-target="#modalUpdatePass">Update Password</button>
        </div>
    </div>

    <div class="modal fade" id="modalUpdate" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('profile.update') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $data->nama }}" required>
                            @error('nama')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $data->username }}" required>
                            @error('username')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $data->email }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Memiliki SIM</label>
                            <select class="form-control @error('memiliki_sim') is-invalid @enderror" name="memiliki_sim">
                                <option value="1" {{ $data->memiliki_sim == 1 ? 'selected' : '' }}>Ya</option>
                                <option value="0" {{ $data->memiliki_sim == 0 ? 'selected' : '' }}>Tidak</option>
                            </select>
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

    <div class="modal fade" id="modalUpdatePass" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update password</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('profile.updatePassword') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Password lama</label>
                            <input type="password" class="form-control @error('password_lama') is-invalid @enderror" name="password_lama" required>
                        </div>
                        <div class="form-group">
                            <label>Password baru</label>
                            <input type="password" class="form-control @error('password_baru') is-invalid @enderror" name="password_baru" required>
                        </div>
                        <div class="form-group">
                            <label>Masukkan password baru kembali</label>
                            <input type="password" class="form-control @error('password_baru_confirmation') is-invalid @enderror" name="password_baru_confirmation" required>
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
