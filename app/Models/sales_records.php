<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sales_records extends Model
{
    use HasFactory;

    protected $fillable = [
        'Or_id',
        'Customer_Name',
        'Qty',
        'Product_id',
        'Sugar',
        'Add_on',
        'Cost_Price',
        'Unit_Price',
        'Profit',
        'Sub_Total',
        'Total',
    ];

    
}
