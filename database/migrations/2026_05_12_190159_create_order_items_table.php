<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $col) {
            $col->id();
            $col->foreignId('order_id')->constrained()->onDelete('cascade');
            $col->string('product_name');
            $col->integer('quantity');
            $col->decimal('price', 10, 2);
            $col->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
