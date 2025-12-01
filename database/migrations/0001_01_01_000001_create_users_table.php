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
            $table->json('style_tags')->nullable(); // array of style tags

            // Wardrobe Settings
            $table->integer('laundry_duration')->default(2)->comment('days');
            $table->integer('laundry_reminder')->default(2)->comment('days before due');
            $table->boolean('auto_archive')->default(false);
            $table->integer('archive_after')->default(6)->comment('months');
            $table->json('clothing_categories')->nullable(); // array of categories

            // Body Measurements
            $table->decimal('weight', 5, 2)->nullable()->comment('in kg');
            $table->decimal('height', 5, 2)->nullable()->comment('in cm');
            $table->decimal('chest', 5, 2)->nullable()->comment('in cm');
            $table->decimal('waist', 5, 2)->nullable()->comment('in cm');
            $table->decimal('hips', 5, 2)->nullable()->comment('in cm');
            $table->decimal('inseam', 5, 2)->nullable()->comment('in cm');
            $table->string('top_fit')->default('regular'); // slim, loose, regular
            $table->string('bottom_fit')->default('regular'); // slim, loose, regular
            $table->string('sleeve_length')->default('regular'); // short, long, regular
            $table->string('pant_length')->default('regular'); // slim, loose, regular
            $table->string('body_shape')->default('rectangle'); // apple, pear, hourglass, rectangle

            // App Preferences
            $table->string('theme')->default('light'); //light, dark, system
            $table->boolean('high_contrast')->default(false);
            $table->string('color_scheme')->default('primary'); //'primary', 'secondary', 'accent', 'success'
            $table->string('language')->default('en');
            $table->string('region')->default('us');
            $table->string('temperature_unit')->default('Celcius'); //'Celcius', 'Fahrenheit'
            $table->string('measurement_unit')->default('metric'); //'metric', 'imperial'

            // Notification Preferences
            $table->boolean('push_notifications')->default(true);
            $table->boolean('notification_sound')->default(true);
            $table->boolean('notification_vibration')->default(true);
            $table->boolean('marketing_emails')->default(true);
            $table->boolean('weekly_digest')->default(false);
            $table->boolean('laundry_reminders')->default(true);
            $table->boolean('item_suggestions')->default(true);
            $table->boolean('outfit_recommendations')->default(true);
            $table->boolean('style_tips')->default(false);
            $table->boolean('quiet_hours')->default(true);
            $table->time('quiet_start')->nullable()->default('22:00:00');
            $table->time('quiet_end')->nullable()->default('07:00:00');
            
            // Privacy & Security
            $table->boolean('login_notifications')->default(true);
            $table->string('profile_visibility')->default('friends_only'); //'public', 'friends_only', 'private'
            $table->boolean('data_sharing')->default(true);
            $table->boolean('personalized_ads')->default(true);
            $table->boolean('camera_access')->default(true);
            $table->boolean('location_access')->default(true);
            $table->boolean('photo_library_access')->default(false);

            $table->boolean('cloud_storage')->default(true)->after('photo_library_access');
            $table->boolean('local_backup')->default(false)->after('cloud_storage');

            // References
            $table->unsignedBigInteger('plan_id');// cannot be null
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
