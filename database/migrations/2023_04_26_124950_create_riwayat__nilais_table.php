<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat__nilais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nilai_id')->constrained();
            $table->string('NISN',15);
            $table->string('ketercapaian',11)->nullable();
            $table->string('Deskripsi',255)->nullable();
            $table->string('nilai',10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat__nilais');
    }
}
