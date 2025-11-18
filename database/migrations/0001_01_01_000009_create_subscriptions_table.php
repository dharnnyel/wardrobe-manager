<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_subscriptions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('plan_id')->constrained()->onDelete('cascade');

            // Subscription details
            $table->string('status')->default('active')->comment('active, canceled, expired, past_due, trialing');
            $table->decimal('price', 8, 2)->comment('Subscription price at time of purchase');
            $table->string('currency')->default('USD')->comment('Currency code');

            // Billing cycle
            $table->string('interval')->default('monthly')->comment('monthly, yearly, etc.');
            $table->timestamp('current_period_start')->nullable()->comment('Current billing period start');
            $table->timestamp('current_period_end')->nullable()->comment('Current billing period end');
            $table->timestamp('ends_at')->nullable()->comment('When subscription ends (if canceled)');

            // Payment provider data
            $table->string('provider')->default('stripe')->comment('stripe, paypal, etc.');
            $table->string('provider_subscription_id')->nullable()->comment('ID from payment provider');
            $table->string('provider_customer_id')->nullable()->comment('Customer ID from payment provider');

            $table->boolean('auto_renew')->default(true)->comment('Whether the subscription auto-renews');
            $table->boolean('email_receipt')->default(true)->comment('Whether to email receipts');

            // Metadata
            $table->json('metadata')->nullable()->comment('Additional subscription data');

            $table->timestamps();

            // Indexes for performance
            $table->index(['user_id', 'status']);
            $table->index(['status', 'current_period_end']);
            $table->index('provider_subscription_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
