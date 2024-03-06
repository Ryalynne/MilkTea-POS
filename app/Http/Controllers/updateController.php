<?php

namespace App\Http\Controllers;

use App\Models\brand_categories;
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


    public function updateItem(Request $request)
    {
        // Check which button was clicked
        if ($request->has('updateButton')) {
            $itemID = $request->input('ItemID');
            $item = product_tables::findOrFail($itemID);
            $item->Product_Name = $request->input('productName');
            $item->Image = $request->input('Image');
            $item->Product_Cetegories = $request->input('Categories');
            // $item->cost_price = $request->input('CostPrice');
            $item->Selling_Price = $request->input('SellingPrice');
            $item->save();
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
        $ORArray = is_array($OR) ? $OR : [$OR];
        $ORR = OR_List::whereIn('OrNumber', $ORArray)->pluck('id');
        sales_records::whereIn('Or_id', $ORR)->delete();
        OR_List::whereIn('OrNumber', $ORArray)->delete();
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
