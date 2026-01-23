<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('event_type_id')->nullable()->constrained()->nullOnDelete();
            
            $table->json('title'); // Translatable
            $table->string('slug')->unique();
            $table->json('description'); // Translatable
            $table->date('event_date');
            $table->string('location')->nullable();
            $table->string('client_name')->nullable();
            $table->json('testimonial')->nullable(); // Translatable
            
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->integer('order')->default(0);
            
            // SEO
            $table->json('meta_title')->nullable();
            $table->json('meta_description')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};