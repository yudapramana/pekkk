<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://getbootstrap.com/docs/3.3/favicon.ico">
    <link rel="canonical" href="https://getbootstrap.com/docs/3.3/examples/jumbotron-narrow/">

    <title>Pengumpulan Data Pembuatan Rekening CPPPK Tahun 2025</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            var allowed = false;
            var password = prompt("Masukkan password untuk mengakses halaman:");

            if (password === "pesselterdepan") {
                allowed = true;
                $(".container").show(); // Menampilkan konten jika benar
            } else {
                $("body").html("<h3 style='text-align:center; margin-top: 20%; color: red;'>Akses ditolak. Password salah.</h3>");
            }
        });
    </script>
    <style>
        .container {
            display: none;
        }
    </style>

</head>

<body>

    <div class="container">
        <div class="header clearfix">
            {{-- <nav>
                <ul class="nav nav-pills pull-right">
                    <li role="presentation" class="active"><a href="#">Home</a></li>
                    <li role="presentation"><a href="#">About</a></li>
                    <li role="presentation"><a href="#">Contact</a></li>
                </ul>
            </nav> --}}
            <h3 class="text-muted">Kementerian Agama Kab. Pesisir Selatan</h3>
        </div>

        <div class="jumbotron" style="padding-top:10px!important; padding-bottom:10px!important">
            <h1>SUBBAGIANTU</h1>
            <p class="lead">Daftar Data Pembuatan Rekening CPPPK Tahun 2025</p>
        </div>

        <nav class="navbar navbar-default">
            <div class="container-fluid">

                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="@if (app()->request->segment(1) == '') active @endif"><a href="/">Cari Data</a></li>
                        <li class="@if (app()->request->segment(1) == 'daftar') active @endif"><a href="/daftar">Lihat
                                Daftar
                                Data</a></li>

                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
            <!--/.container-fluid -->
        </nav>

        <div class="row">
            <div class="col-lg-12">

                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif

                <div class="well">

                    <h3 class="nopadding nomargin" style="margin-top: 0 !important; margin-bottom:10px !important;">
                        Daftar Data</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-striped table-hove" style="font-size: small!important;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Satuan Kerja</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>NIK</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Agama</th>
                                <th>Nama Ibu Kandung</th>
                                <th>GDrive Link</th>
                                <th>Nomor HP</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Kode Pos</th>
                                <th>Jabatan</th>
                                <th>Pendidikan</th>
                                <th>Nomor NPWP</th>
                                <th>Nomor KK</th>
                                <th>Status Pernikahan</th>
                                <th>Pasangan Nama</th>
                                <th>Pasangan NIP</th>
                                <th>Pasangan Tempat Lahir</th>
                                <th>Pasangan Tanggal Lahir</th>
                                <th>Pasangan Tanggal Nikah</th>
                                <th>Pasangan NIK</th>
                                <th>Pasangan Pekerjaan</th>
                                <th>Pasangan Nama Ibu</th>
                                <th>Pasangan Nama Ayah</th>
                                <th>Pasangan Tertanggung</th>
                                <th>Punya Anak</th>
                                <!-- Anak 1 -->
                                <th>Nama Anak 1</th>
                                <th>Tempat Lahir Anak 1</th>
                                <th>Tanggal Lahir Anak 1</th>
                                <th>NIK Anak 1</th>
                                <th>Pekerjaan Anak 1</th>
                                <th>Nama Ayah Anak 1</th>
                                <th>Nama Ibu Anak 1</th>
                                <th>Tertanggung Anak 1</th>
                                <!-- Anak 2 -->
                                <th>Nama Anak 2</th>
                                <th>Tempat Lahir Anak 2</th>
                                <th>Tanggal Lahir Anak 2</th>
                                <th>NIK Anak 2</th>
                                <th>Pekerjaan Anak 2</th>
                                <th>Nama Ayah Anak 2</th>
                                <th>Nama Ibu Anak 2</th>
                                <th>Tertanggung Anak 2</th>
                                <!-- Anak 3 -->
                                <th>Nama Anak 3</th>
                                <th>Tempat Lahir Anak 3</th>
                                <th>Tanggal Lahir Anak 3</th>
                                <th>NIK Anak 3</th>
                                <th>Pekerjaan Anak 3</th>
                                <th>Nama Ayah Anak 3</th>
                                <th>Nama Ibu Anak 3</th>
                                <th>Tertanggung Anak 3</th>
                                <!-- Anak 4 -->
                                <th>Nama Anak 4</th>
                                <th>Tempat Lahir Anak 4</th>
                                <th>Tanggal Lahir Anak 4</th>
                                <th>NIK Anak 4</th>
                                <th>Pekerjaan Anak 4</th>
                                <th>Nama Ayah Anak 4</th>
                                <th>Nama Ibu Anak 4</th>
                                <th>Tertanggung Anak 4</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peserta as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->satuan_kerja }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->nip }}</td>
                                    <td>{{ $item->nik ?? '-' }}</td>
                                    <td>{{ $item->jenis_kelamin }}</td>
                                    <td>{{ $item->tempat_lahir ?? '-' }}</td>
                                    <td>{{ $item->tanggal_lahir ? \Carbon\Carbon::parse($item->tanggal_lahir)->format('d-m-Y') : '-' }}</td>
                                    <td>{{ $item->agama }}</td>
                                    <td>{{ Str::upper($item->nama_ibu_kandung ?? '-') }}</td>
                                    <td>
                                        @if ($item->gdrive_link)
                                            <a href="{{ $item->gdrive_link }}" target="_blank">Link</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $item->nomor_hp ?? '-' }}</td>
                                    <td>{{ $item->email ?? '-' }}</td>
                                    <td>{{ $item->alamat ?? '-' }}</td>
                                    <td>{{ $item->kode_pos ?? '-' }}</td>
                                    <td>{{ $item->jabatan }}</td>
                                    <td>{{ $item->pendidikan }}</td>
                                    <td>{{ $item->nomor_npwp ?? '-' }}</td>
                                    <td>{{ $item->nomor_kk ?? '-' }}</td>
                                    <td>{{ $item->status_pernikahan }}</td>
                                    <td>{{ $item->pasangan_nama ?? '-' }}</td>
                                    <td>{{ $item->pasangan_nip ?? '-' }}</td>
                                    <td>{{ $item->pasangan_tempat_lahir ?? '-' }}</td>
                                    <td>{{ $item->pasangan_tanggal_lahir ? \Carbon\Carbon::parse($item->pasangan_tanggal_lahir)->format('d-m-Y') : '-' }}</td>
                                    <td>{{ $item->pasangan_tanggal_nikah ? \Carbon\Carbon::parse($item->pasangan_tanggal_nikah)->format('d-m-Y') : '-' }}</td>
                                    <td>{{ $item->pasangan_nik ?? '-' }}</td>
                                    <td>{{ $item->pasangan_pekerjaan ?? '-' }}</td>
                                    <td>{{ $item->pasangan_nama_ibu ?? '-' }}</td>
                                    <td>{{ $item->pasangan_nama_ayah ?? '-' }}</td>
                                    <td>{{ $item->pasangan_tertanggung ? 'Ya' : 'Tidak' }}</td>
                                    <td>{{ $item->punya_anak ? 'Ya' : 'Tidak' }}</td>
                                    <!-- Anak 1 -->
                                    <td>{{ $item->nama_anak_1 ?? '-' }}</td>
                                    <td>{{ $item->tempat_lahir_anak_1 ?? '-' }}</td>
                                    <td>{{ $item->tanggal_lahir_anak_1 ? \Carbon\Carbon::parse($item->tanggal_lahir_anak_1)->format('d-m-Y') : '-' }}</td>
                                    <td>{{ $item->nik_anak_1 ?? '-' }}</td>
                                    <td>{{ $item->pekerjaan_anak_1 ?? '-' }}</td>
                                    <td>{{ $item->nama_ayah_anak_1 ?? '-' }}</td>
                                    <td>{{ $item->nama_ibu_anak_1 ?? '-' }}</td>
                                    <td>{{ $item->tertanggung_anak_1 ?? '-' }}</td>
                                    <!-- Anak 2 -->
                                    <td>{{ $item->nama_anak_2 ?? '-' }}</td>
                                    <td>{{ $item->tempat_lahir_anak_2 ?? '-' }}</td>
                                    <td>{{ $item->tanggal_lahir_anak_2 ? \Carbon\Carbon::parse($item->tanggal_lahir_anak_2)->format('d-m-Y') : '-' }}</td>
                                    <td>{{ $item->nik_anak_2 ?? '-' }}</td>
                                    <td>{{ $item->pekerjaan_anak_2 ?? '-' }}</td>
                                    <td>{{ $item->nama_ayah_anak_2 ?? '-' }}</td>
                                    <td>{{ $item->nama_ibu_anak_2 ?? '-' }}</td>
                                    <td>{{ $item->tertanggung_anak_2 ?? '-' }}</td>
                                    <!-- Anak 3 -->
                                    <td>{{ $item->nama_anak_3 ?? '-' }}</td>
                                    <td>{{ $item->tempat_lahir_anak_3 ?? '-' }}</td>
                                    <td>{{ $item->tanggal_lahir_anak_3 ? \Carbon\Carbon::parse($item->tanggal_lahir_anak_3)->format('d-m-Y') : '-' }}</td>
                                    <td>{{ $item->nik_anak_3 ?? '-' }}</td>
                                    <td>{{ $item->pekerjaan_anak_3 ?? '-' }}</td>
                                    <td>{{ $item->nama_ayah_anak_3 ?? '-' }}</td>
                                    <td>{{ $item->nama_ibu_anak_3 ?? '-' }}</td>
                                    <td>{{ $item->tertanggung_anak_3 ?? '-' }}</td>
                                    <!-- Anak 4 -->
                                    <td>{{ $item->nama_anak_4 ?? '-' }}</td>
                                    <td>{{ $item->tempat_lahir_anak_4 ?? '-' }}</td>
                                    <td>{{ $item->tanggal_lahir_anak_4 ? \Carbon\Carbon::parse($item->tanggal_lahir_anak_4)->format('d-m-Y') : '-' }}</td>
                                    <td>{{ $item->nik_anak_4 ?? '-' }}</td>
                                    <td>{{ $item->pekerjaan_anak_4 ?? '-' }}</td>
                                    <td>{{ $item->nama_ayah_anak_4 ?? '-' }}</td>
                                    <td>{{ $item->nama_ibu_anak_4 ?? '-' }}</td>
                                    <td>{{ $item->tertanggung_anak_4 ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>


        </div>

        <footer class="footer">
            <p>&copy; 2023 Pranata Komputer YD</p>
        </footer>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="https://getbootstrap.com/docs/3.3/assets/js/ie10-viewport-bug-workaround.js"></script>
</body>

</html>
