@extends('adminlte::page')
<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@section('title', 'Jadwal Pelajaran')
@section('content_header')
<h1>Jadwal Pelajaran</h1>
@stop
@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Jadwal Pelajaran') }}</div>
            <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahJadwalModal"><i class="fa fa-plus"></i>
                    Tambah Data</button>
            
                    <hr />
                <table id="table-data" class="table table-striped table-white">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>Mata Pelajaran</th>
                            <th>Guru</th>
                            <th>Ruangan</th>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($jadwal as $row)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="text-center">{{$row->mapel->nama_mapel}}</td>
                                <td class="text-center">{{$row->guru->nama_lengkap}}</td>
                                <td class="text-center">{{$row->ruangan->nama_ruangan}}</td>
                                <td class="text-center">{{$row->hari}}</td>
                                <td class="text-center">{{$row->jam}}</td>
                                <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-jadwal" class="btn btn-xs btn-success"
                                            data-toggle="modal" data-target="#ubahJadwalModal"
                                            data-id="{{ $row->id }}"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-xs"></button>
                                            <button type="button" class="btn btn-danger"
                                            onclick="deleteConfirmation('{{ $row->id }}', '{{ $row->mapel->nama_mapel }}' )"><i class="fa fa-times"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

 <!-- Tambah Guru -->
 <div class="modal fade" id="tambahJadwalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.jadwal.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="akademik">Tahun_Akademik</label>
                            <select name="akademik" id="akademik" class="form-control">
                                <option value="">Pilih Tahun Akademik</option>
                                @foreach($akademik as $ak)
                            <option value="{{$ak->id}}">{{$ak->tahun_akademik}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="semester">Semester</label>
                            <select name="semester" id="semester" class="form-control">
                                <option value="">Pilih Semester</option>
                                <option value="Ganjil">Ganjil</option>
                                <option value="Genap">Genap</option>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                            <select name="jurusan" id="jurusan" class="form-control">
                                <option value="">Pilih Jurusan</option>
                                @foreach($jurusan as $jr)
                            <option value="{{$jr->id}}">{{$jr->nama}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="tingkatan">Tingkatan Kelas</label>
                            <select name="tingkatan" id="tingkatan" class="form-control">
                                <option value="">Pilih Tingkatan Kelas</option>
                                @foreach($tingkatan as $tk)
                            <option value="{{$tk->id}}">{{$tk->nama_tingkatan}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="kelas">Kelas</label>
                            <select name="kelas" id="kelas" class="form-control">
                                <option value="">Pilih kelas</option>
                                @foreach($kelas as $ks)
                            <option value="{{$ks->id}}">{{$ks->nama_kelas}}</option>
                            @endforeach
                            </select>
                        </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="mapel">Mapel</label>
                            <select name="mapel" id="mapel" class="form-control">
                                <option value="">Pilih Mapel</option>
                                @foreach($mapel as $ml)
                            <option value="{{$ml->id}}">{{$ml->nama_mapel}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="guru">Guru</label>
                            <select name="guru" id="guru" class="form-control">
                                <option value="">Pilih Guru</option>
                                @foreach($guru as $gr)
                            <option value="{{$gr->id}}">{{$gr->nama_lengkap}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="jam">Jam</label>
                            <select name="jam" id="jam" class="form-control">
                                <option value="">Pilih Jam</option>
                                <option value="07.15 - 08.00">07.15 - 08.00</option>
                                <option value="08.00 - 08.45">08.00 - 08.45</option>
                                <option value="08.45 - 09.30">08.45 - 09.30</option>
                                <option value="10.45 - 11.30">10.45 - 11.30</option>
                                <option value="11.30 - 12.15">11.30 - 12.15</option>
                                <option value="12.15 - 13.30">12.15 - 13.30</option>
                                <option value="13.30 - 14.15">13.30 - 14.15</option>
                                <option value="14.15 - 15.00">14.15 - 15.00</option>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="ruangan">Ruangan</label>
                            <select name="ruangan" id="ruangan" class="form-control">
                                <option value="">Pilih Ruangan</option>
                                @foreach($ruangan as $rg)
                            <option value="{{$rg->id}}">{{$rg->nama_ruangan}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="hari">Hari</label>
                            <select name="hari" id="hari" class="form-control">
                                <option value="">Pilih Hari</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jum'at">Jum'at</option>
                            </select>
                        </div>
                        </div>
                        </div>
                        

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

     <!-- Ubah Guru -->
     <div class="modal fade" id="ubahJadwalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.jadwal.update') }}" enctype="multipart/form-data">
                    @csrf
                        @method('PATCH')
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="edit-akademik">Tahun_Akademik</label>
                            <select name="akademik" id="edit-akademik" class="form-control">
                                <option value="">Pilih Tahun Akademik</option>
                                @foreach($akademik as $ak)
                            <option value="{{$ak->id}}">{{$ak->tahun_akademik}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="edit-semester">Semester</label>
                            <select name="semester" id="edit-semester" class="form-control">
                                <option value="">Pilih Semester</option>
                                <option value="Ganjil">Ganjil</option>
                                <option value="Genap">Genap</option>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="edit-jurusan">Jurusan</label>
                            <select name="jurusan" id="edit-jurusan" class="form-control">
                                <option value="">Pilih Jurusan</option>
                                @foreach($jurusan as $jr)
                            <option value="{{$jr->id}}">{{$jr->nama}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="edit-tingkatan">Tingkatan Kelas</label>
                            <select name="tingkatan" id="edit-tingkatan" class="form-control">
                                <option value="">Pilih Tingkatan Kelas</option>
                                @foreach($tingkatan as $tk)
                            <option value="{{$tk->id}}">{{$tk->nama_tingkatan}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="edit-kelas">Kelas</label>
                            <select name="kelas" id="edit-kelas" class="form-control">
                                <option value="">Pilih kelas</option>
                                @foreach($kelas as $ks)
                            <option value="{{$ks->id}}">{{$ks->nama_kelas}}</option>
                            @endforeach
                            </select>
                        </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="edit-mapel">Mapel</label>
                            <select name="mapel" id="edit-mapel" class="form-control">
                                <option value="">Pilih Mapel</option>
                                @foreach($mapel as $ml)
                            <option value="{{$ml->id}}">{{$ml->nama_mapel}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="edit-guru">Guru</label>
                            <select name="guru" id="edit-guru" class="form-control">
                                <option value="">Pilih Guru</option>
                                @foreach($guru as $gr)
                            <option value="{{$gr->id}}">{{$gr->nama_lengkap}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="edit-jam">Jam</label>
                            <select name="jam" id="edit-jam" class="form-control">
                                <option value="">Pilih Jam</option>
                                <option value="07.15 - 08.00">07.15 - 08.00</option>
                                <option value="08.00 - 08.45">08.00 - 08.45</option>
                                <option value="08.45 - 09.30">08.45 - 09.30</option>
                                <option value="10.45 - 11.30">10.45 - 11.30</option>
                                <option value="11.30 - 12.15">11.30 - 12.15</option>
                                <option value="12.15 - 13.30">12.15 - 13.30</option>
                                <option value="13.30 - 14.15">13.30 - 14.15</option>
                                <option value="14.15 - 15.00">14.15 - 15.00</option>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="edit-ruangan">Ruangan</label>
                            <select name="ruangan" id="edit-ruangan" class="form-control">
                                <option value="">Pilih Ruangan</option>
                                @foreach($ruangan as $rg)
                            <option value="{{$rg->id}}">{{$rg->nama_ruangan}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="edit-hari">Hari</label>
                            <select name="hari" id="edit-hari" class="form-control">
                                <option value="">Pilih Hari</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jum'at">Jum'at</option>
                            </select>
                        </div>
                        </div>
                        </div>
                        

                </div>
                <div class="modal-footer">
                <input type="hidden" name="id" id="edit-id" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @stop
    @section('js')
    <script>
        //EDIT
        $(function() {
            $(document).on('click', '#btn-edit-jadwal', function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "{{ url('/admin/ajaxadmin/dataJadwal') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-akademik').val(res.tahun__akademik_id);
                        $('#edit-semester').val(res.semester);
                        $('#edit-jurusan').val(res.jurusan_id);
                        $('#edit-tingkatan').val(res.tingkatan__kelas_id);
                        $('#edit-kelas').val(res.kelas_id);
                        $('#edit-mapel').val(res.mapel_id);
                        $('#edit-guru').val(res.guru_id);
                        $('#edit-jam').val(res.jam);
                        $('#edit-ruangan').val(res.ruangan_id);
                        $('#edit-hari').val(res.hari);
                        $('#edit-id').val(res.id);
                    },
                });
            });
        });

        function deleteConfirmation(npm, judul) {
            swal.fire({
                title: "Hapus?",
                type: 'warning',
                text: "Apakah anda yakin akan menghapus data buku dengan nama " + judul + "?!",

                showCancelButton: !0,
                confirmButtonText: "Ya, lakukan!",
                cancelButtonText: "Tidak, batalkan!",
                reverseButtons: !0
            }).then(function(e) {

                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "jadwal/delete/" + npm,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            if (results.success === true) {
                                swal.fire("Done!", results.message, "success");
                                // refresh page after 2 seconds
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else {
                                swal.fire("Error!", results.message, "error");
                            }
                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }
        

        </script>
    @stop