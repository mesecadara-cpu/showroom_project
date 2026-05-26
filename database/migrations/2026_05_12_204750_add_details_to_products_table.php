<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

public function up()
{
    Schema::table('products', function (Blueprint $table) {
        // Убрали строку с description, так как она уже есть в базе
        $table->string('image2')->nullable();
        $table->string('image3')->nullable();
    });
}


    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
