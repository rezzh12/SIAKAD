<?php

namespace App\Http\Controllers;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Tingkatan_Kelas;
use App\Models\Tahun_Akademik;
use App\Models\Kelas;
use App\Models\Ruangan;
use App\Models\Mapel;
use App\Models\Jadwal;
use App\Models\Role;
use App\Models\Nilai;
use App\Models\Walikelas;
use App\Models\Kurikulum;
use App\Models\Riwayat_Nilai;
use App\Imports\SiswaImport;
use App\Imports\GuruImport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $data1 = Siswa::count();
        $data2 = Guru::count();
        $data3 = Ruangan::count();
        $data4 = User::count();
        return view('admin.Dashboard', compact('user','data1','data2','data3','data4'));
    }
    public function data_siswa(){
        $user = Auth::user();
        $siswa = Siswa::with('kelas')->get();
        $siswa = Siswa::all();
        $kelas = Kelas::all();
        return view('admin.dataSiswa', compact('user','siswa','kelas'));
    }

    public function submit_siswa(Request $req){
        { $validate = $req->validate([
            'NISN'=> 'required|unique:siswas|min:10|max:10',
            'nama'=> 'required|',
            'tanggal_lahir'=> 'required',
            'tempat_lahir'=> 'required',
            'gender'=> 'required',
            'agama'=> 'required',
            'kelas'=> 'required',
        ]);
        $siswa = new Siswa;
        $siswa->NISN = $req->get('NISN');
        $siswa->nama_lengkap = $req->get('nama');
        $siswa->tanggal_lahir = $req->get('tanggal_lahir');
        $siswa->tempat_lahir = $req->get('tempat_lahir');
        $siswa->gender = $req->get('gender');
        $siswa->agama = $req->get('agama');
        $siswa->kelas_id = $req->get('kelas');
        $siswa->save();
        Session::flash('status', 'Tambah data Siswa berhasil!!!');
        return redirect()->route('admin.siswa');
    }}
    public function getDataSiswa($id)
    {
        $siswa = Siswa::find($id);
        return response()->json($siswa);
    }
    public function update_siswa(Request $req)
    { 
        $siswa= Siswa::find($req->get('id'));
        { $validate = $req->validate([
            'NISN'=> 'required|unique:siswas|min:10|max:10',
            'nama'=> 'required',
            'tanggal_lahir'=> 'required',
            'tempat_lahir'=> 'required',
            'gender'=> 'required',
            'agama'=> 'required',
            'kelas'=> 'required',
        ]);
        $siswa->NISN = $req->get('NISN');
        $siswa->nama_lengkap = $req->get('nama');
        $siswa->tanggal_lahir = $req->get('tanggal_lahir');
        $siswa->tempat_lahir = $req->get('tempat_lahir');
        $siswa->gender = $req->get('gender');
        $siswa->agama = $req->get('agama');
        $siswa->kelas_id = $req->get('kelas');
        $siswa->save();
        Session::flash('status', 'Ubah data Siswa berhasil!!!');
        return redirect()->route('admin.siswa');
    }
    }
    public function delete_siswa($id)
    {
        $siswa = Siswa::find($id);
        $siswa->delete();

        $success = true;
        $message = "Data Siswa Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
    public function importSiswa(Request $req){
        Excel::import(new SiswaImport, $req->file('file'));
        Session::flash('status', 'Import data Siswa berhasil!!!');
        return redirect()->route('admin.siswa');

    }

    public function jurusan(){
        $user = Auth::user();
        $jurusan = Jurusan::all();
        return view('admin.Jurusan', compact('user','jurusan'));
    }

    public function submit_jurusan(Request $req){
        { $validate = $req->validate([
            'kode_jurusan'=> 'required|unique:jurusans|min:5|max:5',
            'nama_jurusan'=> 'required',
        ]);
        $jurusan = new Jurusan;
        $jurusan->kode_jurusan = $req->get('kode_jurusan');
        $jurusan->nama = $req->get('nama_jurusan');

        $jurusan->save();
        Session::flash('status', 'Tambah data Jurusan berhasil!!!');
        return redirect()->route('admin.jurusan');
    }}
    
    public function update_jurusan(Request $req){
        $jurusan= Jurusan::find($req->get('id'));
        { $validate = $req->validate([
            'kode_jurusan'=> 'required|unique:jurusans|min:5|max:5',
            'nama_jurusan'=> 'required',
        ]);
        $jurusan->kode_jurusan = $req->get('kode_jurusan');
        $jurusan->nama = $req->get('nama_jurusan');
        $jurusan->save();
        Session::flash('status', 'Ubah data Jurusan berhasil!!!');
        return redirect()->route('admin.jurusan');
    }}

    public function getDataJurusan($id)
    {
        $jurusan = Jurusan::find($id);
        return response()->json($jurusan);
    }

    public function delete_jurusan($id)
    {
        $jurusan = Jurusan::find($id);
        $jurusan->delete();

        $success = true;
        $message = "Data Jurusan Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
       
    }
    public function tingkatan(){
        $user = Auth::user();
        $tingkatan = Tingkatan_Kelas::all();
        return view('admin.Tingkatankelas', compact('user','tingkatan'));
    }

    public function submit_tingkatan(Request $req){
        { $validate = $req->validate([
            'kode_tingkatan'=> 'required|unique:tingkatan__kelas|min:1|max:1',
            'nama_tingkatan'=> 'required',
        ]);
        $tingkatan = new Tingkatan_Kelas;
        $tingkatan->kode_tingkatan = $req->get('kode_tingkatan');
        $tingkatan->nama_tingkatan = $req->get('nama_tingkatan');

        $tingkatan->save();
        Session::flash('status', 'Tambah data Tingkatan berhasil!!!');
        return redirect()->route('admin.tingkatan');
    }}
    
    public function update_tingkatan(Request $req){
        $tingkatan= Tingkatan_Kelas::find($req->get('id'));
        { $validate = $req->validate([
            'kode_tingkatan'=> 'required|unique:tingkatan_kelas|min:1|max:1',
            'nama_tingkatan'=> 'required',
        ]);
        $tingkatan->kode_tingkatan = $req->get('kode_tingkatan');
        $tingkatan->nama_tingkatan = $req->get('nama_tingkatan');
        $tingkatan->save();
        Session::flash('status', 'Ubah data Tingkatan berhasil!!!');
        return redirect()->route('admin.tingkatan');
    }}

    public function getDataTingkatan($id)
    {
        $tingkatan = Tingkatan_Kelas::find($id);
        return response()->json($tingkatan);
    }

    public function delete_tingkatan($id)
    {
        $tingkatan = Tingkatan_Kelas::find($id);
        $tingkatan->delete();
        $success = true;
        $message = "Data Tingkatan Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
       
    }

    public function ruangan(){
        $user = Auth::user();
        $ruangan = Ruangan::all();
        return view('admin.Ruangan', compact('user','ruangan'));
    }

    public function submit_ruangan(Request $req){
        { $validate = $req->validate([
            'kode_ruangan'=> 'required|unique:ruangans|min:5|max:5',
            'nama_ruangan'=> 'required',
        ]);
        $ruangan = new Ruangan;
        $ruangan->kode_ruangan = $req->get('required|unique:posts|min:5|max:5');
        $ruangan->nama_ruangan = $req->get('nama_ruangan');

        $ruangan->save();
        Session::flash('status', 'Tambah data Ruangan berhasil!!!');
        return redirect()->route('admin.ruangan');
    }}
    
    public function update_ruangan(Request $req){
        $ruangan= Ruangan::find($req->get('id'));
        { $validate = $req->validate([
            'kode_ruangan'=> 'required|unique:ruangans|min:5|max:5',
            'nama_ruangan'=> 'required',
        ]);
        $ruangan->kode_ruangan = $req->get('kode_ruangan');
        $ruangan->nama_ruangan = $req->get('nama_ruangan');

        $ruangan->save();
        Session::flash('status', 'Ubah data Ruangan berhasil!!!');
        return redirect()->route('admin.ruangan');
    }}

    public function getDataRuangan($id)
    {
        $ruangan = Ruangan::find($id);
        return response()->json($ruangan);
    }

    public function delete_ruangan($id)
    {
        $ruangan = Ruangan::find($id);
        $ruangan->delete();
        $success = true;
        $message = "Data Ruangan Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
       
    }

    public function mapel(){
        $user = Auth::user();
        $mapel = Mapel::all();
        return view('admin.Mapel', compact('user','mapel'));
    }

    public function submit_mapel(Request $req){
        { $validate = $req->validate([
            'kode_mapel'=> 'required|unique:mapels|min:5|max:5',
            'nama_mapel'=> 'required',
        ]);
        $mapel = new Mapel;
        $mapel->kode_mapel = $req->get('kode_mapel');
        $mapel->nama_mapel = $req->get('nama_mapel');

        $mapel->save();
        Session::flash('status', 'Tambah data Mapel berhasil!!!');
        return redirect()->route('admin.mapel');
    }}
    
    public function update_mapel(Request $req){
        $mapel= Mapel::find($req->get('id'));
        { $validate = $req->validate([
            'kode_mapel'=> 'required|unique:mapels|min:5|max:5',
            'nama_mapel'=> 'required',
        ]);
        $mapel->kode_mapel = $req->get('kode_mapel');
        $mapel->nama_mapel = $req->get('nama_mapel');

        $mapel->save();
        Session::flash('status', 'Ubah data Mapel berhasil!!!');
        return redirect()->route('admin.mapel');
    }}

    public function getDataMapel($id)
    {
        $mapel = Mapel::find($id);
        return response()->json($mapel);
    }

    public function delete_mapel($id)
    {
        $mapel = Mapel::find($id);
        $mapel->delete();

        $success = true;
        $message = "Data Mata Pelajaran Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function akademik(){
        $user = Auth::user();
        $akademik = Tahun_Akademik::all();
        return view('admin.tahunAkademik', compact('user','akademik'));
    }

    public function submit_akademik(Request $req){
        { $validate = $req->validate([
            'akademik'=> 'required',
            'semester'=> 'required',
            'status'=> 'required',
        ]);
        $akademik = new Tahun_Akademik;
        $akademik->tahun_akademik = $req->get('akademik');
        $akademik->semester = $req->get('semester');
        $akademik->status = $req->get('status');

        $akademik->save();
        Session::flash('status', 'Tambah data Tahun Akademik berhasil!!!');
        return redirect()->route('admin.akademik');
    }}
    
    public function update_akademik(Request $req){
        $akademik= Tahun_Akademik::find($req->get('id'));
        { $validate = $req->validate([
            'akademik'=> 'required',
            'semester'=> 'required',
            'status'=> 'required',
        ]);
        $akademik->tahun_akademik = $req->get('akademik');
        $akademik->semester = $req->get('semester');
        $akademik->status = $req->get('status');

        $akademik->save();
        Session::flash('status', 'Ubah data Tahun Akademik berhasil!!!');
        return redirect()->route('admin.akademik');
    }}

    public function getDataAkademik($id)
    {
        $akademik = Tahun_Akademik::find($id);
        return response()->json($akademik);
    }

    public function delete_akademik($id)
    {
        $akademik = Tahun_Akademik::find($id);
        $akademik->delete();
        $success = true;
        $message = "Data Akademik Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
       
    }

    public function kurikulum(){
        $user = Auth::user();
        $kurikulum = Kurikulum::all();
        return view('admin.Kurikulum', compact('user','kurikulum'));
    }

    public function submit_kurikulum(Request $req){
        { $validate = $req->validate([
            'kode_kurikulum'=> 'required|unique:kurikulums|min:3|max:3',
            'nama_kurikulum'=> 'required',
            'status'=> 'required',
        ]);
        $kurikulum = new Kurikulum;
        $kurikulum->kode_kurikulum = $req->get('kode_kurikulum');
        $kurikulum->nama_kurikulum = $req->get('nama_kurikulum');
        $kurikulum->status = $req->get('status');

        $kurikulum->save();
        Session::flash('status', 'Tambah data Kurikulum berhasil!!!');
        return redirect()->route('admin.kurikulum');
    }}
    
    public function update_kurikulum(Request $req){
        $kurikulum = Kurikulum::find($req->get('id'));
        { $validate = $req->validate([
            'kode_kurikulum'=> 'required|unique:kurikulums|min:3|max:3',
            'nama_kurikulum'=> 'required',
            'status'=> 'required',
        ]);
        $kurikulum->kode_kurikulum = $req->get('kode_kurikulum');
        $kurikulum->nama_kurikulum = $req->get('nama_kurikulum');
        $kurikulum->status = $req->get('status');

        $kurikulum->save();
        Session::flash('status', 'Ubah data Kurikulum berhasil!!!');
        return redirect()->route('admin.kurikulum');
    }}

    public function getDataKurikulum($id)
    {
        $kurikulum = Kurikulum::find($id);
        return response()->json($kurikulum);
    }

    public function delete_kurikulum($id)
    {
        $kurikulum = Kurikulum::find($id);
        $kurikulum->delete();
        $success = true;
        $message = "Data Kurikulum Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function kelas(){
        $user = Auth::user();
        $kelas = Kelas::with('tingkatan')->get();
        $kelas = Kelas::with('jurusan')->get();
        $tingkatan = Tingkatan_Kelas::all();
        $jurusan = Jurusan::all();
        return view('admin.Kelas', compact('user','kelas','tingkatan','jurusan'));
    }

    public function submit_kelas(Request $req){
        { $validate = $req->validate([
            'kode_kelas'=> 'required|unique:kelas|min:4|max:5',
            'nama_kelas'=> 'required',
            'tingkatan_id'=> 'required',
            'jurusan_id'=> 'required',
        ]);
        $kelas = new Kelas;
        $kelas->kode_kelas = $req->get('kode_kelas');
        $kelas->nama_kelas = $req->get('nama_kelas');
        $kelas->tingkatan__kelas_id = $req->get('tingkatan_id');
        $kelas->jurusan_id = $req->get('jurusan_id');

        $kelas->save();
        Session::flash('status', 'Tambah data Kelas berhasil!!!');
        return redirect()->route('admin.kelas.tingkatan.jurusan');
    }}
    
    public function update_kelas(Request $req){
        $kelas= Kelas::find($req->get('id'));
        { $validate = $req->validate([
            'kode_kelas'=> 'required|unique:kelas|min:4|max:5',
            'nama_kelas'=> 'required',
            'tingkatan_id'=> 'required',
            'jurusan_id'=> 'required',
        ]);
        $kelas->kode_kelas = $req->get('kode_kelas');
        $kelas->nama_kelas = $req->get('nama_kelas');
        $kelas->tingkatan__kelas_id = $req->get('tingkatan_id');
        $kelas->jurusan_id = $req->get('jurusan_id');
        $kelas->save();
        Session::flash('status', 'Ubah data Kelas berhasil!!!');
        return redirect()->route('admin.kelas.tingkatan.jurusan');
    }}

    public function getDataKelas($id)
    {
        $kelas = Kelas::find($id);
        return response()->json($kelas);
    }

    public function delete_kelas($id)
    {
        $kelas = Kelas::find($id);
        $kelas->delete();
        $success = true;
        $message = "Data Kelas Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function data_guru(){
        $user = Auth::user();
        $guru = Guru::all();
        return view('admin.dataGuru', compact('user','guru'));
    }

    public function submit_guru(Request $req){
        { $validate = $req->validate([
            'NUPTK'=> 'required|unique:gurus|min:16|max:16',
            'nama'=> 'required',
            'tanggal_lahir'=> 'required',
            'tempat_lahir'=> 'required',
            'gender'=> 'required',
            'agama'=> 'required',
        ]);
        $guru = new Guru;
        $guru->NUPTK = $req->get('NUPTK');
        $guru->nama_lengkap = $req->get('nama');
        $guru->tanggal_lahir = $req->get('tanggal_lahir');
        $guru->tempat_lahir = $req->get('tempat_lahir');
        $guru->gender = $req->get('gender');
        $guru->agama = $req->get('agama');
        $guru->save();
        Session::flash('status', 'Tambah data Guru berhasil!!!');
        return redirect()->route('admin.guru');
    }}
    public function getDataGuru($id)
    {
        $guru = Guru::find($id);
        return response()->json($guru);
    }
    public function update_guru(Request $req)
    { 
        $guru= Guru::find($req->get('id'));
        { $validate = $req->validate([
            'NUPTK'=> 'required|unique:gurus|min:16|max:16',
            'nama'=> 'required',
            'tanggal_lahir'=> 'required',
            'tempat_lahir'=> 'required',
            'gender'=> 'required',
            'agama'=> 'required',
        ]);
        $guru->NUPTK = $req->get('NUPTK');
        $guru->nama_lengkap = $req->get('nama');
        $guru->tanggal_lahir = $req->get('tanggal_lahir');
        $guru->tempat_lahir = $req->get('tempat_lahir');
        $guru->gender = $req->get('gender');
        $guru->agama = $req->get('agama');
        $guru->save();
        Session::flash('status', 'Ubah data Guru berhasil!!!');
        return redirect()->route('admin.guru');
    }
    }
    public function delete_guru($id)
    {
        $guru = Guru::find($id);
        $guru->delete();
        $success = true;
        $message = "Data Guru Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
    public function importGuru(Request $req){
        Excel::import(new GuruImport, $req->file('file'));
        Session::flash('status', 'Import data Guru berhasil!!!');
        return redirect()->route('admin.guru');

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
        return view('admin.jadwalPelajaran', compact('user','jadwal','guru','akademik','mapel','ruangan','jurusan','tingkatan','kelas'));
    }

    public function submit_jadwal(Request $req){
        { $validate = $req->validate([
            'akademik'=> 'required',
            'semester'=> 'required',
            'jurusan'=> 'required',
            'tingkatan'=> 'required',
            'kelas'=> 'required',
            'mapel'=> 'required',
            'guru'=> 'required',
            'jam'=> 'required',
            'ruangan'=> 'required',
            'hari'=> 'required',
        ]);
        $jadwal = new Jadwal;
        $jadwal->tahun__akademik_id = $req->get('akademik');
        $jadwal->semester = $req->get('semester');
        $jadwal->jurusan_id = $req->get('jurusan');
        $jadwal->tingkatan__kelas_id = $req->get('tingkatan');
        $jadwal->kelas_id = $req->get('kelas');
        $jadwal->mapel_id = $req->get('mapel');
        $jadwal->guru_id = $req->get('guru');
        $jadwal->jam = $req->get('jam');
        $jadwal->ruangan_id = $req->get('ruangan');
        $jadwal->hari = $req->get('hari');
        $jadwal->save();
        Session::flash('status', 'Tambah data Jadwal berhasil!!!');
        return redirect()->route('admin.jadwal');
    }}
    public function getDataJadwal($id)
    {
        $jadwal = Jadwal::find($id);
        return response()->json($jadwal);
    }
    public function update_jadwal(Request $req)
    { 
        $jadwal= Jadwal::find($req->get('id'));
        { $validate = $req->validate([
            'akademik'=> 'required',
            'semester'=> 'required',
            'jurusan'=> 'required',
            'tingkatan'=> 'required',
            'kelas'=> 'required',
            'mapel'=> 'required',
            'guru'=> 'required',
            'jam'=> 'required',
            'ruangan'=> 'required',
            'hari'=> 'required',
        ]);
        $jadwal->tahun__akademik_id = $req->get('akademik');
        $jadwal->semester = $req->get('semester');
        $jadwal->jurusan_id = $req->get('jurusan');
        $jadwal->tingkatan__kelas_id = $req->get('tingkatan');
        $jadwal->kelas_id = $req->get('kelas');
        $jadwal->mapel_id = $req->get('mapel');
        $jadwal->guru_id = $req->get('guru');
        $jadwal->jam = $req->get('jam');
        $jadwal->ruangan_id = $req->get('ruangan');
        $jadwal->hari = $req->get('hari');
        $jadwal->save();
        Session::flash('status', 'Ubah data Jadwal berhasil!!!');
        return redirect()->route('admin.jadwal');
    }
    }
    public function delete_jadwal($id)
    {
        $jadwal = Jadwal::find($id);
        $jadwal->delete();

        $success = true;
        $message = "Data Jadwal Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function walikelas(){
        $user = Auth::user();
        $akademik = Tahun_Akademik::all();
        $kelas = Kelas::all();
        $guru = Guru::all();
        $walikelas = Walikelas::with('guru')->get();
        $walikelas = Walikelas::with('akademik')->get();;
        $walikelas = Walikelas::with('kelas')->get();;
        $walikelas = Walikelas::all();
        return view('admin.dataWalikelas', compact('user','walikelas','guru','akademik','kelas'));
    }
    public function submit_walikelas(Request $req){
        { $validate = $req->validate([
            'akademik'=> 'required',
            'kelas'=> 'required',
            'guru'=> 'required|min:16|max:16',
        ]);
        $walikelas = new Walikelas;
        $walikelas->tahun__akademik_id = $req->get('akademik');
        $walikelas->kelas_id = $req->get('kelas');
        $walikelas->NUPTK = $req->get('guru');
        $walikelas->save();
        Session::flash('status', 'Tambah data Walikelas berhasil!!!');
        return redirect()->route('admin.walikelas');
    }}
    public function getDataWalikelas($id)
    {
        $walikelas = Walikelas::find($id);
        return response()->json($walikelas);
    }
    public function update_walikelas(Request $req)
    { 
        $walikelas= Walikelas::find($req->get('id'));
        { $validate = $req->validate([
            'akademik'=> 'required',
            'kelas'=> 'required',
            'guru'=> 'required|min:16|max:16',
        ]);
        $walikelas->tahun__akademik_id = $req->get('akademik');
        $walikelas->kelas_id = $req->get('kelas');
        $walikelas->NUPTK = $req->get('guru');
        $walikelas->save();
        Session::flash('status', 'Ubah data Walikelas berhasil!!!');
        return redirect()->route('admin.walikelas');
    }
    }
    public function delete_walikelas($id)
    {
        $walikelas = Walikelas::find($id);
        $walikelas->delete();
        $success = true;
        $message = "Data Walikelas Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function nilai_siswa(){
        $user = Auth::user();
        $nilai = Nilai::all();
        $nilai = Nilai::with('akademik','guru','mapel','kelas')->get();
        $kelas = kelas::all();
        $guru = Guru::all();
        $mapel = Mapel::all();
        $akademik = Tahun_Akademik::where('status','1')->get();
        return view('admin.Nilai', compact('user','nilai','kelas','guru','mapel','akademik'));
    }

    public function submit_nilai(Request $req){
        { $validate = $req->validate([
            'akademik'=> 'required',
            'guru'=> 'required',
            'mapel'=> 'required',
            'kelas'=> 'required',
        ]);
        $nilai = new Nilai;
        $nilai->tahun__akademik_id = $req->get('akademik');
        $nilai->NUPTK = $req->get('guru');
        $nilai->mapel_id = $req->get('mapel');
        $nilai->kelas_id = $req->get('kelas');
        $nilai->save();
        Session::flash('status', 'Tambah data Nilai berhasil!!!');
        return redirect()->route('admin.nilai');
    }}
    public function getDataNilai($id)
    {
        $nilai = Nilai::find($id);
        return response()->json($nilai);
    }
    public function update_nilai(Request $req)
    { 
        $nilai= Nilai::find( $req->get('id'));
        { $validate = $req->validate([
            'akademik'=> 'required',
            'guru'=> 'required',
            'mapel'=> 'required',
            'kelas'=> 'required',
        ]);
        $nilai->tahun__akademik_id = $req->get('akademik');
        $nilai->NUPTK = $req->get('guru');
        $nilai->mapel_id = $req->get('mapel');
        $nilai->kelas_id = $req->get('kelas');
        $nilai->save();
        Session::flash('status', 'Ubah data Nilai berhasil!!!');
        return redirect()->route('admin.nilai');
    }
    }
    public function delete_nilai($id)
    {
        $nilai = Nilai::find($id);
        $nilai->delete();

        $success = true;
        $message = "Data Nilai Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
    public function riwayat_nilai($id){
        $user = Auth::user();
        $riwayat = Riwayat_Nilai::where('nilai_id', $id)->with('siswa')->get();
        $nilai = Nilai::where('id',$id)->with('akademik','guru','mapel','kelas')->get();
        return view('admin.riwayatNilai', compact('user','nilai','riwayat'));
    }

    public function submit_riwayat(Request $req){
        { $validate = $req->validate([
            'NISN'=> 'required|unique:riwayat__nilais|min:10|max:10',
            'Nilai'=> 'required',
            'nilai_id'=> 'required',
        ]);
        $riwayat = new Riwayat_Nilai;
        $riwayat->NISN = $req->get('NISN');
        $riwayat->Nilai = $req->get('Nilai');
        $riwayat->ketercapaian = null;
        $riwayat->Deskripsi = null;
        $riwayat->nilai_id = $req->get('nilai_id');
        $riwayat->save();
        Session::flash('status', 'Tambah data Nilai berhasil!!!');
        return redirect()->back();
    }}
    public function getDataRiwayat($id)
    {
        $riwayat = Riwayat_Nilai::find($id);
        return response()->json($riwayat);
    }
    public function update_riwayat(Request $req)
    { 
        $riwayat= Riwayat_Nilai::find($req->get('id'));
        { $validate = $req->validate([
            'NISN'=> 'required|unique:riwayat__nilais|min:10|max:10',
            'Nilai'=> 'required|max:255',
            'nilai_id'=> 'required',
        ]);
        $riwayat->NISN = $req->get('NISN');
        $riwayat->Nilai = $req->get('Nilai');
        $riwayat->ketercapaian = null;
        $riwayat->Deskripsi = null;
        $riwayat->nilai_id = $req->get('nilai_id');
        $riwayat->save();
        Session::flash('status', 'Ubah data Nilai berhasil!!!');
        return redirect()->back();
    }
    }
    public function delete_riwayat($id)
    {
        $riwayat = Riwayat_Nilai::find($id);
        $riwayat->delete();
        
        $success = true;
        $message = "Data Riwayat Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
    
    public function all_nilai($id){
        $user = Auth::user();
        $riwayat = DB::table('riwayat__nilais')
        ->join('siswas', 'siswas.NISN', '=', 'riwayat__nilais.NISN')
        ->join('kelas', 'kelas.id', '=', 'siswas.kelas_id')
        ->select('nama_lengkap','riwayat__nilais.NISN','nama_kelas')
        ->where('riwayat__nilais.NISN','=',$id)
        ->paginate(1);

        $nilai = DB::table('riwayat__nilais')
        ->join('nilais', 'nilais.id', '=', 'riwayat__nilais.nilai_id')
        ->join('mapels', 'mapels.id', '=', 'nilais.mapel_id')
        ->join('kelas', 'kelas.id', '=', 'nilais.kelas_id')
        ->select('nama_mapel','nama_kelas','NISN','nilai')
        ->where('riwayat__nilais.NISN','=',$id)
        ->get();
        return view('admin.tampil', compact('user','nilai','riwayat'));
    }
    public function data_user(){
        $user = Auth::user();
        $pengguna = User::with('roles')->get();
        $roles = Role::all();
        return view('admin.dataUser', compact('user','pengguna','roles'));
    }

    public function submit_user(Request $req){
        { $validate = $req->validate([
            'id_status'=> 'required|unique:users|min:10|max:16',
            'name'=> 'required',
            'username'=> 'required',
            'email'=> 'required',
            'password'=> 'required',
            'roles_id'=> 'required',
        ]);
        
        $user = new User;
        $user->id_status = $req->get('id_status');
        $user->name = $req->get('name');
        $user->username = $req->get('username');
        $user->email = $req->get('email');
        $user->password = Hash::make($req->get('password'));
        $user->roles_id = $req->get('roles_id');
        $user->email_verified_at = null;
        $user->remember_token = null;
        $user->save();
        Session::flash('status', 'Tambah data User berhasil!!!');
        return redirect()->route('admin.pengguna');
    }}
    public function getDataUser($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }
    public function update_user(Request $req)
    { 
        $user= User::find($req->get('id'));
        { $validate = $req->validate([
            'id_status'=> 'required|min:10|max:16',
            'name'=> 'required',
            'username'=> 'required',
            'email'=> 'required',
            'password'=> 'required',
            'roles_id'=> 'required',
        ]);
        $user->id_status = $req->get('id_status');
        $user->name = $req->get('name');
        $user->username = $req->get('username');
        $user->email = $req->get('email');
        $user->password = Hash::make($req->get('password'));
        $user->roles_id = $req->get('roles_id');
        $user->email_verified_at = null;
        $user->remember_token = null;
        $user->save();
        Session::flash('status', 'Ubah data User berhasil!!!');
        return redirect()->route('admin.pengguna');
    }
    }
    public function delete_user($id)
    {
        $user = User::find($id);
        $user->delete();
        $success = true;
        $message = "Data Pengguna Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
