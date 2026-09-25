<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id')->unique();
            $table->string('user_id')->nullable(); // Dibuat string biasa dulu agar tidak bentrok foreign key
            $table->string('game_name');
            $table->string('zone_id')->nullable();
            $table->string('product_name');
            $table->integer('price');
            $table->integer('cost_price');
            $table->integer('profit');
            $table->string('payment_method')->default('QRIS');
            $table->string('status')->default('PENDING');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
