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

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <div class="container">
        <div class="header clearfix">
            <h3 class="text-muted">Kementerian Agama Kab. Pesisir Selatan</h3>
        </div>

        <div class="jumbotron" style="padding-top:10px!important; padding-bottom:10px!important">
            <h1>SUBBAGIANTU</h1>
            <p class="lead">Pengumpulan Data Pembuatan Rekening CPPPK Tahun 2025</p>
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
                        {{ session()->get('open_panel') }}
                        {{ session('open_panel') }}
                    </div>
                @endif

                @if (!isset($peserta))
                    <div class="well">

                        <h3 class="nopadding nomargin" style="margin-top: 0 !important; margin-bottom:10px !important;">Cari
                            Data</h3>

                        <div class="form-group">
                            <label for="nip">Masukkan Nomor Induk Pegawai (NIP) Anda</label>
                            <input class="form-control" type="text" id="nip" name="nip" placeholder="NIP PPPK" required value="{{ $errors->first('data') }}">
                            @if ($errors->has('nip'))
                                <span class="text-danger">{{ $errors->first('nip') }}</span>
                            @endif
                        </div>

                        <a class="btn btn-primary" href="#" id="cariDataLink">
                            <span id="btnText">Cari Data PPPK Formasi 2024</span>
                            <span id="loadingSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        </a>
                    </div>

                    <script>
                        document.getElementById('cariDataLink').addEventListener('click', function(e) {
                            e.preventDefault(); // prevent default link behavior

                            const button = this;
                            const nip = document.getElementById('nip').value.trim();

                            if (!nip) {
                                alert("Silakan masukkan NIP terlebih dahulu.");
                                return;
                            }

                            // Prevent multiple clicks
                            button.classList.add('disabled');
                            button.setAttribute('aria-disabled', 'true');
                            document.getElementById('btnText').textContent = 'Sedang mencari...';
                            document.getElementById('loadingSpinner').classList.remove('d-none');

                            // Simulasikan pencarian atau arahkan ke URL pencarian
                            // Misalnya:
                            window.location.href = `/get/peserta/${encodeURIComponent(nip)}`;
                        });
                    </script>
                @elseif(isset($peserta) && $peserta->password && !session('password_validated'))
                    <div class="well">
                        <h3>Masuk Input Data</h3>
                        <form action="{{ route('peserta.verify_password') }}" method="POST">
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Terjadi kesalahan:</strong>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <input type="hidden" name="nip" value="{{ $peserta->nip }}">
                            <div class="form-group">
                                <label for="password" class="p-0 m-0">NIP</label><br>
                                <input type="text" class="form-control" name="nip_temporary" id="nip_temporary" readonly value="{{ $peserta->nip }}">
                            </div>
                            <div class="form-group">

                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="passwordInput" required>
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" id="showPassword" onclick="togglePassword()">
                                    <label class="form-check-label" for="showPassword">
                                        Lihat Password
                                    </label>
                                </div>
                                @if (session('password_error'))
                                    <span class="text-danger d-block mt-1">{{ session('password_error') }}</span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Verifikasi Password</button>
                            <a href="/" type="button" class="btn btn-secondary">Kembali</a>
                        </form>

                        <script>
                            function togglePassword() {
                                const input = document.getElementById("passwordInput");
                                input.type = input.type === "password" ? "text" : "password";
                            }
                        </script>

                    </div>
                @else
                    <h2>Detail PPPK Formasi 2024 {{ session('open_panel') }}</h2>
                    <p>Klik panel yang untuk membuka dan menutupnya..</p>

                    <form action="{{ route('tilok.store') }}" method="POST" id="myForm" onSubmit="handleFormSubmit(event)">
                        @csrf
                        <div class="panel-group" id="accordion">
                            {{-- Data Utama Password --}}
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">

                                            @if (!$peserta->password)
                                                [1] Pengisian Password Akun
                                            @else
                                                [1] Pengumpulan Dokumen via Link Google Drive
                                            @endif
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse {{ session('open_panel', 'Main') == 'Main' ? 'in' : '' }}">
                                    <div class="panel-body">

                                        <input type="hidden" name="id" id="id" value="{{ $peserta->id }}">

                                        <div class="form-group">
                                            <label for="satuan_kerja">Satuan Kerja</label>
                                            <input class="form-control" type="text" name="satuan_kerja" value="{{ $peserta->satuan_kerja }}" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="jabatan">Jabatan</label>
                                            <textarea class="form-control" name="jabatan" rows="2" readonly>{{ $peserta->jabatan }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="nip">NIP</label>
                                            <input class="form-control" type="text" name="nip" value="{{ $peserta->nip }}" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input class="form-control" type="text" name="nama" value="{{ $peserta->nama }}" readonly>
                                        </div>

                                        @if (!$peserta->password)
                                            <div class="alert alert-warning">
                                                <strong>Catatan Penting:</strong><br>
                                                <ul>
                                                    <li>Pastikan Anda mencatat dan mengingat password yang telah diinputkan.</li>
                                                    <li>Verifikasi dan pengecekan data hanya bisa dilakukan jika password dimasukkan oleh yang bersangkutan.</li>
                                                    <li>Jika lupa password, Anda harus menghubungi admin untuk proses reset.</li>
                                                    <li>Jaga kerahasiaan password demi keamanan data pribadi Anda.</li>
                                                </ul>
                                            </div>

                                            <div class="form-group">
                                                <label for="wanted_password">Password</label>
                                                <input class="form-control @error('wanted_password') is-invalid @enderror" type="password" name="wanted_password" id="wanted_password" required>
                                                @error('wanted_password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror

                                                <div class="checkbox mt-2">
                                                    <label>
                                                        <input type="checkbox" onclick="togglePassword()"> Lihat Password
                                                    </label>
                                                </div>
                                            </div>

                                            <script>
                                                function togglePassword() {
                                                    var input = document.getElementById("wanted_password");
                                                    if (input.type === "password") {
                                                        input.type = "text";
                                                    } else {
                                                        input.type = "password";
                                                    }
                                                }
                                            </script>
                                        @else
                                            <div class="form-group">
                                                <label for="gdrive_link">Input Link Dokumen Google Drive</label>
                                                <input type="url" name="gdrive_link" id="gdrive_link" class="form-control" placeholder="Masukkan link folder Google Drive" value="{{ $peserta->gdrive_link }}">
                                                @error('gdrive_link')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <p class="help-block text-danger">*Pastikan folder dapat diakses publik atau melalui link</p>
                                            </div>

                                            <div class="alert alert-info">
                                                <strong>Catatan Penting:</strong><br>
                                                Penginputan dokumen softcopy dilakukan melalui Google Drive sesuai petunjuk berikut:
                                                <ul>
                                                    <li>Folder Google Drive <strong>menggunakan NIP</strong> masing-masing P3K sebagai nama folder.</li>
                                                    <li>Dokumen di dalam folder diberi nama sesuai format berikut:</li>
                                                    <ol>
                                                        <li><code>SKPPPK_NIP</code></li>
                                                        <li><code>SPMT_NIP</code></li>
                                                        <li><code>KTPYBS_NIP</code></li>
                                                        <li><code>NPWP_NIP</code></li>
                                                        <li><code>KK_NIP</code></li>
                                                        <li><code>BUKUNKH_NIP</code></li>
                                                        <li><code>KTPPSGN_NIP</code></li>
                                                        <li><code>AKANAK1_NIP</code></li>
                                                        <li><code>AKANAK2_NIP</code></li>
                                                        <li><code>Dst...</code></li>
                                                    </ol>
                                                    <li>Pastikan akses folder disetel ke <strong>"Siapa saja yang memiliki link dapat melihat"</strong></li>
                                                </ul>
                                            </div>
                                        @endif



                                        <button type="submit" class="btn btn-primary pull-right" id="submitBtnMain" data-param="Main">
                                            <span id="submitTextMain">Simpan Data</span>
                                            <span id="submitSpinnerMain" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                        </button>

                                    </div>

                                </div>
                            </div>
                            {{-- Data Tambahan --}}
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                            [2] Pengisian Data Tambahan</a>
                                    </h4>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse {{ session('open_panel') == 'Addition' ? 'in' : '' }}">
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label for="nomor_hp">Nomor Handphone</label>
                                            <input class="form-control @error('nomor_hp') is-invalid @enderror" type="text" name="nomor_hp" value="{{ old('nomor_hp', $peserta->nomor_hp) }}" required>
                                            @error('nomor_hp')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email', $peserta->email) }}" required>
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="nama_ibu_kandung">Nama Ibu Kandung</label>
                                            <input class="form-control @error('nama_ibu_kandung') is-invalid @enderror" type="text" name="nama_ibu_kandung" value="{{ old('nama_ibu_kandung', $peserta->nama_ibu_kandung) }}" required>
                                            @error('nama_ibu_kandung')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="nik">NIK</label>
                                            <input class="form-control @error('nik') is-invalid @enderror" type="text" name="nik" value="{{ old('nik', $peserta->nik) }}" required>
                                            @error('nik')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" required>
                                                <option value="" selected>-- Pilih --</option>
                                                <option value="Laki-laki" {{ old('jenis_kelamin', $peserta->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="Perempuan" {{ old('jenis_kelamin', $peserta->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                            @error('jenis_kelamin')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                            <input class="form-control @error('tempat_lahir') is-invalid @enderror" type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $peserta->tempat_lahir) }}" required>
                                            @error('tempat_lahir')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                            <input class="form-control @error('tanggal_lahir') is-invalid @enderror" type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $peserta->tanggal_lahir) }}" required>
                                            @error('tanggal_lahir')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="agama">Agama</label>
                                            <select class="form-control @error('agama') is-invalid @enderror" name="agama" required>
                                                <option value="">-- Pilih --</option>
                                                @foreach (['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Khonghucu', 'Lainnya'] as $agama)
                                                    <option value="{{ $agama }}" {{ old('agama', $peserta->agama) == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                                                @endforeach
                                            </select>
                                            @error('agama')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="2" required>{{ old('alamat', $peserta->alamat) }}</textarea>
                                            @error('alamat')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="kode_pos">Kode Pos</label>
                                            <input class="form-control @error('kode_pos') is-invalid @enderror" type="text" name="kode_pos" value="{{ old('kode_pos', $peserta->kode_pos) }}" required>
                                            @error('kode_pos')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="pendidikan">Pendidikan Terakhir</label>
                                            <select class="form-control @error('pendidikan') is-invalid @enderror" name="pendidikan" required>
                                                <option value="">-- Pilih --</option>
                                                @foreach (['SD', 'SMP', 'SMA', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3'] as $pendidikan)
                                                    <option value="{{ $pendidikan }}" {{ old('pendidikan', $peserta->pendidikan) == $pendidikan ? 'selected' : '' }}>{{ $pendidikan }}</option>
                                                @endforeach
                                            </select>
                                            @error('pendidikan')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="nomor_npwp">Nomor NPWP</label>
                                            <input class="form-control @error('nomor_npwp') is-invalid @enderror" type="text" name="nomor_npwp" value="{{ old('nomor_npwp', $peserta->nomor_npwp) }}" required>
                                            @error('nomor_npwp')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="nomor_kk">Nomor KK</label>
                                            <input class="form-control @error('nomor_kk') is-invalid @enderror" type="text" name="nomor_kk" value="{{ old('nomor_kk', $peserta->nomor_kk) }}" required>
                                            @error('nomor_kk')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary pull-right" id="submitBtnAddition" data-param="Addition">
                                            <span id="submitTextAddition">Simpan Data</span>
                                            <span id="submitSpinnerAddition" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                        </button>

                                    </div>
                                </div>
                            </div>
                            {{-- Data Pasangan --}}
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                            [3] Pengisian Data Pasangan</a>
                                    </h4>
                                </div>
                                <div id="collapse3" class="panel-collapse collapse {{ session('open_panel') == 'Spouse' ? 'in' : '' }}">
                                    <div class="panel-body">
                                        @php
                                            $pasangan_fields = ['pasangan_nama', 'pasangan_nip', 'pasangan_tempat_lahir', 'pasangan_tanggal_lahir', 'pasangan_tanggal_nikah', 'pasangan_nik', 'pasangan_pekerjaan', 'pasangan_nama_ibu', 'pasangan_nama_ayah'];
                                        @endphp

                                        <div class="form-group">
                                            <label for="status_pernikahan">Status Pernikahan</label>
                                            <select class="form-control @error('status_pernikahan') is-invalid @enderror" name="status_pernikahan" id="status_pernikahan" required>
                                                @foreach (['' => 'Silahkan Pilih', 'Belum Menikah' => 'Belum Menikah', 'Menikah' => 'Menikah', 'Cerai Hidup' => 'Cerai Hidup', 'Cerai Mati' => 'Cerai Mati'] as $value => $label)
                                                    <option value="{{ $value }}" {{ old('status_pernikahan', $peserta->status_pernikahan) == $value ? 'selected' : '' }}>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                            @error('status_pernikahan')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Container untuk data pasangan --}}
                                        <div id="pasangan_fields_section" style="display: none;">
                                            @foreach ($pasangan_fields as $field)
                                                <div class="form-group">
                                                    <label for="{{ $field }}">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
                                                    <input class="form-control @error($field) is-invalid @enderror" type="{{ str_contains($field, 'tanggal') ? 'date' : 'text' }}" name="{{ $field }}" value="{{ old($field, $peserta->$field) }}">
                                                    @error($field)
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            @endforeach

                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="pasangan_tertanggung" value="1" {{ old('pasangan_tertanggung', $peserta->pasangan_tertanggung) ? 'checked' : '' }}>
                                                    Pasangan ditanggung oleh Instansi
                                                </label>
                                            </div>
                                        </div>

                                        <script>
                                            function togglePasanganFields() {
                                                const status = document.getElementById('status_pernikahan').value;
                                                const pasanganSection = document.getElementById('pasangan_fields_section');
                                                pasanganSection.style.display = (status === 'Menikah') ? 'block' : 'none';
                                            }

                                            // Panggil saat pertama kali halaman dimuat
                                            document.addEventListener('DOMContentLoaded', function() {
                                                togglePasanganFields();
                                                document.getElementById('status_pernikahan').addEventListener('change', togglePasanganFields);
                                            });
                                        </script>


                                        <button type="submit" class="btn btn-primary pull-right" id="submitBtnSpouse" data-param="Spouse">
                                            <span id="submitTextSpouse">Simpan Data</span>
                                            <span id="submitSpinnerSpouse" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                        </button>

                                    </div>
                                </div>
                            </div>
                            {{-- Data Anak --}}
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                            [4] Pengisian Data Anak</a>
                                    </h4>
                                </div>
                                <div id="collapse4" class="panel-collapse collapse {{ session('open_panel') == 'Child' ? 'in' : '' }}">
                                    <div class="panel-body">
                                        <div class="form-check mb-3">
                                            <input type="checkbox" class="form-check-input" id="punya_anak" name="punya_anak" value="1" {{ old('punya_anak', $peserta->punya_anak) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="punya_anak">Apakah Anda memiliki anak?</label>
                                        </div>

                                        <div id="anak_section" style="display: none;">
                                            <div id="anak_forms">
                                                @for ($i = 1; $i <= 4; $i++)
                                                    @php
                                                        $visible = !empty(old('nama_anak_' . $i, $peserta->{'nama_anak_' . $i}));
                                                    @endphp
                                                    <div class="panel panel-default anak-form" id="anak_form_{{ $i - 1 }}" style="{{ $i === 1 || $visible ? '' : 'display: none;' }}">
                                                        <div class="panel-heading">
                                                            <strong>Data Anak <span class="anak-number">{{ $i }}</span></strong>
                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="nama_anak_{{ $i }}">Nama</label>
                                                                        <input type="text" class="form-control input-sm" name="nama_anak_{{ $i }}" value="{{ old('nama_anak_' . $i, $peserta->{'nama_anak_' . $i}) }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="tempat_lahir_anak_{{ $i }}">Tempat Lahir</label>
                                                                        <input type="text" class="form-control input-sm" name="tempat_lahir_anak_{{ $i }}" value="{{ old('tempat_lahir_anak_' . $i, $peserta->{'tempat_lahir_anak_' . $i}) }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="tanggal_lahir_anak_{{ $i }}">Tanggal Lahir</label>
                                                                        <input type="date" class="form-control input-sm" name="tanggal_lahir_anak_{{ $i }}" value="{{ old('tanggal_lahir_anak_' . $i, $peserta->{'tanggal_lahir_anak_' . $i}) }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="nik_anak_{{ $i }}">NIK</label>
                                                                        <input type="text" class="form-control input-sm" name="nik_anak_{{ $i }}" value="{{ old('nik_anak_' . $i, $peserta->{'nik_anak_' . $i}) }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="pekerjaan_anak_{{ $i }}">Pekerjaan/Sekolah</label>
                                                                        <select class="form-control input-sm" name="pekerjaan_anak_{{ $i }}">
                                                                            @php
                                                                                $pekerjaan_options = ['Sekolah', 'Kuliah', 'Belum Bekerja', 'Bekerja'];
                                                                                $pekerjaan_value = old('pekerjaan_anak_' . $i, $peserta->{'pekerjaan_anak_' . $i});
                                                                            @endphp
                                                                            @foreach ($pekerjaan_options as $option)
                                                                                <option value="{{ $option }}" {{ $pekerjaan_value === $option ? 'selected' : '' }}>{{ $option }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="nama_ayah_anak_{{ $i }}">Nama Ayah</label>
                                                                        <input type="text" class="form-control input-sm" name="nama_ayah_anak_{{ $i }}" value="{{ old('nama_ayah_anak_' . $i, $peserta->{'nama_ayah_anak_' . $i}) }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="nama_ibu_anak_{{ $i }}">Nama Ibu</label>
                                                                        <input type="text" class="form-control input-sm" name="nama_ibu_anak_{{ $i }}" value="{{ old('nama_ibu_anak_' . $i, $peserta->{'nama_ibu_anak_' . $i}) }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="checkbox" style="margin-top: 25px;">
                                                                        <label>
                                                                            <input type="checkbox" name="tertanggung_anak_{{ $i }}" value="1" {{ old('tertanggung_anak_' . $i, $peserta->{'tertanggung_anak_' . $i}) ? 'checked' : '' }}>
                                                                            Anak Tertanggung
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 text-right">
                                                                    <button type="button" class="btn btn-sm btn-danger hapus-anak-btn" data-index="{{ $i - 1 }}">
                                                                        Hapus Anak
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endfor
                                            </div>



                                            <button type="button" class="btn btn-sm btn-outline-secondary mb-3 mt-3 pt-5" id="tambah_anak_btn">
                                                + Tambah Anak
                                            </button>


                                            <hr>

                                            <button type="submit" class="btn btn-primary pull-right" id="submitBtnChild" data-param="Child">
                                                <span id="submitTextChild">Simpan Data</span>
                                                <span id="submitSpinnerChild" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                            </button>
                                        </div>

                                        <script>
                                            function toggleAnakSection() {
                                                const checkbox = document.getElementById('punya_anak');
                                                const section = document.getElementById('anak_section');
                                                section.style.display = checkbox.checked ? 'block' : 'none';
                                            }

                                            document.addEventListener('DOMContentLoaded', function() {
                                                toggleAnakSection();
                                                document.getElementById('punya_anak').addEventListener('change', toggleAnakSection);

                                                const tambahBtn = document.getElementById('tambah_anak_btn');
                                                let anakForms = document.querySelectorAll('.anak-form');

                                                // Hitung form anak yang tampil
                                                function getVisibleForms() {
                                                    return Array.from(anakForms).filter(form => form.style.display !== 'none');
                                                }

                                                function updateTambahBtnVisibility() {
                                                    const visibleForms = getVisibleForms();
                                                    tambahBtn.style.display = visibleForms.length >= 4 ? 'none' : 'inline-block';
                                                }

                                                // Tambah anak
                                                tambahBtn.addEventListener('click', function() {
                                                    for (let i = 0; i < anakForms.length; i++) {
                                                        if (anakForms[i].style.display === 'none') {
                                                            anakForms[i].style.display = 'block';
                                                            break;
                                                        }
                                                    }
                                                    updateTambahBtnVisibility();
                                                });

                                                // Hapus anak
                                                document.querySelectorAll('.hapus-anak-btn').forEach(function(btn) {
                                                    btn.addEventListener('click', function() {
                                                        const index = this.getAttribute('data-index');
                                                        const form = document.getElementById('anak_form_' + index);
                                                        if (form) {
                                                            // Reset semua input di dalam form anak
                                                            form.querySelectorAll('input, select').forEach(el => {
                                                                if (el.type === 'checkbox' || el.type === 'radio') {
                                                                    el.checked = false;
                                                                } else {
                                                                    el.value = '';
                                                                }
                                                            });
                                                            form.style.display = 'none';
                                                        }
                                                        updateTambahBtnVisibility();
                                                    });
                                                });

                                                updateTambahBtnVisibility();
                                            });
                                        </script>

                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title" style="text-align: right !important;">
                                        <button type="submit" class="btn btn-primary" id="submitBtnDone" data-param="Done">
                                            <span id="submitTextDone">Selesai Mengisi Data</span>
                                            <span id="submitSpinnerDone" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                        </button>
                                    </h4>
                                </div>
                            </div>
                        </div>

                    </form>




                @endif

            </div>


        </div>

        <footer class="footer">
            <p>&copy; 2023 Pranata Komputer YD</p>
        </footer>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="https://getbootstrap.com/docs/3.3/assets/js/ie10-viewport-bug-workaround.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

    <script>
        // Simpan ID panel yang dibuka saat ini
        $('#accordion .panel-collapse').on('shown.bs.collapse', function() {
            const current = $(this).attr('id');
            sessionStorage.setItem('activeAccordion', current);
            console.log('lucunyaa');
            console.log('lucunyaa: ' + current);
        });

        // Saat halaman dimuat, buka panel yang sebelumnya disimpan
        $(document).ready(function() {
            const activePanel = sessionStorage.getItem('activeAccordion');
            if (activePanel) {
                $('#' + activePanel).collapse('show');
            }
            console.log('lucunyaaready');
            console.log('lucunyaaready: ' + activePanel);
        });


        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    nomor_hp: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 15
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    nama_ibu_kandung: "required",
                    nik: {
                        required: true,
                        digits: true,
                        minlength: 16,
                        maxlength: 16
                    },
                    jenis_kelamin: "required",
                    tempat_lahir: "required",
                    tanggal_lahir: "required",
                    agama: "required",
                    alamat: "required",
                    kode_pos: {
                        required: true,
                        digits: true,
                        minlength: 5,
                        maxlength: 5
                    },
                    pendidikan: "required",
                    nomor_npwp: {
                        required: true,
                        minlength: 15,
                        maxlength: 20
                    },
                    nomor_kk: {
                        required: true,
                        digits: true,
                        minlength: 16,
                        maxlength: 16
                    }
                },
                messages: {
                    nomor_hp: {
                        required: "Nomor HP wajib diisi",
                        digits: "Harus berupa angka",
                        minlength: "Minimal 10 digit",
                        maxlength: "Maksimal 15 digit"
                    },
                    email: {
                        required: "Email wajib diisi",
                        email: "Format email tidak valid"
                    },
                    nik: {
                        required: "NIK wajib diisi",
                        digits: "Harus berupa angka",
                        minlength: "NIK harus 16 digit",
                        maxlength: "NIK harus 16 digit"
                    },
                    kode_pos: {
                        required: "Kode Pos wajib diisi",
                        digits: "Harus berupa angka",
                        minlength: "Kode pos harus 5 digit",
                        maxlength: "Kode pos harus 5 digit"
                    },
                    nomor_kk: {
                        required: "Nomor KK wajib diisi",
                        digits: "Harus berupa angka",
                        minlength: "Nomor KK harus 16 digit",
                        maxlength: "Nomor KK harus 16 digit"
                    },
                    nomor_npwp: {
                        required: "Nomor NPWP wajib diisi",
                        minlength: "Minimal 15 karakter",
                        maxlength: "Maksimal 20 karakter"
                    },
                    // tambahkan pesan lain sesuai kebutuhan
                },
                errorElement: 'div',
                errorClass: 'text-danger',
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>


    <script>
        function handleFormSubmit(event) {
            event.preventDefault(); // Cegah submit default

            const form = event.target;
            const clickedButton = event.submitter;

            // Validasi jQuery
            if (!$(form).valid()) {
                return; // Jika tidak valid, hentikan proses
            }

            // Hapus input lama jika ada
            const oldInput = form.querySelector('input[name="submit_action"]');
            if (oldInput) oldInput.remove();

            // Tambahkan input tersembunyi
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'submit_action';
            hiddenInput.value = clickedButton.dataset.param;

            form.appendChild(hiddenInput);

            // Nonaktifkan semua tombol submit dan tampilkan loading
            $('#submitBtnMain').prop('disabled', true).html('<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...');
            $('#submitBtnAddition').prop('disabled', true).html('<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...');
            $('#submitBtnSpouse').prop('disabled', true).html('<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...');
            $('#submitBtnChild').prop('disabled', true).html('<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...');
            $('#submitBtnDone').prop('disabled', true).html('<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...');

            form.submit(); // Submit form setelah valid
        }


        // $(document).ready(function() {
        //     $('form').on('submit', function() {
        //         $('#submitBtnMain').prop('disabled', true).html('<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...');
        //         $('#submitBtnAddition').prop('disabled', true).html('<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...');
        //         $('#submitBtnSpouse').prop('disabled', true).html('<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...');
        //         $('#submitBtnChild').prop('disabled', true).html('<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...');
        //     });
        // });
    </script>

    <script>
        document.getElementById('cariDataLink').addEventListener('click', function(event) {
            const nip = document.getElementById('nip').value.trim();

            if (!nip) {
                alert('Mohon masukkan NIP terlebih dahulu.');
                event.preventDefault(); // Batalkan navigasi jika NIP kosong
                return;
            }

            // Setel ulang href sebelum navigasi
            this.href = `/get/peserta/${nip}`;
        });

        document.querySelectorAll('#myForm button[type="submit"]').forEach(button => {
            consoel.log('alalala');
            button.addEventListener('click', function(e) {
                const form = document.getElementById('myForm');

                // Hapus parameter lama jika ada
                const existingInput = form.querySelector('input[name="submit_action"]');
                if (existingInput) existingInput.remove();

                // Buat input tersembunyi baru
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'submit_action';
                hiddenInput.value = this.dataset.param;

                form.appendChild(hiddenInput);
            });
        });
    </script>


    <style>
        /* Gaya animasi untuk ikon loading */
        .glyphicon-refresh-animate {
            -animation: spin 1s infinite linear;
            -webkit-animation: spin 1s infinite linear;
        }

        @-webkit-keyframes spin {
            from {
                -webkit-transform: rotate(0deg);
            }

            to {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>

</body>

</html>
