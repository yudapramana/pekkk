<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class InputController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $nip)
    {
        // session(['password_validated' => false]);
        // Validasi awal
        // $validatedData = $request->validate([
        //     'nip' => 'required',
        // ], [
        //     'nip.required' => 'NIP PPPK perlu diisi',
        // ]);

        $nip = trim($request->nip);

        // Ambil data peserta dari tabel employees
        $peserta = DB::table('employees')->where('nip', $nip)->first();

        if (!$peserta) {
            return back()->withErrors([
                'nip' => 'NIP tidak ditemukan',
                'data' => $nip,
            ])->withInput();
        }

        // Kolom-kolom yang wajib diisi agar dianggap "sudah mengisi"
        $kolomWajib = [
            'email',
            'nomor_hp',
            'nama_ibu_kandung',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat',
            'agama',
            'status_perkawinan',
        ];

        $sudahMengisi = true;
        foreach ($kolomWajib as $kolom) {
            if (empty($peserta->$kolom)) {
                $sudahMengisi = false;
                break;
            }
        }

        if ($sudahMengisi) {
            return back()->withErrors([
                'nip' => 'Calon PPPK dengan NIP ' . $nip . ' telah mengisi seluruh data',
            ]);
        }

        // return $peserta;

        // Jika belum mengisi semua, arahkan ke form input
        return view('input', compact('peserta'));
    }



    public function storeTilok(Request $request)
    {

        try {
            // Initial Data
            $data = [
                'nama' => $request->nama,
                'nip' => $request->nip,
                'nik' => $request->nik
            ];

            
            
            $submitAction = $request->submit_action;
            // dd($request->all());
            switch ($submitAction) {
                case 'Main':

                    $validatedData = $request->validate([
                        'wanted_password' => ['sometimes', 'required', 'min:6'],
                        'gdrive_link' => ['sometimes', 'required']
                    ], [
                        'wanted_password.required' => 'Password wajib diisi.',
                        'wanted_password.min'      => 'Password minimal harus terdiri dari 6 karakter.',
                        'gdrive_link.required' => 'Link Google Drive Dokumen harus diisi.'
                    ]);

                    // Only update password if it's not an empty string
                    if (trim($request->wanted_password) !== '') {
                        $data['password'] = $request->wanted_password;
                    }
                    $data['gdrive_link'] = $request->gdrive_link;
                    session(['password_validated' => true]);
                    break;

                case 'Addition':
                    $validatedData = $request->validate([
                        // --- Identitas Pribadi ---
                        'nama' => 'required|string|max:255',
                        'nip' => 'required|digits:18',
                        'nik' => 'required|digits:16',
                        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                        'tempat_lahir' => 'required|string|max:100',
                        'tanggal_lahir' => 'required|date',
                        'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Khonghucu,Lainnya',
                        'nama_ibu_kandung' => 'required|string|max:255',

                        // --- Kontak ---
                        'nomor_hp' => 'required|digits_between:10,15',
                        'email' => 'required|email|max:255',
                        'alamat' => 'required|string',
                        'kode_pos' => 'required|string|max:10',

                        // --- Kepegawaian ---
                        'satuan_kerja' => 'required|string|max:255',
                        'jabatan' => 'required|string',
                        'pendidikan' => 'required|in:SD,SMP,SMA,D1,D2,D3,D4,S1,S2,S3',

                        // --- Administrasi ---
                        'nomor_npwp' => 'required|digits_between:15,16', // atau gunakan regex untuk format NPWP lengkap
                        'nomor_kk' => 'required|digits:16',
                    ], [
                        // --- Identitas Pribadi ---
                        'nama.required' => 'Nama wajib diisi.',
                        'nama.string' => 'Nama harus berupa teks.',
                        'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',
                        
                        'nip.required' => 'NIP wajib diisi.',
                        'nip.digits' => 'NIP harus terdiri dari 18 digit.',

                        'nik.required' => 'NIK wajib diisi.',
                        'nik.digits' => 'NIK harus terdiri dari 16 digit.',

                        'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
                        'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',

                        'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
                        'tempat_lahir.string' => 'Tempat lahir harus berupa teks.',
                        'tempat_lahir.max' => 'Tempat lahir tidak boleh lebih dari 100 karakter.',

                        'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
                        'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal yang valid.',

                        'agama.required' => 'Agama wajib dipilih.',
                        'agama.in' => 'Agama yang dipilih tidak valid.',

                        'nama_ibu_kandung.required' => 'Nama ibu kandung wajib diisi.',
                        'nama_ibu_kandung.string' => 'Nama ibu kandung harus berupa teks.',
                        'nama_ibu_kandung.max' => 'Nama ibu kandung tidak boleh lebih dari 255 karakter.',

                        // --- Kontak ---
                        'nomor_hp.required' => 'Nomor HP wajib diisi.',
                        'nomor_hp.digits_between' => 'Nomor HP harus antara 10 hingga 15 digit.',

                        'email.required' => 'Email wajib diisi.',
                        'email.email' => 'Format email tidak valid.',
                        'email.max' => 'Email tidak boleh lebih dari 255 karakter.',

                        'alamat.required' => 'Alamat wajib diisi.',
                        'alamat.string' => 'Alamat harus berupa teks.',

                        'kode_pos.required' => 'Kode pos wajib diisi.',
                        'kode_pos.string' => 'Kode pos harus berupa teks.',
                        'kode_pos.max' => 'Kode pos tidak boleh lebih dari 10 karakter.',

                        // --- Kepegawaian ---
                        'satuan_kerja.required' => 'Satuan kerja wajib diisi.',
                        'satuan_kerja.string' => 'Satuan kerja harus berupa teks.',
                        'satuan_kerja.max' => 'Satuan kerja tidak boleh lebih dari 255 karakter.',

                        'jabatan.required' => 'Jabatan wajib diisi.',
                        'jabatan.string' => 'Jabatan harus berupa teks.',

                        'pendidikan.required' => 'Tingkat pendidikan wajib dipilih.',
                        'pendidikan.in' => 'Pendidikan yang dipilih tidak valid.',

                        // --- Administrasi ---
                        'nomor_npwp.required' => 'Nomor NPWP wajib diisi.',
                        'nomor_npwp.digits_between' => 'Nomor NPWP harus antara 15 hingga 16 digit',

                        'nomor_kk.required' => 'Nomor KK wajib diisi.',
                        'nomor_kk.digits' => 'Nomor KK harus terdiri dari 16 digit.'
                    ]);

                    $data = [
                        'nama' => $request->nama,
                        'nip' => $request->nip,
                        'nik' => $request->nik,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'tempat_lahir' => $request->tempat_lahir,
                        'tanggal_lahir' => $request->tanggal_lahir,
                        'agama' => $request->agama,
                        'nama_ibu_kandung' => $request->nama_ibu_kandung,

                        'nomor_hp' => $request->nomor_hp,
                        'email' => $request->email,
                        'alamat' => $request->alamat,
                        'kode_pos' => $request->kode_pos,

                        'satuan_kerja' => $request->satuan_kerja,
                        'jabatan' => $request->jabatan,
                        'pendidikan' => $request->pendidikan,

                        'nomor_npwp' => $request->nomor_npwp,
                        'nomor_kk' => $request->nomor_kk,
                            ];
                    break;

                case 'Spouse':
                    // dd($request->all());

                    $validatedData = $request->validate([
                        'status_pernikahan' => 'required|in:Belum Menikah,Menikah,Cerai Hidup,Cerai Mati',

                        // Validasi bersyarat hanya jika status_pernikahan adalah "Menikah"
                        'pasangan_nama'             => 'required_if:status_pernikahan,Menikah|nullable|string|max:255',
                        'pasangan_nip'              => 'required_if:status_pernikahan,Menikah|nullable|digits:18',
                        'pasangan_tempat_lahir'     => 'required_if:status_pernikahan,Menikah|nullable|string|max:100',
                        'pasangan_tanggal_lahir'    => 'required_if:status_pernikahan,Menikah|nullable|date',
                        'pasangan_tanggal_nikah'    => 'required_if:status_pernikahan,Menikah|nullable|date',
                        'pasangan_nik'              => 'required_if:status_pernikahan,Menikah|nullable|digits:16',
                        'pasangan_pekerjaan'        => 'required_if:status_pernikahan,Menikah|nullable|string|max:255',
                        'pasangan_nama_ibu'         => 'required_if:status_pernikahan,Menikah|nullable|string|max:255',
                        'pasangan_nama_ayah'        => 'required_if:status_pernikahan,Menikah|nullable|string|max:255',
                    ], [
                        'status_pernikahan.required' => 'Status pernikahan wajib diisi.',
                        'status_pernikahan.in' => 'Status pernikahan tidak valid.',

                        'pasangan_nama.required_if' => 'Nama pasangan wajib diisi jika Anda menikah.',
                        'pasangan_nip.required_if' => 'NIP pasangan wajib diisi jika Anda menikah.',
                        'pasangan_tempat_lahir.required_if' => 'Tempat lahir pasangan wajib diisi jika Anda menikah.',
                        'pasangan_tanggal_lahir.required_if' => 'Tanggal lahir pasangan wajib diisi jika Anda menikah.',
                        'pasangan_tanggal_nikah.required_if' => 'Tanggal nikah wajib diisi jika Anda menikah.',
                        'pasangan_nik.required_if' => 'NIK pasangan wajib diisi jika Anda menikah.',
                        'pasangan_pekerjaan.required_if' => 'Pekerjaan pasangan wajib diisi jika Anda menikah.',
                        'pasangan_nama_ibu.required_if' => 'Nama ibu pasangan wajib diisi jika Anda menikah.',
                        'pasangan_nama_ayah.required_if' => 'Nama ayah pasangan wajib diisi jika Anda menikah.',

                        'pasangan_nip.digits' => 'NIP pasangan harus terdiri dari 18 digit.',
                        'pasangan_nik.digits' => 'NIK pasangan harus terdiri dari 16 digit.',
                        'pasangan_tanggal_lahir.date' => 'Tanggal lahir pasangan harus berupa tanggal yang valid.',
                        'pasangan_tanggal_nikah.date' => 'Tanggal nikah harus berupa tanggal yang valid.',
                    ]);

                    $data = [
                        'status_pernikahan' => $request->status_pernikahan,
                        'pasangan_nama' => $request->pasangan_nama,
                        'pasangan_nip' => $request->pasangan_nip,
                        'pasangan_tempat_lahir' => $request->pasangan_tempat_lahir,
                        'pasangan_tanggal_lahir' => $request->pasangan_tanggal_lahir,
                        'pasangan_tanggal_nikah' => $request->pasangan_tanggal_nikah,
                        'pasangan_nik' => $request->pasangan_nik,
                        'pasangan_pekerjaan' => $request->pasangan_pekerjaan,
                        'pasangan_nama_ibu' => $request->pasangan_nama_ibu,
                        'pasangan_nama_ayah' => $request->pasangan_nama_ayah,
                        'pasangan_tertanggung' => $request->has('pasangan_tertanggung'),
                    ];
                    break;

                case 'Child':

                    $data['punya_anak'] = $request->punya_anak;

                    for ($i = 1; $i <= 4; $i++) {
                        $data["nama_anak_$i"] = $request->input("nama_anak_$i", null);
                        $data["tempat_lahir_anak_$i"] = $request->input("tempat_lahir_anak_$i", null);
                        $data["tanggal_lahir_anak_$i"] = $request->input("tanggal_lahir_anak_$i", null);
                        $data["nik_anak_$i"] = $request->input("nik_anak_$i", null);
                        $data["pekerjaan_anak_$i"] = $request->input("pekerjaan_anak_$i", null);
                        $data["nama_ayah_anak_$i"] = $request->input("nama_ayah_anak_$i", null);
                        $data["nama_ibu_anak_$i"] = $request->input("nama_ibu_anak_$i", null);
                        $data["tertanggung_anak_$i"] = $request->has("tertanggung_anak_$i") ? 1 : 0;
                    }

                    // dd($request->all());
                    // return $data;
                    break;
                
                default:
                    # code...
                    break;
            }

            // return $data;

            // return $data;
            DB::table('employees')
            ->where('id', $request->id)
            ->update($data);

            $peserta = DB::table('employees')
                ->select('*')
                ->where('id', $request->id)
                ->first();

            // session(['password_validated' => false]);
            if($submitAction == 'Done') {
                return redirect('/')->with('success', 'Data PPPK untuk (' . $peserta->nama . ' - ' . $peserta->nip . ') sudah tersimpan');
            } else {
                return redirect()->back()->with('open_panel', $submitAction)->with('success', 'Data PPPK untuk (' . $peserta->nama . ' - ' . $peserta->nip . ') sudah tersimpan');
            }

        } catch (ValidationException $e) {
            // Return validation errors to the form
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            // Handle general error
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function verifyPassword(Request $request)
    {
        $peserta = DB::table('employees')->where('nip', $request->nip)->first();

        if (!$peserta) {
            return redirect('/')->with('password_error', 'Peserta tidak ditemukan.');
        }

        if ($peserta->password === $request->password) {
            session(['password_validated' => true]);
            return redirect("/get/peserta/{$peserta->nip}");
        }

        return redirect()->back()->with('password_error', 'Password salah.');
    }

}
