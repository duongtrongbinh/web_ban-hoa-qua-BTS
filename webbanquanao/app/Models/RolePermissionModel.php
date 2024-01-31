<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class RolePermissionModel extends Model
{
    use HasFactory;
    public $table = 'role_permissions';
    protected  $guarded = [];
}
