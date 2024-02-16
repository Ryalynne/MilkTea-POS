<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class recipe_categories extends Model
{
    use HasFactory;
    protected $fillable = [
        'recipe_name',
    ];
}
