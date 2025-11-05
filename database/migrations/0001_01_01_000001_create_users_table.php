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

            // Profile info
            $table->string('email')->unique();
            $table->string('name')->nullable();
            $table->string('phone')->nullable(); //why string and not integer
            $table->string('photo')->nullable(); // why string and not binary
            $table->text('bio')->nullable(); //For the user's letter with color around

            // Body Measurements
            $table->decimal('weight', 5, 2)->nullable()->comment('in kg');
            $table->decimal('height', 5, 2)->nullable()->comment('in cm');
            $table->decimal('chest', 5, 2)->nullable()->comment('in cm');
            $table->decimal('waist', 5, 2)->nullable()->comment('in cm');
            $table->decimal('hips', 5, 2)->nullable()->comment('in cm');
            $table->decimal('inseam', 5, 2)->nullable()->comment('in cm');

            // Fit Preferences
            $table->string('top_fit')->default('regular'); // slim, loose, regular
            $table->string('bottom_fit')->default('regular'); // slim, loose, regular
            $table->string('sleeve_length')->default('regular'); // short, long, regular
            $table->string('pant_length')->default('regular'); // slim, loose, regular

            // App Preferences
            $table->string('language')->default('en');
            $table->string('region')->default('us');
            $table->string('theme')->default('light'); //light, dark, system
            $table->string('color_scheme')->default('primary'); //'primary', 'secondary', 'accent', 'success'
            $table->string('units')->default('metric'); //'metric', 'imperial'

            // Wardrobe Settings
            $table->integer('laundry_duration')->default(2)->comment('days');
            $table->integer('laundry_reminder')->default(2)->comment('days before due');
            $table->boolean('auto_archive')->default(false);
            $table->integer('archive_after')->default(6)->comment('months');

            // Notification Preferences
            $table->boolean('push_notifications')->default(true);
            $table->boolean('email_notifications')->default(true);
            $table->boolean('sms_notifications')->default(false);
            $table->boolean('laundry_reminders')->default(true);
            $table->boolean('outfit_suggestions')->default(true);
            $table->boolean('shopping_alerts')->default(true);
            $table->boolean('style_tips')->default(false);
            
            // Wishlist Notifications
            $table->boolean('wishlist_notifications')->default(true);
            $table->enum('wishlist_frequency', ['immediate', 'daily', 'weekly'])->default('immediate');
            $table->boolean('price_drop_alerts')->default(true);
            $table->boolean('restock_alerts')->default(true);
            
            // Quiet Hours
            $table->time('quiet_start')->default('22:00');
            $table->time('quiet_end')->default('07:00');
            
            // Privacy & Security
            $table->boolean('public_profile')->default(false);
            $table->boolean('share_outfits')->default(false);
            $table->boolean('data_sharing')->default(true);
            $table->boolean('two_factor_auth')->default(false);
            $table->boolean('login_notifications')->default(true);
            

            // References
            $table->unsignedBigInteger('plan_id');
            $table->foreign('plan_id')->references('id')->on('plans');
            $table->timestamps();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('sessions');
    }
};
