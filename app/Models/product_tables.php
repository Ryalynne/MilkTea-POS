<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_tables extends Model
{
    use HasFactory;

    protected $fillable = [
        'Product_Name',
        'Image',
        'Product_Cetegories',
        'Selling_Price',
    ];
}
