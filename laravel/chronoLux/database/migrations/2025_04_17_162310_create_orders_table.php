<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adress_id')->constrained('addresses')->cascadeOnDelete();
            $table->string('email');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->double('total_price');
            $table->double('delivery_price');
            $table->string('delivery_method');
            $table->string('status');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
