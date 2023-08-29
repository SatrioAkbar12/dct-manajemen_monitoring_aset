@extends('adminlte::page')

@section('title', 'Master Data User')

@section('content_header')
    <h1>Master Data User</h1>
@stop

@section('content')
    <p>Semua data tentang user</p>

    <div class="card">
        <div class="card-body">
            @can('user.store')
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">Tambah data</button>
                <hr>
            @endcan
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Role</th>
                            <th>Memiliki SIM</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td class="text-center">{{ $d->id }}</td>
                                <td>{{ $d->username }}</td>
                                <td>{{ $d->nama }}</td>
                                <td class="text-center">
                                    @foreach ($d->getRoleNames() as $role_name)
                                        @if( !($loop->first) )
                                            <br>
                                        @endif
                                        {{ $role_name }}
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" {{ $d->memiliki_sim == 1 ? 'checked' : '' }} disabled>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @can('user.del')
                                        <form action="{{ route('user.del', $d->id) }}" method="POST">
                                            {{ csrf_field() }}
                                    @endcan
                                    @can('user.updateRole')
                                            <button type="button" class="my-1 mx-2 btn btn-success" data-toggle="modal" data-target="#modalUpdateRole{{ $d->id }}">Update role</button>
                                    @endcan
                                    @can('user.update')
                                            <a href="{{ route('user.show', $d->id) }}"><button type="button" class="my-1 mx-2 btn btn-info">Update data</button></a>
                                    @endcan
                                    @can('user.del')
                                            <a href="{{ route('user.del', $d->id) }}" class="my-1 mx-2 btn btn-danger" data-confirm-delete="true">Hapus</a>
                                        </form>
                                    @endcan
                                </td>
                            </tr>

                            @can('user.updateRole')
                                <div class="modal fade" id="modalUpdateRole{{ $d->id }}" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Update Role User</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('user.updateRole', $d->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nama role</label>
                                                        <select class="form-control @error('role') is-invalid @enderror" id="roleInputUpdate" name="role">
                                                            @foreach ($data_role as $role)
                                                                <option value="{{ $role->name }}" {{ $d->hasRole( $role->name ) ? "selected" : "" }}>{{ $role->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('role')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    @foreach ($d->getRoleNames() as $role_name)
                                                        @if ($loop->first)
                                                            <input type="hidden" name="former_role" value={{ $role_name }}>
                                                            @break
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endcan
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

    @can('user.store')
        <div class="modal fade" id="modalCreate" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah data baru</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('user.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama')}}" required>
                                @error('nama')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username')}}" required>
                                @error('username')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email')}}" required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-control @error('role') is-invalid @enderror" id="roleInputCreate" name="role" required>
                                    @foreach ($data_role as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Memiliki SIM</label>
                                <select class="form-control @error('memiliki_sim') is-invalid @enderror" name="memiliki_sim" required>
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
                                @error('memiliki_sim')
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
    @endcan
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#roleInputUpdate').select2();
            $('#roleInputCreate').select2();
        })
    </script>
@stop
