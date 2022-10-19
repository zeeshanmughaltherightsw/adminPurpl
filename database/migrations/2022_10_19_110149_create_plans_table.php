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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name', 40)->nullable();
            $table->decimal('price', 28,8)->default('0.00000000');
            $table->integer('daily_limit', 0)->default('0');
            $table->tinyInteger('status')->default('0');
            $table->integer('ref_level', 0)->default('0');
            $table->integer('validity', 0)->default('0');
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
        Schema::dropIfExists('plans');
    }
};
