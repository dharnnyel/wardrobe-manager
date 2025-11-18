<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_payment_methods_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Payment method details
            $table->string('holder_name')->nullable()->comment('Name on the card');
            $table->string('card_number')->nullable()->comment('Encrypted card number');
            $table->integer('exp_date')->nullable()->comment('Expiration date MMYY');
            $table->integer('cvv')->nullable()->comment('secure CVV code');

            // Provider data
            $table->string('provider')->default('stripe');
            $table->string('provider_payment_method_id')->nullable()->comment('ID from payment provider');

            // Default flag
            $table->boolean('is_default')->default(false);

            $table->timestamps();
            $table->softDeletes(); // Keep history even when removed

            $table->index(['user_id', 'is_default']);
            $table->index('provider_payment_method_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
