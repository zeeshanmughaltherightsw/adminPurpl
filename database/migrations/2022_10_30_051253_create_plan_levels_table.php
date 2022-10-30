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
        Schema::create('plan_levels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_id');
            $table->enum('key', ['referral'])->default('referral');
            $table->integer('level')->nullable();
            $table->decimal('commission')->default(0)->comment("%");
            $table->foreign('plan_id')->on('plans')->references('id');
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
        Schema::dropIfExists('plan_levels');
    }
};
