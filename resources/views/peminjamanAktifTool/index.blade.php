@extends('adminlte::page')

@section('title', 'Peminjaman Aktif Tools')

@section('content_header')
    <h1>Peminjaman Aktif Tools</h1>
@endsection

@section('content')
    <p>Semua data peminjaman tools yang saat ini aktif</p>

    <div class="card">
        <div class="card-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">Tambah peminjaman</button>
            <hr>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Tanggal Waktu Pinjam</th>
                            <th>Target Tanggal Waktu Kembali</th>
                            <th>Peminjam</th>
                            <th>Tools</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_peminjaman_aktif as $peminjaman_aktif)
                            <tr>
                                <td>{{ $peminjaman_aktif->tanggal_waktu_pinjam }}</td>
                                <td>{{ $peminjaman_aktif->target_tanggal_waktu_kembali }}</td>
                                <td>{{ $peminjaman_aktif->user->nama }}</td>
                                <td>
                                    <ul>
                                        @foreach ($peminjaman_aktif->listTools as $list_tools)
                                            <li>{{ $list_tools->aset->kode_aset . " - " . $list_tools->aset->tool->nama . " " .  $list_tools->aset->tool->merk . " " . $list_tools->aset->tool->model }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td></td>
                                <td class="text-center">
                                    <a href="{{ route('peminjamanAktifTools.returning', $peminjaman_aktif->id ) }}"><button type="button" class="btn btn-success">Kembalikan</button></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <br>
            <div class="d-flex justify-content-center">
                {{ $data_peminjaman_aktif->links() }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCreate" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Peminjaman Baru</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action={{ route('peminjamanAktifTools.store') }} method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="userInput">Peminjam </label>
                            <select class="form-control @error('user') is-invalid @enderror" id="userInput" name="user" >
                                @foreach ($data_user as $user)
                                    <option value="{{ $user->id }}">{{ $user->nama }}</option>
                                @endforeach
                            </select>
                            @error('user')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="toolsInput">Tools</label>
                            <select class="form-control @error('tools') is-invalid @enderror" id="toolsInput" name="tools[]" multiple="multiple" >
                                @foreach ($data_tools as $tools)
                                    <option value="{{ $tools->id_aset }}">{{ $tools->aset->kode_aset . " - " . $tools->nama . " " . $tools->merk . " " . $tools->model }}</option>
                                @endforeach
                            </select>
                            @error('tools')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tanggal waktu pinjam</label>
                            <input type="datetime-local" class="form-control @error('tanggal_waktu_pinjam') is-invalid @enderror" name="tanggal_waktu_pinjam">
                            @error('tanggal_waktu_pinjam')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Target tanggal waktu kembali</label>
                            <input type="datetime-local" class="form-control @error('target_tanggal_waktu_kembali') is-invalid @enderror" name="target_tanggal_waktu_kembali">
                            @error('target_tanggal_waktu_kembali')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
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
            $('#userInput').select2({
                placeholder: "Pilih user"
            });
            $('#toolsInput').select2({
                placeholder: "Pilih tools yang akan dipinjam"
            });
        });
    </script>
@stop
