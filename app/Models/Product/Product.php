<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'brand', 'price'
    ];

    protected $hidden = [
        "created_at",
        "updated_at"
    ];
}
