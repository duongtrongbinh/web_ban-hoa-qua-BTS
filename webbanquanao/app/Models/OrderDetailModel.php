<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class OrderDetailModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = 'order_detail';
    protected  $guarded = [];
    public function order()
    {
        return $this->belongsTo(OrderModel::class, 'order_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id', 'id');
    }

}
