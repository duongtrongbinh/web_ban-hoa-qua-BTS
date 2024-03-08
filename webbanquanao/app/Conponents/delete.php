<?php
namespace App\Conponents;
use App\Models\ProductModel;


class deleteCTL{

    function dele($id){

    try {
        ProductModel::find($id)->delete();
        return response()->json([
            'code' => 200,
            "message" => "success"
        ], 200);
    } catch (\Exception $exception) {
        Log::error("message: " . $exception->getMessage());
        return response()->json([
            'code' => 500,
            "message" => "false"
        ], 500);
    }
    }
}