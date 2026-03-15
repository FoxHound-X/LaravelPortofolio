<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('data_kamar', function (Blueprint $table) {
            $table->id();
            $table->string('no_kamar')->unique();
            $table->string('tipe_kamar');
            $table->string('lantai');
            $table->string('kapasitas');
            $table->string('harga');
            $table->integer('status')->comment('0:Terisi, 1:Tersedia, 2:Maintenance');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};