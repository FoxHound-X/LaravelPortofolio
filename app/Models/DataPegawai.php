<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPegawai extends Model
{
    protected $table = 'data_pegawais';

    protected $fillable = [
        'nama_pegawai',
        'posisi',
        'shift',
        'nomer_hp',
        'status',
    ];
}
