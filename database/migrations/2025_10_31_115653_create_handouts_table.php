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
        Schema::create('handouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clothing_id')->constrained()->onDelete('cascade');
            $table->timestamp('handed_out_at')->nullable();
            $table->string('handout_type')->nullable(); // e.g., 'sell', 'donation', 'giveaway'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('handouts');
    }
};
