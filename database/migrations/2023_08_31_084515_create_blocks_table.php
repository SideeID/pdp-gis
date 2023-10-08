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
        Schema::create('blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('afdeling_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('name', 40);
            $table->text('description')->nullable();
            $table->string('latitude', 20);
            $table->string('longtitude', 20);
            $table->double('area');
            $table->integer('elevation');
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
        Schema::dropIfExists('blocks');
    }
};
