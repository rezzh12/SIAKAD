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
use App\Models\Riwayat_Nilai;
use PDF;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
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
        return view('Guru.jadwalPelajaran', compact('user','jadwal','guru','akademik','mapel','ruangan','jurusan','tingkatan','kelas'));
    }

    public function nilai(){
        $user = Auth::user();
        $NUPTK = auth()->user()->id_status;
        $nilai = DB::table('nilais')
        ->join('tahun__akademiks', 'tahun__akademiks.id', '=', 'nilais.tahun__akademik_id')
        ->join('gurus', 'gurus.NUPTK', '=', 'nilais.NUPTK')
        ->join('mapels', 'mapels.id', '=', 'nilais.mapel_id')
        ->join('kelas', 'kelas.id', '=', 'nilais.kelas_id')
        ->select('nama_lengkap','nama_mapel','nama_kelas','nilais.id')
        ->where('nilais.NUPTK','=',$NUPTK)
        ->get();
        $akademik = Tahun_Akademik::where('status','1')->get();
        return view('Guru.Nilai', compact('user','nilai','akademik'));
    }

    public function riwayat_nilai($id){
        $user = Auth::user();
        
        $riwayat = DB::table('riwayat__nilais')
        ->join('nilais', 'nilais.id', '=', 'riwayat__nilais.nilai_id')
        ->join('gurus', 'gurus.NUPTK', '=', 'nilais.NUPTK')
        ->join('mapels', 'mapels.id', '=', 'nilais.mapel_id')
        ->join('kelas', 'kelas.id', '=', 'nilais.kelas_id')
        ->select('nama_lengkap','nama_mapel','nama_kelas')
        ->where('kelas.id','=',$id)
        ->paginate(1);

        $nilai = DB::table('riwayat__nilais')
        ->join('nilais', 'nilais.id', '=', 'riwayat__nilais.nilai_id')
        ->join('siswas', 'siswas.NISN', '=', 'riwayat__nilais.NISN')
        ->select('nama_lengkap','riwayat__nilais.NISN','riwayat__nilais.nilai','riwayat__nilais.id AS idr','nilais.id','riwayat__nilais.ketercapaian','riwayat__nilais.Deskripsi')
        ->where('nilais.id','=',$id)
        ->get();
        return view('Guru.riwayatNilai', compact('user','nilai','riwayat'));
    }

    public function submit_riwayat(Request $req){
        { $validate = $req->validate([
            'NISN'=> 'required|max:255',
            'Nilai'=> 'required|max:255',
            'Ketercapaian'=> 'required|max:255',
            'Deskripsi'=> 'required|max:255',
            'nilai_id'=> 'required',
        ]);
        $riwayat = new Riwayat_Nilai;
        $riwayat->NISN = $req->get('NISN');
        $riwayat->Nilai = $req->get('Nilai');
        $riwayat->ketercapaian = $req->get('Ketercapaian');
        $riwayat->Deskripsi = $req->get('Deskripsi');
        $riwayat->nilai_id = $req->get('nilai_id');
        $riwayat->save();
        Session::flash('status', 'Tambah data Nilai berhasil!!!');
        return redirect()->route('guru.nilai');
    }}
    public function update_riwayat(Request $req)
    { 
        $riwayat= Riwayat_Nilai::find($req->get('id'));
        { $validate = $req->validate([
            'NISN'=> 'required|max:255',
            'Nilai'=> 'required|max:255',
            'Ketercapaian'=> 'required|max:255',
            'Deskripsi'=> 'required|max:255',
            'nilai_id'=> 'required',
        ]);
        $riwayat->NISN = $req->get('NISN');
        $riwayat->Nilai = $req->get('Nilai');
        $riwayat->ketercapaian = $req->get('Ketercapaian');
        $riwayat->Deskripsi = $req->get('Deskripsi');
        $riwayat->nilai_id = $req->get('nilai_id');
        $riwayat->save();
        Session::flash('status', 'Ubah data Nilai berhasil!!!');
        return redirect()->route('guru.nilai');
    }
    }
    public function getDataRiwayat($id)
    {
        $riwayat = Riwayat_Nilai::find($id);
        return response()->json($riwayat);
    }
    public function delete_riwayat($id)
    {
        $riwayat = Riwayat_Nilai::find($id);
        $riwayat->delete();

        Session::flash('status', 'Hapus data Nilai berhasil!!!');
        return redirect()->route('guru.nilai');
    }
}
