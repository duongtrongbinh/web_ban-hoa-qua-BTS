<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class BlogModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = 'blogs';
    protected  $guarded = [];
    public function userB()
    {
        return $this->belongsTo(User::class,"user_id");
    }
}
