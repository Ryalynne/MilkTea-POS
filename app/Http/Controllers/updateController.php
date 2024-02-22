<?php

namespace App\Http\Controllers;

use App\Models\supplier_list;
use Illuminate\Http\Request;

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
}
