<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class topping extends Model
{
    use HasFactory;
    protected $fillable = [
        'toppings_name',
    ];
}
