<?php

namespace App\Http\Controllers;

use App\Models\brand_categories;
use App\Models\OR_List;
use App\Models\product_categories;
use App\Models\product_tables;
use App\Models\recipe_categories;
use App\Models\Sales_Record;
use App\Models\sales_records;
use App\Models\supplier_categories;
use App\Models\supplier_list;
use App\Models\topping;
use App\Models\unit_categories;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class routeController extends Controller
{
    public function dashboard()
    {
        // Fetching all sales records
        $salesRecords = sales_records::all();

        // Initializing variables to hold the sums
        $totalSales = 0;
        $totalCostPrice = 0;
        $totalIncome = 0;

        // Summing up the values after removing commas
        foreach ($salesRecords as $record) {
            $totalSales += (float) str_replace(',', '', $record->Unit_Price);
            $totalCostPrice += (float) str_replace(',', '', $record->Cost_Price);
            $totalIncome += (float) str_replace(',', '', $record->TotalIncome);
        }

        // Calculating total profit
        $totalIncome = $totalSales - $totalCostPrice;

        // Example logic to find items to reorder
        $itemsToReorder = supplier_list::where('Remaining', '<', 'volume')->count();

        // Counting total users
        $totalUsers = User::count();

        return view('dashboard', compact('totalSales', 'totalIncome', 'itemsToReorder', 'totalUsers'));
    }


    public function Register_Supplier_route()
    {
        $categories = supplier_list::paginate(10);
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
        $products = product_tables::with('ingredients.recipeCategory')->where('status', '0')->paginate(10);
        return view('RegisterItem', compact('productItem', 'unit', 'brand', 'supplier', 'product', 'products'));
    }

    public function Register_Archived_route()
    {
        $productItem = product_tables::get();
        $unit = unit_categories::get();
        $brand = brand_categories::get();
        $supplier = supplier_list::get();
        $product = recipe_categories::get();
        $products = product_tables::with('ingredients.recipeCategory')->where('status', '1')->paginate(10);;
        return view('Archived', compact('productItem', 'unit', 'brand', 'supplier', 'product', 'products'));
    }




    public function Ingredients_Volume_route()
    {
        $unit = unit_categories::get();
        $brand = brand_categories::get();
        $supplier = supplier_categories::get();
        $recipe = recipe_categories::get();
        $item = supplier_list::get();
        return view('RecipeVolume', compact('item', 'unit', 'brand', 'supplier', 'recipe'));
    }

    public function POS_route()
    {
        $products = DB::table('supplier_lists as sl')
            ->join('ingredients_tables as ing', 'sl.recipe_id', '=', 'ing.ingredient_id')
            ->join('product_tables as pt', 'ing.product_id', '=', 'pt.id')
            ->groupBy('pt.Product_Name', 'pt.Image',  'pt.Selling_Price', 'ing.Cost', 'pt.id', 'pt.Size')
            ->select(
                'pt.Product_Name',
                'pt.Image',
                'pt.Selling_Price',
                'ing.Cost',
                'pt.id',
                'pt.Size',
                DB::raw('MIN(FLOOR(sl.remaining / ing.Volume)) AS num_products_can_be_made')
            )->where('pt.status', '0')
            ->get();

        $sale = sales_records::join('o_r__lists', 'sales_records.Or_id', '=', 'o_r__lists.id')
            ->select('sales_records.*', 'o_r__lists.OrNumber', 'o_r__lists.status')
            ->where('o_r__lists.status', 0)
            ->get();


        $toppings1 = topping::get();
        $toppings2 = topping::where('addOn', 'ENABLED')->get();
        return view('POS', compact('sale', 'products', 'toppings1', 'toppings2'));
    }


    public function brand_categories()
    {
        $brand = brand_categories::paginate(20);
        return view('./Categories/brand_categories', compact('brand'));
    }
    public function unit_categories()
    {
        $unit = unit_categories::paginate(20);
        return view('./Categories/unit_categories', compact('unit'));
    }
    public function supplier_categories()
    {
        $supplier = supplier_categories::paginate(20);
        return view('./Categories/supplier_categories', compact('supplier'));
    }
    public function toppins_add()
    {
        $recipe = recipe_categories::paginate(20);
        $topping = topping::paginate(20);
        return view('./Categories/toppins_add', compact('topping', 'recipe'));
    }
    public function Ingredient_categories()
    {
        $recipe = recipe_categories::paginate(20);
        return view('./Categories/ingredient_categories', compact('recipe'));
    }


    public function Sales_Report(Request $request)
    {
        // Retrieve start and end dates from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $sales = sales_records::whereBetween('created_at', [$startDate, $endDate])->get();

        // Pass the sales data to the view
        $data = [
            'sales' => $sales,
        ];

        if ($request->has('download_pdf')) {
            $pdf = PDF::loadView('sales_pdf', $data);
            return $pdf->download('invoice.pdf');
        }

        // Otherwise, return the view for generating the report
        return view('.salesReport', compact('sales'));
    }

    public function Account()
    {
        $account = User::whereNot('user_type', 'REMOVED')->whereNot('user_type', 'SUPER ADMIN')->get();
        return view('Account', compact('account'));
    }

    public function superAdmin()
    {
        $account = User::whereNot('user_type', 'REMOVED')->get();
        return view('superAdmin', compact('account'));
    }

    public function superAdminArchived()
    {
        $account = User::where('user_type', 'REMOVED')->get();
        return view('ArchivedUser', compact('account'));
    }
}
