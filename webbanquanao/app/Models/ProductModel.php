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
        return $this->hasMany(CategoriesModel::class,"category_id");
    }

    public function images()
    {
        return $this->hasMany(ImageProduct::class, 'product_id', 'id');
    }

}
