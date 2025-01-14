<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('guid')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('lname');
            $table->string('photo');
            $table->integer('status_id');
            $table->integer('role_id');
            $table->integer('trade_federation_id');
            $table->integer('local_union_id');

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
