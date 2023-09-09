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
        Schema::create('parameters', function (Blueprint $table) {
            $table->id();
            $table->double('ph_a');
            $table->double('ph_b');
            $table->double('suhu_a');
            $table->double('suhu_b');
            $table->double('hujan_a');
            $table->double('hujan_b');
            $table->double('tinggi_a');
            $table->double('tinggi_b');
            $table->tinyInteger('ph_kelas');
            $table->tinyInteger('suhu_kelas');
            $table->tinyInteger('hujan_kelas');
            $table->tinyInteger('tinggi_kelas');
            $table->foreignId('plant_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('parameters');
    }
};
