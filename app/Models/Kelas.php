<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    public function tingkatan()
    {
        return $this->belongsTo(Tingkatan_Kelas::class, 'tingkatan__kelas_id','id')
                        ->withDefault(['tingkatan__kelas_id' => 'Tingkatan Belum Dipilih']);
    }
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id','id')
                        ->withDefault(['jurusan_id' => 'Jurusan Belum Dipilih']);
    }
}
