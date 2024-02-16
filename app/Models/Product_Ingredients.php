<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Ingredients extends Model
{
    use HasFactory;
    protected $fillable = [
        'ingredient_name',
    ];
}
