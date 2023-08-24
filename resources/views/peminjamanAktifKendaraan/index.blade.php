@extends('adminlte::page')

@section('plugins.Select2', true)

@section('title', 'Peminjaman Aktif')

@section('content_header')
    <h1>Peminjaman Kendaraan Aktif</h1>
@stop

@section('content')
    <p>Semua data peminjaman kendaraan yang aktif saat ini</p>

    <div class="card">
        <div class="card-body">
            @can('peminjamanAktifKendaraan.store')
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">Tambah peminjaman</button>
                <hr>
            @endcan

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Tanggal Waktu Pinjam</th>
                            <th>Kendaraan</th>
                            <th>Peminjam</th>
                            <th>Target Tanggal Waktu Kembali</th>
                            <th>Keperluan</th>
                            <th>Lokasi Tujuan</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_peminjaman_aktif as $peminjaman_aktif)
                            <tr>
                                <td>{{ $peminjaman_aktif->tanggal_waktu_pinjam }}</td>
                                <td>{{ $peminjaman_aktif->kendaraan->nopol . " - " . $peminjaman_aktif->kendaraan->jenisKendaraan->nama . " " . $peminjaman_aktif->kendaraan->merk . " " . $peminjaman_aktif->kendaraan->tipe . " " . $peminjaman_aktif->kendaraan->warna }}</td>
                                <td>{{ $peminjaman_aktif->user->nama }}</td>
                                <td>{{ $peminjaman_aktif->target_tanggal_waktu_kembali }}</td>
                                <td>{{ $peminjaman_aktif->keperluan }}</td>
                                <td>{{ $peminjaman_aktif->lokasi_tujuan }}</td>
                                <td class="text-danger">
                                    <ul>
                                        @if($peminjaman_aktif->keterangan_approved != null && $peminjaman_aktif->approved == 0)
                                            <li>{{ $peminjaman_aktif->keterangan_approved }}</li>
                                        @endif
                                        @if (\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $peminjaman_aktif->target_tanggal_waktu_kembali, 'Asia/Jakarta')->lessThan(\Carbon\Carbon::now('Asia/Jakarta')))
                                            <li>
                                                @if(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $peminjaman_aktif->target_tanggal_waktu_kembali, 'Asia/Jakarta')->diffInDays(\Carbon\Carbon::now('Asia/Jakarta'), false) == 0)
                                                    Kendaraan sudah melebihi target tanggal waktu pengembalian
                                                @else
                                                    Kendaraan sudah melebihi {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $peminjaman_aktif->target_tanggal_waktu_kembali, 'Asia/Jakarta')->diffInDays(\Carbon\Carbon::now('Asia/Jakarta'), false) }} hari dari target tanggal waktu pengembalian
                                                @endif
                                            </li>
                                        @endif
                                    </ul>

                                </td>
                                <td class="text-center">
                                    @can('peminjamanAktifKendaraan.returning')
                                        <a href="{{ route('peminjamanAktifKendaraan.returning', $peminjaman_aktif->id) }}"><button type="button" class="btn btn-success">Selesaikan</button></a>
                                    @endcan
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

    @can('peminjamanAktifKendaraan.store')
        <div class="modal fade" id="modalCreate" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah peminjaman baru</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('peminjamanAktifKendaraan.store') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="inputUser">Peminjam</label>
                                <select class="form-control @error('user') is-invalid @enderror" id="inputUser" name="user" @unlessrole('admin') disabled @endunlessrole required>
                                    @hasrole('admin')
                                        @foreach ($data_user as $user)
                                            <option value="{{ $user->id }}">{{ $user->nama }}</option>
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
                                        <option value="{{ $kendaraan->id }}">{{ $kendaraan->aset->kode_aset . " - " . $kendaraan->nopol . " - " . $kendaraan->jenisKendaraan->nama . " " . $kendaraan->merk . " " . $kendaraan->tipe . " " . $kendaraan->warna }}</option>
                                    @endforeach
                                </select>
                                @error('kendaraan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Tanggal waktu pinjam</label>
                                <input type="datetime-local" class="form-control @error('tanggal_waktu_pinjam') is-invalid @enderror" name="tanggal_waktu_pinjam" required>
                                @error('tanggal_waktu_pinjam')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Target tanggal waktu kembali</label>
                                <input type="datetime-local" class="form-control @error('target_tanggal_waktu_kembali') is-invalid @enderror" name="target_tanggal_waktu_kembali" required>
                                @error('target_tanggal_waktu_kembali')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Keperluan</label>
                                <input type="text" class="form-control @error('keperluan') is-invalid @enderror" name="keperluan" required>
                                @error('keperluan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Lokasi tujuan</label>
                                <input type="text" class="form-control @error('lokasi_tujuan') is-invalid @enderror" name="lokasi_tujuan" required>
                                @error('lokasi_tujuan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Foto speedometer</label>
                                <input type="file" class="form-control-file @error('foto_speedometer') is-invalid @enderror" accept="image/*" capture="camera" name="foto_speedometer" required>
                                @error('foto_speedometer')
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
