<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class PermissionsModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = 'permissions';
    protected  $guarded = [];
    public function permissions (){
        return $this->hasMany(PermissionsModel::class, "parent_id");
    }

}
