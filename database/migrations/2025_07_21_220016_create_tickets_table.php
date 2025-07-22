<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_type_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('purchase_id');
            $table->foreign('ticket_type_id')->references('id')->on('ticket_types')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
            $table->string('seat_number')->nullable();
            $table->string('qr_code')->unique();
            $table->boolean('is_used')->default(false);
            $table->boolean('is_cancelled')->default(false);
            $table->timestamp('issued_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};