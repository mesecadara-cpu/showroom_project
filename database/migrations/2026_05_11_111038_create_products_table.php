<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Название платья/одежды
        $table->string('category')->nullable();
        $table->text('description')->nullable(); // Описание
        $table->decimal('price', 10, 2); // Цена
        $table->string('image')->nullable(); // Путь к картинке
        $table->string('color')->nullable();
        $table->string('sizes')->nullable();

        $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade');

        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
