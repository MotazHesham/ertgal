<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class ReceiptProduct extends Model
{
    use Auditable;
    protected $table = 'receipt_products';

    public function product_in_receitps(){
        return $this->hasMany(Receipt_social_Product::class,'receipt_product_id');
    }

    public function product_in_receitpsCount()
    {
        return $this->product_in_receitps()
            ->selectRaw('receipt_product_id, sum(quantity) as quantity,sum(total) as total')
            ->groupBy('receipt_product_id');
    }
}
