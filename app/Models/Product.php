<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category_id',
        'description',
        'price',
        'image',
        'image2',
        'image3',
        'color',
        'sizes'
    ];
    public function categoryRelation()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function getColorArrayAttribute()
    {
        return $this->color ? array_map('trim', explode(',', $this->color)) : [];
    }

    public function getSizeArrayAttribute()
    {
        return $this->sizes ? array_map('trim', explode(', ', $this->sizes)) : [];
    }
}

