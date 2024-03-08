<?php

namespace App\Http\Controllers\APi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoriesModel;
use App\Models\SlideModel;
use App\Conponents\Recusives;

class HomeController extends Controller
{
    // protected $category;
    // function __construct(){
    //     $this->category = new CategoriesModel();
    // }
    // public function getCategory($parentid){
    //     $data = $this->category->all();
    //     $recusive = new Recusives($data);
    //     $htmlSelect = $recusive->categoryRecusive($parentid);
    //     return $htmlSelect;
    // }

    public function index()
    {
        $list = SlideModel::all();
        return response()->json($list);
    }


    
}
