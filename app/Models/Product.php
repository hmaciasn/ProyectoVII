<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image_url',
        'is_active',
        'category_id',
        'created_at',
        'updated_at'
    ];
}
