@extends('adminlte::page')
@section('title', 'Data Siswa')
@section('content_header')
<h1>Data Siswa</h1>
@stop
@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Data Siswa') }}</div>
            <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahSiswaModal"><i class="fa fa-plus"></i>
                    Tambah Data</button>
            <button class="btn btn-warning" data-toggle="modal" data-target="#importSiswaModal">
                    Import Data</button>
            
                    <hr />
                <table id="table-data" class="table table-striped table-white">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Gender</th>
                            <th>Tanggal Lahir</th>
                            <th>Tempat Lahir</th>
                            <th>Agama</th>
                            <th>Kelas</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($siswa as $row)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="text-center">{{ $row->NISN }}</td>
                                <td class="text-center">{{ $row->nama_lengkap }}</td>
                                <td class="text-center">{{ $row->gender }}</td>
                                <td class="text-center">{{ $row->tanggal_lahir }}</td>
                                <td class="text-center">{{ $row->tempat_lahir }}</td>
                                <td class="text-center">{{ $row->agama }}</td>
                                <td class="text-center">{{ $row->kelas->nama_kelas }}</td>
                                <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-siswa" class="btn btn-xs btn-success"
                                            data-toggle="modal" data-target="#ubahSiswaModal"
                                            data-id="{{ $row->id }}"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-xs"></button>
                                            {!! Form::open(['url' => 'admin/data_siswa/delete/'.$row->id, 'method' => 'POST']) !!}
                                        {{ Form::button('<i class="fa fa-times"></i>', ['class' => 'btn btn-xs btn-danger', 'onclick' => "deleteConfirmation('".$row->nama_lengkap."')"]) }}
                                    {!! Form::close() !!}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

 <!-- Tambah Siswa -->
    <div class="modal fade" id="tambahSiswaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.siswa.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="NISN">NISN</label>
                            <input type="text" class="form-control" name="NISN" id="NISN" required />
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" required />
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" required />
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" required />
                        </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="">Pilih Gender</option>
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="agama">Agama</label>
                            <select name="agama" id="agama" class="form-control">
                                <option value="">Pilih Agama</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Protestan">Protestan</option>
                                <option value="Khatolik">Khatolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Khong Hu Chu">Khong Hu Chu</option>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="kelas">Kelas</label>
                            <select name="kelas" id="kelas" class="form-control">
                                <option value="">Pilih Kelas</option>
                                @foreach($kelas as $ks)
                            <option value="{{$ks->id}}">{{$ks->nama_kelas}}</option>
                            @endforeach
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

     <!-- Ubah Siswa -->
     <div class="modal fade" id="ubahSiswaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.siswa.update') }}" enctype="multipart/form-data">
                    @csrf
                        @method('PATCH')
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="edit-NISN">NISN</label>
                            <input type="text" class="form-control" name="NISN" id="edit-NISN" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-nama">Nama</label>
                            <input type="text" class="form-control" name="nama" id="edit-nama" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" id="edit-tanggal_lahir" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" id="edit-tempat_lahir" required />
                        </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="edit-gender">Gender</label>
                            <select name="gender" id="edit-gender" class="form-control">
                                <option value="">Pilih Gender</option>
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="edit-agama">Agama</label>
                            <select name="agama" id="edit-agama" class="form-control">
                                <option value="">Pilih Agama</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Protestan">Protestan</option>
                                <option value="Khatolik">Khatolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Khong Hu Chu">Khong Hu Chu</option>
                            </select>
                        </div>
                        <label for="edit-kelas">Kelas</label>
                            <select name="kelas" id="edit-kelas" class="form-control">
                                <option value="">Pilih Kelas</option>
                                @foreach($kelas as $ks)
                            <option value="{{$ks->id}}">{{$ks->nama_kelas}}</option>
                            @endforeach
                            </select>
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

     <!-- Tambah Siswa -->
     <div class="modal fade" id="importSiswaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Data Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.siswa.import') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="cover">Upload File</label>
                            <input type="file" class="form-control" name="file" id="file" required />
                        </div>
                        

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Import Data</button>
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
            $(document).on('click', '#btn-edit-siswa', function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "{{ url('/admin/ajaxadmin/dataSiswa') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-NISN').val(res.NISN);
                        $('#edit-nama').val(res.nama_lengkap);
                        $('#edit-tanggal_lahir').val(res.tanggal_lahir);
                        $('#edit-tempat_lahir').val(res.tempat_lahir);
                        $('#edit-gender').val(res.gender);
                        $('#edit-agama').val(res.agama);
                        $('#edit-kelas').val(res.kelas_id);
                        $('#edit-id').val(res.id);
                    },
                });
            });
        });


        </script>
    @stop