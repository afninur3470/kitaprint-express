<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('business_type');
            $table->text('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('store_photo')->nullable();
            $table->string('phone', 30);
            $table->string('email');
            $table->text('address');
            $table->string('city');
            $table->string('province')->nullable();
            $table->string('postal_code', 10);
            $table->string('ktp_number', 20);
            $table->string('ktp_photo');
            $table->string('nib_number')->nullable();
            $table->string('npwp_number')->nullable();
            $table->string('bank_name');
            $table->string('bank_account_number', 30);
            $table->string('bank_account_name');
            $table->string('status')->default('pending')->index();
            $table->text('rejection_reason')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->boolean('is_open')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down(): void { Schema::dropIfExists('stores'); }
};