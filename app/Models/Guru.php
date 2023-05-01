<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    
    protected $fillable =['NUPTK','nama_lengkap','gender','tanggal_lahir','tempat_lahir','agama'];
}
