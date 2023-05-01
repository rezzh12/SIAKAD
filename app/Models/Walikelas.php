<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Walikelas extends Model
{
    use HasFactory;

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'NUPTK','NUPTK')
                        ->withDefault(['guru_id' => 'Guru Belum Dipilih']);
    }
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id','id')
                        ->withDefault(['guru_id' => 'Guru Belum Dipilih']);
    }

    public function akademik()
    {
        return $this->belongsTo(Tahun_Akademik::class, 'tahun__akademik_id','id')
                        ->withDefault(['tahun__akademik_id' => 'Tahun Akademik Belum Dipilih']);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id','id')
                        ->withDefault(['kelas_id' => 'Kelas Belum Dipilih']);
    }
}
