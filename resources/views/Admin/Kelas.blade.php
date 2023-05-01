@extends('adminlte::page')
@section('title', 'Data Kelas')
@section('content_header')
<h1>Data Kelas</h1>
@stop
@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Data Kelas') }}</div>
            <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahKelasModal"><i class="fa fa-plus"></i>
                    Tambah Data</button>
                    <hr />
                <table id="table-data" class="table table-striped table-white">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>Kode Kelas</th>
                            <th>Nama Kelas</th>
                            <th>Tingakatan</th>
                            <th>Jurusan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($kelas as $row)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="text-center">{{ $row->kode_kelas }}</td>
                                <td class="text-center">{{ $row->nama_kelas }}</td>
                                <td class="text-center">{{ $row->tingkatan->nama_tingkatan }}</td>
                                <td class="text-center">{{ $row->jurusan->nama }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-kelas" class="btn btn-xs btn-success"
                                            data-toggle="modal" data-target="#ubahKelasModal"
                                            data-id="{{ $row->id }}"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-xs"></button>
                                            {!! Form::open(['url' => 'admin/kelas/delete/'.$row->id, 'method' => 'POST']) !!}
                                        {{ Form::button('<i class="fa fa-times"></i>', ['class' => 'btn btn-xs btn-danger', 'onclick' => "deleteConfirmation('".$row->nama_kelas."')"]) }}
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

<!-- Tambah Tingkatan -->
<div class="modal fade" id="tambahKelasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Tingkatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.kelas.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="kode_kelas">Kode Kelas</label>
                            <input type="text" class="form-control" name="kode_kelas" id="kode_kelas" required />
                        </div>
                        <div class="form-group">
                            <label for="nama_kelas">Nama Kelas</label>
                            <input type="text" class="form-control" name="nama_kelas" id="nama_kelas" required />
                        </div>
                        <div class="form-group">
                        <label for="tingkatan_id">Tingkatan</label>
                            <select name="tingkatan_id" id="tingkatan_id" class="form-control">
                                <option value="">Pilih Tingkatan</option>
                                @foreach($tingkatan as $tk)
                            <option value="{{$tk->id}}">{{$tk->nama_tingkatan}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="jurusan_id">Jurusan</label>
                            <select name="jurusan_id" id="edit-jurusan_id" class="form-control">
                                <option value="">Pilih Jurusan</option>
                                @foreach($jurusan as $jr)
                            <option value="{{$jr->id}}">{{$jr->nama}}</option>
                            @endforeach
                            </select>
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


     <!-- Ubah Tingkatan -->
     <div class="modal fade" id="ubahKelasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Jurusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.kelas.update') }}" enctype="multipart/form-data">
                    @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="edit-kode_kelas">Kode Tingkatan</label>
                            <input type="text" class="form-control" name="kode_kelas" id="edit-kode_kelas" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-nama_kelas">Nama Tingkatan</label>
                            <input type="text" class="form-control" name="nama_kelas" id="edit-nama_kelas" required />
                        </div>
                        <div class="form-group">
                        <label for="edit-tingkatan_id">Tingkatan</label>
                            <select name="tingkatan_id" id="edit-tingkatan_id" class="form-control">
                                <option value="">Pilih Tingkatan</option>
                                @foreach($tingkatan as $tk)
                            <option value="{{$tk->id}}">{{$tk->nama_tingkatan}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="edit-jurusan_id">Jurusan</label>
                            <select name="jurusan_id" id="edit-jurusan_id" class="form-control">
                                <option value="">Pilih Jurusan</option>
                                @foreach($jurusan as $jr)
                            <option value="{{$jr->id}}">{{$jr->nama}}</option>
                            @endforeach
                            </select>
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
    @stop

    @section('js')
    <script>
        //EDIT
        $(function() {
            $(document).on('click', '#btn-edit-kelas', function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "{{ url('/admin/ajaxadmin/dataKelas') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-kode_kelas').val(res.kode_kelas);
                        $('#edit-nama_kelas').val(res.nama_kelas);
                        $('#edit-tingkatan_id').val(res.tingkatan__kelas_id);
                        $('#edit-jurusan_id').val(res.jurusan_id);
                        $('#edit-id').val(res.id);
                    },
                });
            });
        });

        
        </script>
    @stop