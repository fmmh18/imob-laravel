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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longtext('description');
            $table->float('value_rent', 10, 2)->nullable();
            $table->float('value_buy', 10, 2)->nullable();
            $table->integer('type_rent')->default(0);
            $table->integer('type_buy')->default(0);
            $table->string('address');
            $table->string('neighborhood');
            $table->integer('city_id');
            $table->integer('user_id');
            $table->integer('state_id');
            $table->integer('type_id');
            $table->string('bedroom');
            $table->string('bathroom');
            $table->string('area');
            $table->integer('publish')->default(0);
            $table->integer('counts')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
