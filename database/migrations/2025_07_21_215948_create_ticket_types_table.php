<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ticket_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->string('section')->nullable();
            $table->boolean('is_vip')->default(false);
            $table->boolean('is_seat')->default(true);
            $table->string('seat_number')->nullable();
            $table->integer('door_number')->nullable();
            $table->integer('capacity');
            $table->integer('available_tickets');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ticket_types');
    }
};