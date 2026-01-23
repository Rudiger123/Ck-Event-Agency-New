<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('quote_requests', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('company')->nullable();
            $table->json('service_types'); // Array JSON
            $table->string('event_type')->nullable();
            $table->date('event_date')->nullable();
            $table->string('location')->nullable();
            $table->string('budget')->nullable();
            $table->text('message');
            $table->enum('status', ['new', 'processing', 'completed'])->default('new');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('quote_requests'); }
};