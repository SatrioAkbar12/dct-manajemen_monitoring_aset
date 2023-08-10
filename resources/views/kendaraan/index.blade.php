@extends('adminlte::page')

@section('title', 'Master Data Kendaraan')

@section('content_header')
    <h1>Master Data Kendaraan</h1>
@stop

@section('content')
    <p>Semua data mengenai aset kendaraan yang dimiliki</p>

    <div class="card">
        <div class="card-body">
            @can('kendaraan.index')
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">Tambah data</button>
                <hr>
            @endcan

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Nomor Polisi</th>
                            <th>Jenis Kendaraan</th>
                            <th>Merk</th>
                            <th>Tipe</th>
                            <th>Warna</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $d->nopol}}</td>
                                <td>{{ $d->jenisKendaraan->nama }}</td>
                                <td>{{ $d->merk }}</td>
                                <td>{{ $d->tipe }}</td>
                                <td>{{ $d->warna }}</td>
                                <td class="text-center">
                                    @can('kendaraan.del')
                                        <form action="{{ route('kendaraan.del', $d->id) }}" method="POST">
                                            {{ csrf_field() }}
                                    @endcan
                                    @can('kendaraan.update')
                                            <a href="{{ route('kendaraan.show', $d->id) }}"><button type="button" class="btn btn-warning">Update</button></a>
                                    @endcan
                                    @can('kendaraan.del')
                                            <button type="button" class="btn btn-danger" id="btnDeleteConfirm{{ $d->id }}">Delete</button>
                                        </form>
                                    @endcan
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

    @can('kendaraan.store')
        <div class="modal fade" id="modalCreate" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah data baru</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('kendaraan.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nomor Polisi</label>
                                <input type="text" class="form-control @error('nopol') is-invalid @enderror" name="nopol" required>
                                @error('nopol')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Jenis kendaraan</label>
                                <select class="form-control @error('jenis_kendaraan') is-invalid @enderror" name="jenis_kendaraan" required>
                                    @foreach ($data_jenis_kendaraan as $jenis_kendaraan)
                                        <option value="{{ $jenis_kendaraan->id }}">{{ $jenis_kendaraan->nama }}</option>
                                    @endforeach
                                </select>
                                @error('jenis_kendaraan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Merk</label>
                                <input type="text" class="form-control @error('merk') is-invalid @enderror" name="merk" required>
                                @error('merk')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Tipe</label>
                                <input type="text" class="form-control @error('tipe') is-invalid @enderror" name="tipe" required>
                                @error('tipe')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Warna</label>
                                <input type="text" class="form-control @error('warna') is-invalid @enderror" name="warna" required>
                                @error('warna')
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
