<?php

namespace App\Http\Controllers;

use App\Models\brand_categories;
use App\Models\Ingredients_Table;
use App\Models\Product_Ingredients;
use App\Models\product_tables;
use App\Models\recipe_categories;
use App\Models\supplier_categories;
use App\Models\supplier_list;
use App\Models\topping;
use App\Models\unit_categories;
use Illuminate\Http\Request;

class registerController extends Controller
{
    public function register_supplier(Request $request)
    {
        supplier_list::create([
            'recipe_id' => $request->recipe_id,
            'brand_id' => $request->brand_id,
            'supplier_id' => $request->supplier_id,
            'unit_id' => $request->unit_id,
            'volume' => $request->volume,
            'price' => $request->price,
            'pick_up_or_delivery' => $request->pick_up_or_delivery,
            'contact_number' => $request->contact_number,
            'contact_person' => $request->contact_person,
            'reorder_lvl' =>  $request->reorder_lvl
        ]);

        return back();
    }


    public function register_ingredient(Request $request)
    {
        recipe_categories::create([
            'recipe_name' => $request->recipe_name
        ]);
        return back();
    }
    public function register_unit(Request $request)
    {
        unit_categories::create([
            'unit_name' => $request->unit_name
        ]);
        return back();
    }
    public function register_supcategories(Request $request)
    {
        supplier_categories::create([
            'supplier_name' => $request->supplier_name
        ]);
        return back();
    }
    public function register_brand(Request $request)
    {
        brand_categories::create([
            'brand_name' => $request->brand_name
        ]);
        return back();
    }
    public function register_toppings(Request $request)
    {
        topping::create([
            'toppings_name' => $request->toppings_name
        ]);
        return back();
    }



    public function register_product(Request $request)
    {
        if ($request->hasFile('Image')) {
            $file = $request->file('Image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/category/';
            $file->move($path, $filename);
            // Save the file path to the validated data
            $validatedData['Image'] = 'images/' . $filename;
        }

        Product_Ingredients::create([
            'ingredient_id' =>  $request->ingredientId,
            'product_id' => $request->productId
        ]);

        // Create product with validated data
        product_tables::create([
            'Product_Name' => $request->Product_Name,
            'Image' => $path . $filename,
            'Product_Cetegories' => $request->Product_Cetegories,
            'Selling_Price' => $request->Selling_Price
        ]);

        return back();
    }
}
