<?php

namespace App\Models;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

class data_kamar extends Model
{
    public function up(){
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('no_kamar');
            $table->string('tipe_kamar');
            $table->string('lantai');
            $table->string('kapasitas');
            $table->string('harga');
            $table->boolean('status');
            $table->timestamps();
        });
    }
}
