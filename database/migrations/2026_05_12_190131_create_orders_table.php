<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $col) {
            $col->id();
            $col->string('name');
            $col->string('phone');
            $col->string('email')->nullable();
            $col->text('address');
            $col->decimal('total_price', 10, 2);
            $col->string('status')->default('new'); // новый, оплачен, доставлен
            $col->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
