<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamlocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // --- Data Identitas Pribadi ---
            $table->string('password')->nullable();
            $table->string('nama');
            $table->string('nip')->unique();
            $table->string('nik')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->default('Laki-laki');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Khonghucu', 'Lainnya']);
            $table->string('nama_ibu_kandung')->nullable();
            $table->text('gdrive_link')->nullable();

            // --- Data Kontak ---
            $table->string('nomor_hp')->nullable();
            $table->string('email')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kode_pos')->nullable();

            // --- Data Kepegawaian ---
            $table->string('satuan_kerja');
            $table->text('jabatan');
            $table->enum('pendidikan', ['SD', 'SMP', 'SMA', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3']);

            // --- Data Administrasi Tambahan ---
            $table->string('nomor_npwp')->nullable();
            $table->string('nomor_kk')->nullable();

            // --- Data Keluarga (Pasangan) ---
            $table->enum('status_pernikahan', ['Belum Menikah', 'Menikah', 'Cerai Hidup', 'Cerai Mati'])->default('Belum Menikah');
            $table->string('pasangan_nama')->nullable();
            $table->string('pasangan_nip')->nullable();
            $table->string('pasangan_tempat_lahir')->nullable();
            $table->date('pasangan_tanggal_lahir')->nullable();
            $table->date('pasangan_tanggal_nikah')->nullable();
            $table->string('pasangan_nik')->nullable();
            $table->string('pasangan_pekerjaan')->nullable();
            $table->string('pasangan_nama_ibu')->nullable();
            $table->string('pasangan_nama_ayah')->nullable();
            $table->boolean('pasangan_tertanggung')->default(false);

            $table->boolean('punya_anak')->default(false);


            $table->string('nama_anak_1')->nullable();
            $table->string('tempat_lahir_anak_1')->nullable();
            $table->date('tanggal_lahir_anak_1')->nullable();
            $table->string('nik_anak_1')->nullable();
            $table->enum('pekerjaan_anak_1', ['Sekolah', 'Kuliah', 'Belum Bekerja', 'Bekerja'])->default('Sekolah');
            $table->string('nama_ayah_anak_1')->nullable();
            $table->string('nama_ibu_anak_1')->nullable();
            $table->string('tertanggung_anak_1')->nullable();

            $table->string('nama_anak_2')->nullable();
            $table->string('tempat_lahir_anak_2')->nullable();
            $table->date('tanggal_lahir_anak_2')->nullable();
            $table->string('nik_anak_2')->nullable();
            $table->enum('pekerjaan_anak_2', ['Sekolah', 'Kuliah', 'Belum Bekerja', 'Bekerja'])->default('Sekolah');
            $table->string('nama_ayah_anak_2')->nullable();
            $table->string('nama_ibu_anak_2')->nullable();
            $table->string('tertanggung_anak_2')->nullable();

            $table->string('nama_anak_3')->nullable();
            $table->string('tempat_lahir_anak_3')->nullable();
            $table->date('tanggal_lahir_anak_3')->nullable();
            $table->string('nik_anak_3')->nullable();
            $table->enum('pekerjaan_anak_3', ['Sekolah', 'Kuliah', 'Belum Bekerja', 'Bekerja'])->default('Sekolah');
            $table->string('nama_ayah_anak_3')->nullable();
            $table->string('nama_ibu_anak_3')->nullable();
            $table->string('tertanggung_anak_3')->nullable();

            $table->string('nama_anak_4')->nullable();
            $table->string('tempat_lahir_anak_4')->nullable();
            $table->date('tanggal_lahir_anak_4')->nullable();
            $table->string('nik_anak_4')->nullable();
            $table->enum('pekerjaan_anak_4', ['Sekolah', 'Kuliah', 'Belum Bekerja', 'Bekerja'])->default('Sekolah');
            $table->string('nama_ayah_anak_4')->nullable();
            $table->string('nama_ibu_anak_4')->nullable();
            $table->string('tertanggung_anak_4')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examlocations');
    }
}
