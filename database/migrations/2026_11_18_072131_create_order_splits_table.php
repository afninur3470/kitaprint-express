<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_splits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->string('friend_name');
            $table->integer('amount');
            $table->string('status')->default('unpaid'); // unpaid, paid
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_splits');
    }
};