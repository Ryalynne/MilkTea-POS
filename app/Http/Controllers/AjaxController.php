<?php

namespace App\Http\Controllers;

use App\Models\Ingredients_Table;
use App\Models\recipe_categories;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function findRecipe($category)
    {
        $recipe = recipe_categories::where('id', $category)->first();
        return response()->json(['recipe' => $recipe]);
    }
}
