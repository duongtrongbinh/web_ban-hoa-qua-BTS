<?php

namespace App\Http\Controllers\APi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoriesModel;
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
        $list = CategoriesModel::all();
        return response()->json($list);
    }


    
}
