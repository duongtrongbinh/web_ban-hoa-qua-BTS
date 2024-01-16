<?php

namespace App\Exports;

use App\Models\ProductModel;
use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\FromQuery;
// use Maatwebsite\Excel\Concerns\Exportable;

class ProductExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ProductModel::all();
    }


    // use Exportable;

    // public function __construct(int $quantity)
    // {
    //     $this->quantity = $quantity;
    // }

    // public function query()
    // {
    //     return ProductModel::query()->count($this->quantity);
    // }
}
