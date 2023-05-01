@extends('adminlte::page')
@section('title', 'Data Guru')
@section('content_header')
<h1>Data Guru</h1>
@stop
@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Data Guru') }}</div>
            <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahGuruModal"><i class="fa fa-plus"></i>
                    Tambah Data</button>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#importGuruModal">
                    Import Data</button>
            
                    <hr />
                <table id="table-data" class="table table-striped table-white">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>NUPTK</th>
                            <th>Nama</th>
                            <th>Gender</th>
                            <th>Tanggal Lahir</th>
                            <th>Tempat Lahir</th>
                            <th>Agama</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($guru as $row)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="text-center">{{ $row->NUPTK }}</td>
                                <td class="text-center">{{ $row->nama_lengkap }}</td>
                                <td class="text-center">{{ $row->gender }}</td>
                                <td class="text-center">{{ $row->tanggal_lahir }}</td>
                                <td class="text-center">{{ $row->tempat_lahir }}</td>
                                <td class="text-center">{{ $row->agama }}</td>
                                <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-guru" class="btn btn-xs btn-success"
                                            data-toggle="modal" data-target="#ubahGuruModal"
                                            data-id="{{ $row->id }}"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-xs"></button>
                                            {!! Form::open(['url' => 'admin/data_guru/delete/'.$row->id, 'method' => 'POST']) !!}
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


 <!-- Tambah Guru -->
 <div class="modal fade" id="tambahGuruModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Guru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.guru.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="NUPTK">NUPTK</label>
                            <input type="text" class="form-control" name="NUPTK" id="NUPTK" required />
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" id="nama" required />
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" required />
                        </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" required />
                        </div>
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
     <div class="modal fade" id="ubahGuruModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Guru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.guru.update') }}" enctype="multipart/form-data">
                    @csrf
                        @method('PATCH')
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="edit-NUPTK">NUPTK</label>
                            <input type="text" class="form-control" name="NUPTK" id="edit-NUPTK" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-nama">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" id="edit-nama" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" id="edit-tanggal_lahir" required />
                        </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="edit-tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" id="edit-tempat_lahir" required />
                        </div>
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
    </div>

     <!-- Tambah Siswa -->
     <div class="modal fade" id="importGuruModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Data Guru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.guru.import') }}" enctype="multipart/form-data">
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
            $(document).on('click', '#btn-edit-guru', function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "{{ url('/admin/ajaxadmin/dataGuru') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-NUPTK').val(res.NUPTK);
                        $('#edit-nama').val(res.nama_lengkap);
                        $('#edit-tanggal_lahir').val(res.tanggal_lahir);
                        $('#edit-tempat_lahir').val(res.tempat_lahir);
                        $('#edit-gender').val(res.gender);
                        $('#edit-agama').val(res.agama);
                        $('#edit-id').val(res.id);
                    },
                });
            });
        });

        

        </script>
    @stop