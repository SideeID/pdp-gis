<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perhitungans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parameter_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('afdeling_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->double('ph');
            $table->double('suhu_a');
            $table->double('suhu_b');
            $table->double('hujan');
            $table->double('tinggi');
            $table->tinyInteger('ph_kelas');
            $table->tinyInteger('suhu_kelas');
            $table->tinyInteger('hujan_kelas');
            $table->tinyInteger('tinggi_kelas');
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
        Schema::dropIfExists('perhitungans');
    }
};
