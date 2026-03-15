<?php

namespace App\Imports;

use App\Models\DataPegawai;
use Maatwebsite\Excel\Concerns\ToModel;

class PegawaiImport implements ToModel
{
    public function startRow(): int{
        return 0;
    }

    public function model(array $row){
        return DataPegawai::updateOrCreate(
            ['nomer_hp' => $row[3]],
            [
                'nama_pegawai' => $row[0],
                'posisi' => $row[1],
                'shift' => $row[2],
                'status' => $row[4],
            ]
        );
    }
}
