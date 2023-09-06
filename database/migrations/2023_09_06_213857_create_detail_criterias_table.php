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
        Schema::create('detail_criterias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('criteria_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('description', 40);
            $table->double('limit_a');
            $table->double('limit_b');
            $table->tinyInteger('class');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_criterias');
    }
};
