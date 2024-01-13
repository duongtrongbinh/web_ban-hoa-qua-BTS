<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class ProductModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = 'products';
    protected  $guarded = [];
    public function categoryP()
    {
        return $this->belongsTo(CategoriesModel::class,"category_id");
    }
}
