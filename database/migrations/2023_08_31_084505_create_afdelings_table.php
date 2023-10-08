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
        Schema::create('afdelings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('name', 40);
            $table->double('area')->nullable();
            $table->string('latitude', 20)->nullable();
            $table->string('longtitude', 20)->nullable();
            // $table->integer('elevation')->nullable();
            $table->text('geojson_data')->nullable();
            $table->string('color', 10)->nullable();
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
        Schema::dropIfExists('afdelings');
    }
};
