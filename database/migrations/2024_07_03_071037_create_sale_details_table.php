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
        Schema::create('sale_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('salesID')->constrained('sales', 'id');
            $table->foreignId('productID')->constrained('products', 'id');
            $table->foreignId('warehouseID')->constrained('warehouses', 'id');
            $table->float('price', 10)->default(0);
            $table->float('qty');
            $table->float('amount')->default(0);
            $table->date('date');
            $table->bigInteger('refID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_details');
    }
};
