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
            $table->decimal('plan_expiry')->default(1);
            $table->unsignedBigInteger('plan_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->decimal('investment', 18,8)->default(0);
            $table->decimal('profit', 18,8)->default(0);
            $table->decimal('commission', 18,8)->default(0);
            $table->decimal('reward', 18,8)->default(0);
            $table->string('reward_title')->nullable();
            $table->enum('status', ['active', 'baned'])->default('active');
            $table->boolean('ev')->default(false)->comment('Email verfication');
            $table->boolean('mv')->default(false)->comment('Mobile verfication');
            $table->boolean('two_fa')->default(false)->comment('2 factor verfication');
            $table->rememberToken();
            $table->timestamps();
            // $table->foreign('ref_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('users');
    }
};
