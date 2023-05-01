<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat_Nilai extends Model
{
    use HasFactory;

    public function nilai()
    {
        return $this->belongsTo(Nilai::class, 'nilai_id','id')
                        ->withDefault(['nilai_id' => 'nilai_id yang anda Masukan Salah']);
    }
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'NISN','NISN')
                        ->withDefault(['NISN' => 'NISN yang anda Masukan Salah']);
    }
}
