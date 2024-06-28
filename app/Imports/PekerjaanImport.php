<?php

namespace App\Imports;

use App\Models\Pekerjaan;
use Maatwebsite\Excel\Concerns\ToModel;

class PekerjaanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pekerjaan([
            'nim'     => $row[0],
            'kategori_pekerjaan1'     => $row[1],
            'kategori_pekerjaan2'     => $row[2],
            'kategori_pekerjaan3'     => $row[3],
            'nama_pekerjaan'     => $row[4],
            'tempat_pekerjaan'     => $row[5],
            'tanggal_pekerjaan'     => $row[6],
            'gaji'     => $row[7],
            'relevansi_pekerjaan'     => $row[8]
        ]);
    }
}
