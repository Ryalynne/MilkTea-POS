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
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class updateController extends Controller
{
    public function updateSupplier(Request $request)
    {
        $supplierId = $request->input('recipe_id1');
        // Find the supplier by ID
        $supplier = supplier_list::findOrFail($supplierId);

        $supplier->recipe_id = $request->recipe_id;
        $supplier->brand_id = $request->brand_id;
        $supplier->supplier_id = $request->supplier_id;
        $supplier->unit_id = $request->unit_id;
        $supplier->reorder_lvl = $request->reorder_lvl;
        $supplier->volume = $request->volume;
        $supplier->price = $request->price;
        $supplier->pick_up_or_delivery = $request->pick_up_or_delivery;
        $supplier->contact_number = $request->contact_number;
        $supplier->contact_person = $request->contact_person;

        $supplier->save();

        return redirect()->back()->with('success', 'Supplier information updated successfully');
    }

    public function updateVolume(Request $request)
    {
        $supplierId = $request->input('recipe_id1');

        // Find the supplier by ID
        $supplier = supplier_list::findOrFail($supplierId);

        // Get the existing value of remaining and add the value of volume_to to it
        $newRemaining = $supplier->remaining + $request->volume_to;

        // Update the remaining attribute with the new calculated value
        $supplier->remaining = $newRemaining;

        // Save the changes
        $supplier->save();
        return redirect()->back()->with('success', 'Supplier information updated successfully');
    }


    public function updateUserType(Request $request)
    {
        $userType = $request->input('user_type1');
        $userID = $request->input('userID');
        $user = User::findOrFail($userID);
        $user->user_type = $userType;
        $user->save();
        return redirect()->back()->with('success', 'Supplier information updated successfully');
    }

    public function updateUserTypeSuper(Request $request)
    {
        if ($request->has('removed')) {
            $userID = $request->input('userID');
            $user = User::findOrFail($userID);
            $user->user_type = 'REMOVED';
            $user->save();
            return back();
        } else if ($request->has('update')) {
            $userType = $request->input('user_type1');
            $userID = $request->input('userID');
            $user = User::findOrFail($userID);
            $user->user_type = $userType;
            $user->save();
            return back();
        } else if ($request->has('reset')) {
            $userType = $request->input('user_type1');
            $userID = $request->input('userID');
            $user = User::findOrFail($userID);
            $user->password = 'milkize2024';
            $user->save();
            return back();
        } else if ($request->has('restore')) {
            $userType = $request->input('user_type1');
            $userID = $request->input('userID');
            $user = User::findOrFail($userID);
            $user->user_type = $userType;
            $user->save();
            return back();
        }
    }

    public function updateItem(Request $request)
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
        // Check which button was clicked
        if ($request->has('updateButton')) {
            $itemID = $request->input('ItemID');
            $item = product_tables::findOrFail($itemID);
            $item->Product_Name = $request->input('productName');
            if ($filename == "") {
                $item->Product_Cetegories = $request->input('Categories');
                // $item->cost_price = $request->input('CostPrice');
                $item->Selling_Price = $request->input('SellingPrice');
                $item->save();
            } else {

                // $item->Image = $request->input('Image');
                $item->Image = $path . $filename;
                $item->Product_Cetegories = $request->input('Categories');
                // $item->cost_price = $request->input('CostPrice');
                $item->Selling_Price = $request->input('SellingPrice');
                $item->save();
            }


            return redirect()->back()->with('success', 'User type updated successfully.');
        } elseif ($request->has('removeButton')) {
            $ItemID = $request->input('ItemID');
            $item = product_tables::findOrFail($ItemID);
            $item->status = "1";
            $item->save();
            return redirect()->back()->with('success', 'User removed successfully.');
        } elseif ($request->has('Recover')) {
            $ItemID = $request->input('ItemID');
            $item = product_tables::findOrFail($ItemID);
            $item->status = "0";
            $item->save();
            return redirect()->back()->with('success', 'User removed successfully.');
        }
    }

    public function cancelOrder(Request $request, $OR)
    {
        // Step 1: Get OR IDs based on OR numbers
        $ORArray = is_array($OR) ? $OR : [$OR];
        $ORR = OR_List::whereIn('OrNumber', $ORArray)->pluck('id')->toArray();

        // Step 2: Get Product Names and Quantities based on OR IDs
        $sales = sales_records::whereIn('Or_id', $ORR)->get(['Product_Name', 'Qty']);

        // Step 3: Update remaining quantities
        foreach ($sales as $sale) {
            $productName = $sale->Product_Name;
            $qty = $sale->Qty;

            // Get product ID based on product name
            $productId = product_tables::where('Product_Name', $productName)->value('id');
            if ($productId) {
                $ingredientIDs = ingredients_tables::where('product_id', $productId)->pluck('id')->toArray();

                DB::table('product_tables as pt')
                    ->join('ingredients_tables as ing', 'pt.id', '=', 'ing.product_id')
                    ->join('supplier_lists as sl', 'sl.recipe_id', '=', 'ing.ingredient_id')
                    ->where('ing.product_id', $productId)
                    ->update([
                        'sl.remaining' => DB::raw('sl.remaining + (ing.Volume * ' . $qty . ')')
                    ]);
            }
        }

        // Step 4: Delete sales records and OR_List entries
        sales_records::whereIn('Or_id', $ORR)->delete();
        OR_List::whereIn('OrNumber', $ORArray)->delete();

        // Redirect back
        return back();
    }



    public function UpdateCategories(Request $request)
    {
        if ($request->has('ingredientBTN')) {
            $id = $request->input('id');
            $item = recipe_categories::findOrFail($id);
            $item->recipe_name = $request->name;
            $item->save();
            return back();
        } elseif ($request->has('brandBTN')) {
            $id = $request->input('id');
            $item = brand_categories::findOrFail($id);
            $item->brand_name = $request->name;
            $item->save();
            return back();
        } elseif ($request->has('supplierBTN')) {
            $id = $request->input('id');
            $item = supplier_categories::findOrFail($id);
            $item->supplier_name = $request->name;
            $item->save();
            return back();
        } elseif ($request->has('unitBTN')) {
            $id = $request->input('id');
            $item = unit_categories::findOrFail($id);
            $item->unit_name = $request->name;
            $item->save();
            return back();
        } elseif ($request->has('toppingBTN')) {
            $id = $request->input('id');
            $item = topping::findOrFail($id);
            $item->toppings_name = $request->name;
            $item->addOn = $request->status;
            $item->save();
            return back();
        }
    }
}
