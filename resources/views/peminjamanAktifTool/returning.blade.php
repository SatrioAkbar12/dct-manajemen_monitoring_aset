@extends('adminlte::page')

@section('title', 'Pengembalian Tools')

@section('content_header')
    <h1>Pengembalian tools</h1>
@stop

@section('content')
    <div class="card">
        <form action="{{ route('peminjamanAktifTools.update', $data_peminjaman_aktif->id) }}" method="POST" enctype="multipart/form-data">
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
                            <option value="{{ $gudang->id }}" {{ old('gudang') == $gudang->id ? 'selected' : '' }}>{{ $gudang->nama }}</option>
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
                                <option value="Tidak ada kerusakan" {{ old('status_kondisi[' . $loop->index . ']') == 'Tidak ada kerusakan' ? 'selected' : '' }}>Tidak ada kerusakan</option>
                                <option value="Ada kerusakan" {{ old('status_kondisi[' . $loop->index . ']') == 'Ada kerusakan' ? 'selected' : '' }}>Ada kerusakan</option>
                            </select>
                            @error('status_kondisi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi[]" required>{{ old('deskripsi[' . $loop->index . ']') }}</textarea>
                            @error('deskripsi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Foto tool</label>
                            <input type="file" class="form-control-file @error('foto_tool') is-invalid @enderror" name="foto_tool[]" accept="image/*" capture="camera" required>
                            @error('foto_tool')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                @endforeach
                <div class="form-group">
                    <label>Lokasi saat ini</label><br>
                    <button type="button" class="btn btn-info" onclick="getLocation()">Aktifkan Geolocation</button>
                    <input type="hidden" id="geoLatitude" name="geo_latitude">
                    <input type="hidden" id="geoLongitude" name="geo_longitude">
                    <p id="geoNotification"></p>
                    @error('geo_latitude')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    @error('geo_longitude')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
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

        var x = document.getElementById("geoNotification");
        var lat = document.getElementById("geoLatitude");
        var longi = document.getElementById("geoLongitude");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            lat.value = position.coords.latitude;
            longi.value = position.coords.longitude;
            x.innerHTML = "Lokasi berhasil didapatkan";
        }

        function showError(error) {
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    x.innerHTML = "User denied the request for Geolocation."
                    break;
                case error.POSITION_UNAVAILABLE:
                    x.innerHTML = "Location information is unavailable."
                    break;
                case error.TIMEOUT:
                    x.innerHTML = "The request to get user location timed out."
                    break;
                case error.UNKNOWN_ERROR:
                    x.innerHTML = "An unknown error occurred."
                    break;
            }
        }
    </script>
@stop
