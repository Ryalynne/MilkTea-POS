<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OR_List extends Model
{
    use HasFactory;

    protected $fillable = [
        'OrNumber',
        'status',
    ];

    public function saleproduct()
    {
        return $this->belongsTo(sales_records::class, 'Or_id');
    }


    public function productlist()
    {
        return $this->belongsTo(product_tables::class, 'Product_id');
    }


}
