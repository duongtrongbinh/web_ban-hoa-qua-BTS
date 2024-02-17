<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class RoleModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = 'role';
    protected  $guarded = [];
    public function permissionRole()
    {
        return $this->belongsToMany(PermissionsModel::class,"role_permissions","role_id","permission_id");
    }
}
