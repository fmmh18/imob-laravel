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
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('logo')->nullable();
            $table->longtext('about')->nullable();
            $table->string('logo_small')->nullable();
            $table->string('logo_dark')->nullable();
            $table->string('logo_small_dark')->nullable();
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->string('facebook')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configs');
    }
};
