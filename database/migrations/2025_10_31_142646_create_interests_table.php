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
        Schema::create('interests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('material')->nullable();
            $table->string('size')->nullable();
            $table->string('size_unit')->nullable();
            $table->string('sleeves')->nullable();
            $table->string('color')->nullable();
            $table->string('collar')->nullable();
            $table->string('design')->nullable();
            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interests');
    }
};
