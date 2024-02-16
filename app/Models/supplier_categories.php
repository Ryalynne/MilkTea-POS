<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier_categories extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_name',
    ];
}
