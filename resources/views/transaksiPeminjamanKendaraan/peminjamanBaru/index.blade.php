@extends('adminlte::page')

@section('title', 'Peminjaman Baru Kendaraan');

@section('content_header')
    <h1>Peminjaman Baru Kendaraan</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            @canany(['peminjamanBaruKendaraan.create', 'peminjamanBaruKendaraan.store'])
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">Tambah peminjaman baru</button>
            @endcanany
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Tanggal waktu peminjaman</th>
                            <th>Target tanggal waktu kembali</th>
                            <th>Kendaraan</th>
                            <th>Peminjam</th>
                            <th>Keperluan</th>
                            <th>Lokasi</th>
                            <th>Keterangan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_peminjaman as $peminjaman)
                            @if ($peminjaman->approval_peminjaman === 0 && $peminjaman->id_user != auth()->user()->id)
                                @continue
                            @endif
                            <tr>
                                <td class="align-middle">{{ $peminjaman->tanggal_waktu_pinjam }}</td>
                                <td class="align-middle">{{ $peminjaman->target_tanggal_waktu_kembali }}</td>
                                <td class="align-middle">{{ $peminjaman->kendaraan->nopol . " - " . $peminjaman->kendaraan->jenisKendaraan->nama . " " . $peminjaman->kendaraan->merk . " " . $peminjaman->kendaraan->tipe . " " . $peminjaman->kendaraan->warna }}</td>
                                <td class="align-middle">{{ $peminjaman->user->nama }}</td>
                                <td class="align-middle">{{ $peminjaman->keperluan }}</td>
                                <td class="align-middle">{{ $peminjaman->lokasi_tujuan }}</td>
                                <td class="align-middle">
                                    @if ($peminjaman->approval_peminjaman === null)
                                        <span class="text-info">Peminjaman sedang menunggu approval</span>
                                    @else
                                        <div class="text-danger">
                                            Peminjaman tidak diapproved :<br>
                                            <ul class="m-0">
                                                <li>{{ $peminjaman->keterangan_approval_peminjaman }}</li>
                                            </ul>
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @can('peminjamanBaruKendaraan.review')
                                        @if($peminjaman->approval_peminjaman === null)
                                            <a href="{{ route('peminjamanBaruKendaraan.review', $peminjaman->id) }}" class="mx-2 my-1 btn btn-info">Review</a>
                                        @endif
                                    @endcan
                                    @can('peminjamanBaruKendaraan.del')
                                        @if ($peminjaman->id_user == auth()->user()->id)
                                            <a href="{{ route('peminjamanBaruKendaraan.del', $peminjaman->id) }}" class="mx-2 my-1 {{ $peminjaman->approval_peminjaman === null ? 'btn btn-warning' : 'btn btn-danger'}}" data-confirm-delete="true">{{ $peminjaman->approval_peminjaman === null ? 'Batalkan' : 'Hapus'}}</a>
                                        @endif
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <br>
            <div class="d-flex justify-content-center">
                {{ $data_peminjaman->links() }}
            </div>
        </div>
    </div>

    @canany(['peminjamanBaruKendaraan.create', 'peminjamanBaruKendaraan.store'])
        <div class="modal fade" id="modalCreate" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah peminjaman baru</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('peminjamanBaruKendaraan.create') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="inputUser">Peminjam</label>
                                <select class="form-control @error('user') is-invalid @enderror" id="inputUser" name="user" @unlessrole('admin') disabled @endunlessrole required>
                                    @hasrole('admin')
                                        @foreach ($data_user as $user)
                                            <option value="{{ $user->id }}" {{ old('user') == $user->id ? 'selected' : '' }}>{{ $user->nama }}</option>
                                        @endforeach
                                    @else
                                        <option value="{{ auth()->user()->id }}">{{ auth()->user()->nama }}</option>
                                    @endhasrole
                                </select>
                                @error('user')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputKendaraan">Kendaraan</label>
                                <select class="form-control @error('kendaraan') is-invalid @enderror" id="inputKendaraan" name="kendaraan" required>
                                    @foreach ($data_kendaraan as $kendaraan)
                                        <option value="{{ $kendaraan->id }}" {{ old('kendaraan') == $kendaraan->id ? 'selected' : '' }}>{{ $kendaraan->aset->kode_aset . " - " . $kendaraan->nopol . " - " . $kendaraan->jenisKendaraan->nama . " " . $kendaraan->merk . " " . $kendaraan->tipe . " " . $kendaraan->warna }}</option>
                                    @endforeach
                                </select>
                                @error('kendaraan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Tanggal waktu pinjam</label>
                                <input type="datetime-local" class="form-control @error('tanggal_waktu_pinjam') is-invalid @enderror" name="tanggal_waktu_pinjam" value="{{ old('tanggal_waktu_pinjam') }}" required>
                                @error('tanggal_waktu_pinjam')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Target tanggal waktu kembali</label>
                                <input type="datetime-local" class="form-control @error('target_tanggal_waktu_kembali') is-invalid @enderror" name="target_tanggal_waktu_kembali" value="{{ old('target_tanggal_Waktu_kembali') }}" required>
                                @error('target_tanggal_waktu_kembali')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Keperluan</label>
                                <input type="text" class="form-control @error('keperluan') is-invalid @enderror" name="keperluan" value="{{ old('keperluan') }}" required>
                                @error('keperluan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Lokasi tujuan</label>
                                <input type="text" class="form-control @error('lokasi_tujuan') is-invalid @enderror" name="lokasi_tujuan" value="{{ old('lokasi_tujuan') }}" required>
                                @error('lokasi_tujuan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
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
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcanany
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#inputUser').select2();
            $('#inputKendaraan').select2();
        });

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
