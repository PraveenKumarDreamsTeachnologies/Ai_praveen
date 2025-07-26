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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2); // 10 digits total, 2 decimal places
            $table->integer('stock_quantity')->default(0);
            $table->date('expiry_date')->nullable();
            $table->string('status')->default('active'); // e.g., 'active', 'inactive', 'out_of_stock'
            $table->timestamps(); // created_at and updated_at columns
            $table->softDeletes();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
