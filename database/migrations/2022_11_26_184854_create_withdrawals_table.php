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
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('method_id');
            $table->decimal('amount')->default(0);
            $table->decimal('rate')->default(0);
            $table->decimal('charge')->default(0);
            $table->decimal('final_amount')->default(0);
            $table->decimal('after_charge')->default(0);
            $table->string('withdraw_information')->default(0);
            $table->string('trx')->default('');
            $table->string('currency')->default('USDT');
            $table->tinyInteger('status')->default(0);
            $table->string('admin_feedback')->default('');
            $table->timestamps();

            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('method_id')->on('gateways')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdrawals');
    }
};
