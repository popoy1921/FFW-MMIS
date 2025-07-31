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
        Schema::create('federation_officers', function (Blueprint $table) {
            $table->id();
            $table->string('guid');
            $table->string('name');
            $table->integer('gender_id');
            $table->integer('age');
            $table->string('position_id');
            $table->string('local_union_id');
            $table->string('federation_id');
            $table->integer('newly_created')->default(1);
            $table->integer('deleted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('federation_officers');
    }
};
