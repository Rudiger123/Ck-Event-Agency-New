<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('journeys', function (Blueprint $table) {
            $table->id();
            $table->string('year'); // Ex: 2018
            $table->string('title'); // Ex: Création de l'agence
            $table->text('description')->nullable();
            $table->string('icon')->default('star'); // star, trophy, work...
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journeys');
    }
};
