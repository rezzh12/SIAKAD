<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    public function akademik()
    {
        return $this->belongsTo(Tahun_akademik::class, 'tahun__akademik_id','id')
                        ->withDefault(['tahun__akademik_id' => 'Tahun Akademik Belum Dipilih']);
    }
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'NUPTK','NUPTK')
                        ->withDefault(['guru_id' => 'Tahun Guru Belum Dipilih']);
    }
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id','id')
                        ->withDefault(['mapel_id' => 'Tahun Mata Pelajaran Belum Dipilih']);
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id','id')
                        ->withDefault(['kelas_id' => 'Tahun Kelas Belum Dipilih']);
    }
}
