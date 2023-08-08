@extends('adminlte::page')

@section('title', 'Detail Role Permission')

@section('content_header')
    <h1>Detail Role Permission</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Data Role</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Nama role</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_role->name }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Jumlah permission</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_role->permissions->count() }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2">
                    <p>Jumlah user</p>
                </div>
                <div class="col-8 col-md-10">
                    <p>: {{ $data_role->users->count() }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('rolePermission.index') }}"><button type="button" class="btn btn-secondary">Kembali</button></a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">List Permission</h5>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">Tambah permission</button>
            <hr>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Permission</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_role->permissions as $list_permissions)
                                <tr>
                                    <td>{{ $list_permissions->id }}</td>
                                    <td>{{ $list_permissions->name }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('rolePermission.del', $data_role->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="permission" value="{{ $list_permissions->name }}">
                                            <button type="button" class="btn btn-danger" id="btnDeleteConfirm{{ $list_permissions->id }}">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCreate" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah permission baru</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('rolePermission.store', $data_role->id) }}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Permission</label>
                            <select class="form-control @error('permission') is-invalid @enderror" name="permission" required>
                                @foreach ($data_permission as $permission)
                                    @if(!($data_role->hasPermissionTo($permission->name)))
                                        <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('permission')
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

@section('js')
    <script>
        $(document).ready(function() {
            @foreach ($data_role->permissions as $d)
                $('#btnDeleteConfirm{{ $d->id }}').click(function() {
                    var form = $(this).closest("form")

                    Swal.fire({
                        title: 'Apakah anda yakin?',
                        text: "Anda akan menghapus data",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya',
                        cancelButtonText: 'Tidak',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire(
                                'Terhapus!',
                                'Data telah terhapus',
                                'success'
                            )
                            form.submit()
                        }
                    })
                })
            @endforeach
        })
    </script>
@stop
