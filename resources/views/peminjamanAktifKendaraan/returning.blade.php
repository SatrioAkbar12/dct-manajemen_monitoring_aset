@extends('adminlte::page')

@section('title', 'Pengembalian Barang')

@section('content_header')
    <h1>Pengembalian Kendaraan</h1>
@stop

@section('content')
    <div class="card">
        <form action="{{ route('peminjamanAktifKendaraan.update', $data_peminjaman_aktif->id )}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group">
                    <label>Kendaraan</label>
                    <input type="text" class="form-control-plaintext" value="{{ $data_peminjaman_aktif->kendaraan->aset->kode_aset . " - " . $data_peminjaman_aktif->kendaraan->nopol . " - " . $data_peminjaman_aktif->kendaraan->jenisKendaraan->nama . " " . $data_peminjaman_aktif->kendaraan->merk . " " . $data_peminjaman_aktif->kendaraan->tipe . " " . $data_peminjaman_aktif->kendaraan->warna }}" disabled>
                </div>
                <div class="form-group">
                    <label>Status kondisi kendaraan</label>
                    <select class="form-control @error('status_kondisi') is-invalid @enderror" name="status_kondisi" required>
                        <option value="Aman">Aman</option>
                        <option value="Ada kerusakan">Ada kerusakan</option>
                    </select>
                    @error('status_kondisi')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Deskripsi kondisi kendaraan</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" required></textarea>
                    @error('deskripsi')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>KM terakhir kendaraan</label>
                    <input type="hidden" name="km_sebelumnya" value="{{ $data_peminjaman_aktif->kendaraan->km_saat_ini }}">
                    <input type="number" class="form-control @error('km_terakhir') is-invalid @enderror" name="km_terakhir" required>
                    *KM peminjaman terakhir : {{ $data_peminjaman_aktif->kendaraan->km_saat_ini }}
                    @error('km_terakhir')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Foto speedometer</label>
                    <input type="file" class="form-control-file @error('foto_speedometer') is-invalid @enderror" name="foto_speedometer" accept="image/*" capture="camera" required>
                    @error('foto_speedometer')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Foto depan kendaraan</label>
                    <input type="file" class="form-control-file @error('foto_depan') is-invalid @enderror" name="foto_depan" accept="image/*" capture="camera" required>
                    @error('foto_depan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Foto belakang kendaraan</label>
                    <input type="file" class="form-control-file @error('foto_belakang') is-invalid @enderror" name="foto_belakang" accept="image/*" capture="camera" required>
                    @error('foto_belakang')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Foto kanan kendaraan</label>
                    <input type="file" class="form-control-file @error('foto_kanan') is-invalid @enderror" name="foto_kanan" accept="image/*" capture="camera" required>
                    @error('foto_kanan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Foto kiri kendaraan</label>
                    <input type="file" class="form-control-file @error('foto_kiri') is-invalid @enderror" name="foto_kiri" accept="image/*" capture="camera" required>
                    @error('foto_kiri')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Lokasi saat ini</label><br>
                    <button type="button" class="btn btn-info" onclick="getLocation()">Aktifkan Geolocation</button>
                    <input type="hidden" id="geoLatitude" name="geo_latitude">
                    <input type="hidden" id="geoLongitude" name="geo_longitude">
                    <p id="geoNotification"></p>
                </div>
            </div>
            <div class="card-footer">
                @can('peminjamanAktifKendaraan.update')
                    <button type="submit" class="btn btn-success">Simpan</button>
                @endcan
                <a href="{{ route('peminjamanAktifKendaraan.index') }}"><button type="button" class="btn btn-secondary">Kembali</button></a>
            </div>
        </form>
    </div>
@stop

@section('js')
    <script>
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
