<?php

namespace App\Exports;

use App\Models\Pekerjaan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PekerjaanExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('pekerjaans')
            ->join('biodatas', 'biodatas.nim', '=', 'pekerjaans.nim')
            ->select('biodatas.name', 'biodatas.ipk', 'biodatas.tglLulus', 'pekerjaans.*')
            ->get();
    }
    public function headings() : array
    {
        return ["Nama", "IPK", "Tgl Lulus", "id", "NIM", "Kategori 1","Kategori 2","Kategori 3", "Pekerjaan", "Alamat Pekerjaan", "Tgl Bekerja", "Gaji", "Relevansi"];
    }
}
