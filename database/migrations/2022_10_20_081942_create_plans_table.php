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
            $table->string('name')->unique();
            $table->decimal('min_price')->nullable();
            $table->decimal('max_price')->nullable();
            $table->enum('plan_type', ['investor', 'referral','high_agent']);
            $table->decimal('profit')->nullable()->default(0);
            $table->integer('min_ref')->nullable();
            $table->integer('max_ref')->nullable();
            $table->decimal('ref_commission')->nullable();
            $table->decimal('expire')->default(200);
            $table->boolean('status')->default(true);
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
