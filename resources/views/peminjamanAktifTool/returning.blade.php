@extends('adminlte::page')

@section('title', 'Pengembalian Tools')

@section('content_header')
    <h1>Pengembalian tools</h1>
@stop

@section('content')
    <div class="card">
        <form action="{{ route('peminjamanAktifTools.update', $data_peminjaman_aktif->id) }}" method="POST">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group">
                    <label>List tools</label>
                    <ul>
                        @foreach ($data_peminjaman_aktif->listTools as $listTools)
                            <li>{{ $listTools->aset->kode_aset . " - " . $listTools->aset->tool->nama . " " . $listTools->aset->tool->merk . " " . $listTools->aset->tool->model }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="form-group">
                    <label>Kembali di gudang</label>
                    <select class="form-control @error('gudang') is-invalid @enderror" id="inputGudang" name="gudang">
                        @foreach ($data_gudang as $gudang)
                            <option value="{{ $gudang->id }}">{{ $gudang->nama }}</option>
                        @endforeach
                    </select>
                    @error('gudang')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                @foreach ($data_peminjaman_aktif->listTools as $listTools)
                    <div class="my-5">
                        <p class="lead">Kondisi {{ $listTools->aset->kode_aset . " - " . $listTools->aset->tool->nama . " " . $listTools->aset->tool->merk . " " . $listTools->aset->tool->model }}</p>
                        <input type="hidden" name="id_list_tools[]" value={{ $listTools->id }}>
                        <div class="form-group">
                            <label>Status kondisi</label>
                            <select class="form-control @error('status_kondisi') is-invalid @enderror" name="status_kondisi[]" required>
                                <option value="Tidak ada kerusakan">Tidak ada kerusakan</option>
                                <option value="Ada kerusakan">Ada kerusakan</option>
                            </select>
                            @error('status_kondisi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi[]" required></textarea>
                            @error('deskripsi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                @can('peminjamanAktifTools.update')
                    <button type="submit" class="btn btn-primary">Simpan</button>
                @endcan
            </div>
        </form>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#inputGudang').select2();
        })
    </script>
@stop
