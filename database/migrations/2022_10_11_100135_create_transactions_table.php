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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->decimal('amount', 28,8)->default('0.00000000');
            $table->decimal('charge', 28,8)->default('0.00000000');
            $table->decimal('post_balance', 28,8)->default('0.00000000');
            $table->string('trx_type', 40)->nullable();
            $table->string('trx', 40)->nullable();
            $table->string('details')->nullable();
            $table->string('remark', 40)->nullable();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('transactions');
    }
};
