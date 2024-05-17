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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date_birth');
            $table->string('cpf');
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->string('doc_rg')->nullable();
            $table->string('doc_cpf')->nullable();
            $table->string('doc_address')->nullable();
            $table->string('doc_finance')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
