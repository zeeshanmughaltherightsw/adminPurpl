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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('account_no')->nullable();
            $table->unsignedBigInteger('ref_by')->nullable();
            $table->string('username')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_no')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->unsignedBigInteger('plan_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->decimal('balance')->nullable();
            $table->enum('status', ['active', 'baned'])->default('active');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('ref_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
