@extends('adminlte::page')

@section('title', 'Master Data User')

@section('content_header')
    <h1>Master Data User</h1>
@stop

@section('content')
    <p>Semua data tentang user</p>

    <div class="card">
        <div class="card-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">Tambah data</button>
            <hr>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Memiliki SIM</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $d->id }}</td>
                                <td>{{ $d->username }}</td>
                                <td>{{ $d->nama }}</td>
                                <td class="text-center">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" {{ $d->memiliki_sim == 1 ? 'checked' : '' }} disabled>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('user.del', $d->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        <a href="{{ route('user.show', $d->id) }}"><button type="button" class="btn btn-warning">Update</button></a>
                                        <button type="button" class="btn btn-danger" id="btnDeleteConfirm{{ $d->id }}">Delete</button>
                                    </form>
                                </td>
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
                            <input type="text" class="form-control" name="nama" value="{{ old('nama')}}" required>
                            @error('nama')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" value="{{ old('username')}}" required>
                            @error('username')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email')}}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" required>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Memiliki SIM</label>
                            <select class="form-control" name="memiliki_sim" required>
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
@stop

@section('css')
@stop

@section('js')
<script>
    $(document).ready(function() {
        @foreach ($data as $d)
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
