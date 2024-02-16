<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier_list extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_id',
        'brand_id',
        'supplier_id',
        'unit_id',
        'volume',
        'price',
        'pick_up_or_delivery',
        'contact_number',
        'contact_person',
        'reorder_lvl'
    ];

    public function recipe()
    {
        return $this->belongsTo(recipe_categories::class, 'recipe_id');
    }


    public function brand()
    {
        return $this->belongsTo(brand_categories::class, 'brand_id');
    }

    public function supplier()
    {
        return $this->belongsTo(supplier_categories::class, 'supplier_id');
    }

    public function unit()
    {
        return $this->belongsTo(unit_categories::class, 'unit_id');
    }
}
