<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class ImageProduct extends Model
{
    use HasFactory;
    public $table = 'image_product';
    protected  $guarded = [];
    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id', 'id');
    }
}
