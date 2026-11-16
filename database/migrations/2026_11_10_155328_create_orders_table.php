<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('store_id')->nullable()->constrained()->nullOnDelete();
            
            // Detail Dokumen
            $table->string('document_name');
            $table->integer('total_pages')->default(1);
            
            // Konfigurasi
            $table->string('paper_size')->default('A4');
            $table->boolean('is_binding')->default(false);
            $table->string('binding_color')->nullable();
            $table->boolean('is_express')->default(false);
            $table->text('notes')->nullable();
            
            // Biaya
            $table->decimal('print_price', 15, 2)->default(0);
            $table->decimal('binding_price', 15, 2)->default(0);
            $table->decimal('express_price', 15, 2)->default(0);
            $table->decimal('shipping_price', 15, 2)->default(0);
            $table->decimal('total_price', 15, 2)->default(0);
            
            // Pengantaran & Pembayaran
            $table->string('delivery_type')->default('courier'); // courier, self_pick
            $table->string('payment_method')->nullable(); // qris, gopay, dana
            $table->boolean('is_splitbill')->default(false);
            $table->string('splitbill_status')->default('none'); // none, 1/3, 2/3, lunas
            
            $table->string('status')->default('pending'); // pending, printing, delivering, completed
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};