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
            $table->foreignId('stall_id')->constrained()->cascadeOnDelete();
            $table->string('pickup_slot')->default('istirahat_1'); // istirahat_1 | istirahat_2
            $table->string('pickup_code', 4);
            $table->enum('status', ['menunggu', 'dimasak', 'siap_ambil', 'selesai', 'dibatalkan'])->default('menunggu');
            $table->unsignedInteger('total_amount')->default(0);
            $table->unsignedInteger('total_qty')->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['stall_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
