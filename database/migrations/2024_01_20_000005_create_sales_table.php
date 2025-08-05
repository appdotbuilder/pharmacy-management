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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('sale_number')->unique();
            $table->foreignId('customer_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('prescription_id')->nullable()->constrained()->onDelete('set null');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('tax_amount', 10, 2)->default(0);
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2);
            $table->decimal('amount_paid', 10, 2);
            $table->decimal('change_amount', 10, 2)->default(0);
            $table->enum('payment_method', ['cash', 'card', 'insurance', 'check'])->default('cash');
            $table->enum('status', ['completed', 'refunded', 'cancelled'])->default('completed');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            // Indexes for performance
            $table->index('sale_number');
            $table->index('customer_id');
            $table->index('user_id');
            $table->index('prescription_id');
            $table->index('created_at');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};