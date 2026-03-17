<?php

namespace App\Imports;

use App\Models\DataKamar;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

// use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KamarImport implements ToCollection, WithChunkReading, WithStartRow
{
    public function startRow(): int{
        return 2;
    }

    public function collection(Collection $rows){
        $data = [];

        foreach ($rows as $row) {
            if (empty($row[0])){
                continue;
            }

            $data[] = [
                'no_kamar' => $row[0],
                'tipe_kamar' => $row[1] ?? '',
                'lantai' => $row[2] ?? '',
                'kapasitas' => $row[3] ?? '',
                'harga' => $row[4] ?? 0,
                'status' => $row[5] ?? 1,
            ];
        }

        DataKamar::upsert(
            $data,
            ['no_kamar'],
            ['tipe_kamar', 'lantai', 'kapasitas', 'harga', 'status']
        );
    }

    public function chunkSize(): int{
        return 2000;
    }
}
