<?php

namespace App\Imports;

use App\Models\Guru;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class GuruImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Guru([
            'NUPTK' => $row['nuptk'],
            'nama_lengkap' => $row['nama_lengkap'],
            'gender' => $row['gender'],
            'tanggal_lahir' => $row['tanggal_lahir'],
            'tempat_lahir' => $row['tempat_lahir'],
            'agama' => $row['agama'],
        ]);
    }
}
