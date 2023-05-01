<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tingkatan_Kelas;
use App\Models\Tahun_Akademik;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Ruangan;
use App\Models\Mapel;
use App\Models\Jadwal;
use App\Models\Guru;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('User.home');
    }

    public function jadwal(){
        $user = Auth::user();
        $akademik = Tahun_Akademik::where('status','1')->get();
        $jurusan = Jurusan::all();
        $tingkatan = Tingkatan_Kelas::all();
        $kelas = Kelas::all();
        $mapel = Mapel::all();
        $ruangan = Ruangan::all();
        $guru = Guru::all();
        $jadwal = Jadwal::with('mapel')->get();
        $jadwal = Jadwal::with('guru')->get();
        $jadwal = Jadwal::with('ruangan')->get();
        $jadwal = Jadwal::all();
        return view('User.jadwalPelajaran', compact('user','jadwal','guru','akademik','mapel','ruangan','jurusan','tingkatan','kelas'));
    }

    public function nilai(){
        $user = Auth::user();
        $NISN = auth()->user()->id_status;
        $riwayat = DB::table('riwayat__nilais')
        ->join('siswas', 'siswas.NISN', '=', 'riwayat__nilais.NISN')
        ->join('kelas', 'kelas.id', '=', 'siswas.kelas_id')
        ->select('nama_lengkap','riwayat__nilais.NISN','nama_kelas')
        ->where('riwayat__nilais.NISN','=',$NISN)
        ->paginate(1);

        $nilai = DB::table('riwayat__nilais')
        ->join('nilais', 'nilais.id', '=', 'riwayat__nilais.nilai_id')
        ->join('mapels', 'mapels.id', '=', 'nilais.mapel_id')
        ->join('kelas', 'kelas.id', '=', 'nilais.kelas_id')
        ->select('nama_mapel','nama_kelas','NISN','nilai')
        ->where('riwayat__nilais.NISN','=',$NISN)
        ->get();
        return view('User.tampil', compact('user','nilai','riwayat'));
    }
}
