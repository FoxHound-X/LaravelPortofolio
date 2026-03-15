<?php

namespace App\Imports;

use App\Models\DataKamar;
use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KamarImport implements ToModel 
{
    public function startRow(): int{
        return 1;
    }

    public function model(array $row){
        return DataKamar::updateOrCreate(
            ['no_kamar' => $row[0]], 
            [
                'tipe_kamar' => $row[1],
                'lantai' => $row[2],
                'kapasitas' => $row[3],
                'harga' => $row[4],
                'status' => $row[5],
            ]
        );
    }
}
