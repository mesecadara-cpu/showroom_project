<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

public function run(): void
{
    \App\Models\Category::updateOrCreate(['slug' => 'dresses'], ['name' => 'Платья']);
    \App\Models\Category::updateOrCreate(['slug' => 'accessories'], ['name' => 'Аксессуары']);
    \App\Models\Category::updateOrCreate(['slug' => 'outerwear'], ['name' => 'Верхняя одежда']);
}

}
