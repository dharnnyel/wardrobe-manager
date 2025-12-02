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
        Schema::create('countries', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name');
            $table->string('iso3', 3);
            $table->string('numeric_code', 3);
            $table->string('iso2', 2);
            $table->string('phonecode');
            $table->string('capital')->nullable();
            $table->string('currency', 3);
            $table->string('currency_name');
            $table->string('currency_symbol');
            $table->string('tld');
            $table->string('native');
            $table->string('region');
            $table->integer('region_id');
            $table->string('subregion')->nullable();
            $table->integer('subregion_id')->nullable();
            $table->string('nationality');
            $table->json('timezones');
            $table->json('translations');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('emoji', 10);
            $table->string('emojiU');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('flag');
            $table->string('wikiDataId');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
