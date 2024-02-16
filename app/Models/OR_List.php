<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OR_List extends Model
{
    use HasFactory;

    protected $fillable = [
        'OrderNumber',
        'status',
    ];

    public function saleproduct()
    {
        return $this->belongsTo(sales_records::class, 'OrNumber');
    }


    public function productlist()
    {
        return $this->belongsTo(Product_Table::class, 'Product_id');
    }


}
