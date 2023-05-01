<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id','id')
                        ->withDefault(['kelas_id' => 'Kelas Belum Dipilih']);
    }
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id','id')
                        ->withDefault(['kelas_id' => 'Kelas Belum Dipilih']);
    }
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id','id')
                        ->withDefault(['kelas_id' => 'Kelas Belum Dipilih']);
    }
}
