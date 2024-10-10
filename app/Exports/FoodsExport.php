<?php

namespace App\Exports;

use App\Models\Food;
use Maatwebsite\Excel\Concerns\FromCollection;

class FoodsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Food::all();
    }
}
