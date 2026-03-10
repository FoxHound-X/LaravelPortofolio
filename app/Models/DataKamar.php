<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DataKamar extends Model
{
    protected $table = 'data_kamar';

    protected $fillable = [
        'no_kamar',
        'tipe_kamar',
        'lantai',
        'kapasitas',
        'harga',
        'status'
    ];
}
