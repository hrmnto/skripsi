<?php

namespace App\Exports;

use App\Models\Biodata;
use Maatwebsite\Excel\Concerns\FromCollection;

class BiodataExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Biodata::all();
    }
}
