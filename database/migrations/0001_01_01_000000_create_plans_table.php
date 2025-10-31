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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('outfit_planning')->default('basic');
            $table->double('monthly_cost', 8, 2)->default(0);
            $table->double('annual_cost', 8, 2)->default(0);
            $table->integer('number_of_clothing');
            $table->boolean('basic_recommendation')->default(0);
            $table->boolean('ai_recommendation')->default(0);
            $table->string('laundry_tracking')->default('manual');
            $table->string('support')->default('standard');
            $table->boolean('analytics')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
