<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('show_time_id')->constrained()->onDelete('cascade');
            $table->string('seat_row', 1);
            $table->integer('seat_number');
            $table->enum('seat_type', ['regular', 'vip'])->default('regular');
            $table->boolean('is_available')->default(true);
            $table->foreignId('booking_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};
