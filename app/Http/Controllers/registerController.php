<?php

namespace App\Http\Controllers;

use App\Models\brand_categories;
use App\Models\ingredients_tables;
use App\Models\OR_List;
use App\Models\product_tables;
use App\Models\recipe_categories;
use App\Models\sales_records;
use App\Models\supplier_categories;
use App\Models\supplier_list;
use App\Models\topping;
use App\Models\unit_categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

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
            'toppings_name' => $request->toppings_name,
            'addOn' => $request->avail,
        ]);
        return back();
    }



    public function register_product(Request $request)
    {
        $path = ''; // I-deklara ang $path variable bago ang 'if' statement
        if ($request->hasFile('Image')) {
            $file = $request->file('Image');
            $extension = $file->guessExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/category/';
            $file->move($path, $filename);
        } else {
            $filename = ''; // I-deklara ang $filename variable kung walang file na na-upload
        }
        $product = product_tables::create([
            'Product_Name' => $request->Product_Name,
            'Image' => $path . $filename, // Gamitin ang $path dito para sa path ng larawan
            'Product_Cetegories' => $request->Product_Cetegories,
            'Selling_Price' => $request->Selling_Price
        ]);
        $inputArray = $request->recipo;
        $inputArray1 = $request->unitvolume;

        foreach ($inputArray as $index => $input) {
            // Explode each element by comma
            $explodedValues = explode(',', $input);
            $volumes = isset($inputArray1[$index]) ? explode(',', $inputArray1[$index]) : [];
            foreach ($explodedValues as $key => $value) {
                $Cost = $request->itemCost;
                ingredients_tables::create([
                    'product_id' =>  $product->id, // Using the ID of the newly created product
                    'ingredient_id' =>  $value,
                    'Cost' =>  $Cost, // Assuming the cost is provided in the request
                    'Volume' => isset($volumes[$key]) ? $volumes[$key] : null,
                ]);
            }
        }

        return back();
    }




    public function registerOrder(Request $request)
    {
        // dd($request->product_id);
        function generateOrNumber()
        {
            $dateToday = date('Ymd');
            $randomNumber = mt_rand(1000, 9999);
            return $dateToday . $randomNumber;
        }
        $existingOrder = OR_List::where('status', '0')->first();


        DB::table('product_tables as pt')
            ->join('ingredients_tables as ing', 'pt.id', '=', 'ing.product_id')
            ->join('supplier_lists as sl', 'sl.recipe_id', '=', 'ing.ingredient_id')
            ->where('ing.product_id', $request->product_id)
            ->update([
                'sl.remaining' => DB::raw('sl.remaining - (ing.Volume * ' . $request->Qty . ')')
            ]);


        if ($existingOrder) {
            $orNumber = $existingOrder->OrNumber;
            sales_records::create([
                'Or_id' => $existingOrder->id,
                'Product_Name' => $request->Product_Name,
                'Qty' => $request->Qty,
                'Unit_Price' => $request->Unit_Price,
                'Sugar' => $request->Sugar,
                'Add_on' => $request->Add_on,
                'Topping' => $request->toppings1,
                'Cost_Price' => $request->Cost_Price,
                'Sub_Total' => $request->Sub_Total,
            ]);
        } else {
            $orNumber = generateOrNumber();
            $order = OR_List::create([
                'OrNumber' => $orNumber,
                'status' => '0',
            ]);
            sales_records::create([
                'Or_id' => $order->id,
                'Product_Name' => $request->Product_Name,
                'Qty' => $request->Qty,
                'Unit_Price' => $request->Unit_Price,
                'Sugar' => $request->Sugar,
                'Topping' => $request->toppings1,
                'Add_on' => $request->Add_on,
                'Cost_Price' => $request->Cost_Price,
                'Sub_Total' => $request->Sub_Total,

            ]);
        }




        return back();
    }

    public function registerSell(Request $request, $OR)
    {
        $ORR = OR_List::where('OrNumber', $OR)->value('id');
        $sales = sales_records::where('Or_id', $ORR)->get();
        $discount = $request->input('discount');
        $cash = $request->input('cash');
        $exchange = $request->input('exchange');
        // Pass the sales data to the view
        $data = [
            'sales' => $sales,
            'discount' =>   $discount,
            'cash' =>  $cash,
            'exchange' =>    $exchange,
        ];

        $total = $request->input('total');
        $Customer_Name = $request->input('Customer_Name');


        $orList = DB::table('o_r__lists')->where('OrNumber', $OR)->first();
        if ($orList) {
            DB::table('o_r__lists')->where('id', $orList->id)->update(['status' => 1]);
            DB::table('sales_records')->where('Or_id', $orList->id)->update([
                'Total' => $total,
                'Customer_Name' => $Customer_Name
            ]);

            $pdf = PDF::loadView('pos_pdf', $data);
            return $pdf->download('invoice.pdf');
        } else {
            return response()->json(['message' => 'OR not found'], 404);
        }
    }
}
