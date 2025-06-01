<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeChildsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('employee_childs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // Relasi ke employees
            $table->unsignedInteger('employee_id');

            // Data Anak
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('nik')->unique();
            $table->string('pekerjaan')->nullable(); // bisa sekolah atau pekerjaan
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->boolean('tertanggung')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_childs');
    }
}
