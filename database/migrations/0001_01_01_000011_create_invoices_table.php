<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_invoices_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('subscription_id')->constrained()->onDelete('cascade');

            // Invoice details
            $table->string('invoice_number')->unique()->comment('Human-readable invoice number');
            $table->decimal('amount', 8, 2);
            $table->decimal('tax_amount', 8, 2)->default(0);
            $table->decimal('total_amount', 8, 2);
            $table->string('currency')->default('USD');
            $table->string('status')->default('paid')->comment('paid, pending, failed, refunded, void');

            // Billing period
            $table->date('billing_period_start');
            $table->date('billing_period_end');

            // Provider data
            $table->string('provider')->default('stripe');
            $table->string('provider_invoice_id')->nullable()->comment('ID from payment provider');
            $table->string('provider_payment_intent_id')->nullable()->comment('Payment intent ID');

            // File storage
            $table->string('invoice_pdf_path')->nullable()->comment('Path to stored PDF invoice');

            // Dates
            $table->timestamp('due_date')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('refunded_at')->nullable();

            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index('invoice_number');
            $table->index('provider_invoice_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
