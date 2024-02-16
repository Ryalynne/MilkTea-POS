<?php

namespace App\Http\Controllers;

use App\Models\brand_categories;
use App\Models\OR_List;
use App\Models\product_categories;
use App\Models\product_tables;
use App\Models\recipe_categories;
use App\Models\Sales_Record;
use App\Models\supplier_categories;
use App\Models\supplier_list;
use App\Models\topping;
use App\Models\unit_categories;
use Illuminate\Http\Request;

class routeController extends Controller
{
    public function Register_Supplier_route()
    {
        $categories = supplier_list::get();
        $unit = unit_categories::get();
        $brand = brand_categories::get();
        $supplier = supplier_categories::get();
        $recipe = recipe_categories::get();
        return view('RegisterSupplier', compact('categories', 'unit', 'brand', 'supplier', 'recipe'));
    }


    public function Register_Item_route()
    {
        $productItem = product_tables::get();
        $unit = unit_categories::get();
        $brand = brand_categories::get();
        $supplier = supplier_list::get();
        $product = recipe_categories::get();

        return view('RegisterItem', compact('productItem', 'unit', 'brand', 'supplier', 'product'));
    }

    public function Recipe_Volume_route()
    {
        $item = supplier_list::get();
        return view('RecipeVolume', compact('item'));
    }

    public function POS_route()
    {
        $product = product_tables::get();
        $sale = OR_List::where('status', 0)->get();
        return view('POS', compact('sale', 'product'));
    }


    public function brand_categories()
    {
        $brand = brand_categories::get();
        return view('./Categories/brand_categories', compact('brand'));
    }
    public function unit_categories()
    {
        $unit = unit_categories::get();
        return view('./Categories/unit_categories', compact('unit'));
    }
    public function supplier_categories()
    {
        $supplier = supplier_categories::get();
        return view('./Categories/supplier_categories', compact('supplier'));
    }
    public function toppins_add()
    {
        $topping = topping::get();
        return view('./Categories/toppins_add', compact('topping'));
    }
    public function Ingredient_categories()
    {
        $recipe = recipe_categories::get();
        return view('./Categories/ingredient_categories', compact('recipe'));
    }
}
