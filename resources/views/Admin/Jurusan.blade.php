@extends('adminlte::page')
@section('title', 'Data Jurusan')
@section('content_header')
<h1>Data Jurusan</h1>
@stop
@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Data Jurusan') }}</div>
            <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahJurusanModal"><i class="fa fa-plus"></i>
                    Tambah Data</button>
                    <hr />
                <table id="table-data" class="table table-striped table-white">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>Kode Jurusan</th>
                            <th>Nama Jurusan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($jurusan as $row)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="text-center">{{ $row->kode_jurusan }}</td>
                                <td class="text-center">{{ $row->nama }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-jurusan" class="btn btn-xs btn-success"
                                            data-toggle="modal" data-target="#ubahJurusanModal"
                                            data-id="{{ $row->id }}"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-xs"></button>
                                            {!! Form::open(['url' => 'admin/jurusan/delete/'.$row->id, 'method' => 'POST']) !!}
                                        {{ Form::button('<i class="fa fa-times"></i>', ['class' => 'btn btn-xs btn-danger', 'onclick' => "deleteConfirmation('".$row->nama."')"]) }}
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

<!-- Tambah Jurusan -->
<div class="modal fade" id="tambahJurusanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jurusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.jurusan.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="kode_jurusan">Kode Jurusan</label>
                            <input type="text" class="form-control" name="kode_jurusan" id="kode_jurusan" required />
                        </div>
                        <div class="form-group">
                            <label for="nama_jurusan">Nama Jurusan</label>
                            <input type="text" class="form-control" name="nama_jurusan" id="nama_jurusan" required />
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


     <!-- Ubah Jurusan -->
     <div class="modal fade" id="ubahJurusanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Jurusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.jurusan.update') }}" enctype="multipart/form-data">
                    @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="edit-kode_jurusan">Kode Jurusan</label>
                            <input type="text" class="form-control" name="kode_jurusan" id="edit-kode_jurusan" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-nama_jurusan">Nama Jurusan</label>
                            <input type="text" class="form-control" name="nama_jurusan" id="edit-nama_jurusan" required />
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
            $(document).on('click', '#btn-edit-jurusan', function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "{{ url('/admin/ajaxadmin/dataJurusan') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-kode_jurusan').val(res.kode_jurusan);
                        $('#edit-nama_jurusan').val(res.nama);
                        $('#edit-id').val(res.id);
                    },
                });
            });
        });

        
        </script>
    @stop