<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class SlideModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = 'slides';
    protected  $guarded = [];
}
