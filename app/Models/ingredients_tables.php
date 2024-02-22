<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ingredients_tables extends Model
{
    use HasFactory;
    protected $fillable = [
        'ingredient_id',
        'product_id',
        'ingredient_id',
        'Volume',
        'Cost'
    ];

    public function recipeCategory()
    {
        return $this->belongsTo(recipe_categories::class, 'ingredient_id');
    }

    public function recipeUnit()
    {
        return $this->belongsTo(supplier_list::class, 'ingredient_id');
    }
    public function ing()
    {
        return $this->belongsTo(ingredients_tables::class, 'ingredient_id');
    }
}
