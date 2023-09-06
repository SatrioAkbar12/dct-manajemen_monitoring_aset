@extends('adminlte::page')

@section('title', 'Peminjaman Aktif Tools')

@section('content_header')
    <h1>Peminjaman Aktif Tools</h1>
@endsection

@section('content')
    <p>Semua data peminjaman tools yang saat ini aktif</p>

    <div class="card">
        <div class="card-body">
            @can('peminjamanAktifTools.store')
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">Tambah peminjaman</button>
                <hr>
            @endcan

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Tanggal Waktu Pinjam</th>
                            <th>Target Tanggal Waktu Kembali</th>
                            <th>Peminjam</th>
                            <th>Tools</th>
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
                                <td>{{ $peminjaman_aktif->target_tanggal_waktu_kembali }}</td>
                                <td>{{ $peminjaman_aktif->user->nama }}</td>
                                <td>
                                    <ul>
                                        @foreach ($peminjaman_aktif->listTools as $list_tools)
                                            <li>{{ $list_tools->aset->kode_aset . " - " . $list_tools->aset->tool->nama . " " .  $list_tools->aset->tool->merk . " " . $list_tools->aset->tool->model }}</li>
                                        @endforeach
                                    </ul>
                                </td>
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
                                                    Peminjaman tools sudah melebihi target tanggal waktu pengembalian
                                                @else
                                                    Peminjaman tools sudah melebihi {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $peminjaman_aktif->target_tanggal_waktu_kembali, 'Asia/Jakarta')->diffInDays(\Carbon\Carbon::now('Asia/Jakarta'), false) }} hari dari target tanggal waktu pengembalian
                                                @endif
                                            </li>
                                        @endif
                                    </ul>
                                </td>
                                <td class="text-center">
                                    @can('peminjamanAktifTools.returning')
                                        <a href="{{ route('peminjamanAktifTools.returning', $peminjaman_aktif->id ) }}"><button type="button" class="btn btn-success">Kembalikan</button></a>
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

    @can('peminjamanAktifTools.store')
        <div class="modal fade" id="modalCreate" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Peminjaman Baru</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action={{ route('peminjamanAktifTools.create') }} method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="userInput">Peminjam </label>
                                <select class="form-control @error('user') is-invalid @enderror" id="userInput" name="user"  @unlessrole('admin') disabled @endunlessrole required>
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
                                <label for="toolsInput">Tools</label>
                                <select class="form-control @error('tools') is-invalid @enderror" id="toolsInput" name="tools[]" multiple="multiple" required>
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
                                <input type="datetime-local" class="form-control @error('tanggal_waktu_pinjam') is-invalid @enderror" name="tanggal_waktu_pinjam" value="{{ old('tanggal_waktu_pinjam') }}" required>
                                @error('tanggal_waktu_pinjam')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Target tanggal waktu kembali</label>
                                <input type="datetime-local" class="form-control @error('target_tanggal_waktu_kembali') is-invalid @enderror" name="target_tanggal_waktu_kembali" value="{{ old('target_tanggal_waktu_kembali') }}" required>
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
                            <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
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
            $('#userInput').select2({
                placeholder: "Pilih user"
            });
            $('#toolsInput').select2({
                placeholder: "Pilih tools yang akan dipinjam"
            });
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
