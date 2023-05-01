@extends('adminlte::page')
@section('title', 'Data Mapel')
@section('content_header')
<h1>Data Mapel</h1>
@stop
@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Data Mapel') }}</div>
            <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahMapelModal"><i class="fa fa-plus"></i>
                    Tambah Data</button>
                    <hr />
                <table id="table-data" class="table table-striped table-white">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>Kode Mapel</th>
                            <th>Nama Mata Pelajaran </th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($mapel as $row)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="text-center">{{ $row->kode_mapel }}</td>
                                <td class="text-center">{{ $row->nama_mapel }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-mapel" class="btn btn-xs btn-success"
                                            data-toggle="modal" data-target="#ubahMapelModal"
                                            data-id="{{ $row->id }}"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-xs"></button>
                                            {!! Form::open(['url' => 'admin/mapel/delete/'.$row->id, 'method' => 'POST']) !!}
                                        {{ Form::button('<i class="fa fa-times"></i>', ['class' => 'btn btn-xs btn-danger', 'onclick' => "deleteConfirmation('".$row->nama_mapel."')"]) }}
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

<!-- Tambah Mapel -->
<div class="modal fade" id="tambahMapelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mapel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.mapel.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="kode_mapel">Kode Mapel</label>
                            <input type="text" class="form-control" name="kode_mapel" id="kode_mapel" required />
                        </div>
                        <div class="form-group">
                            <label for="nama_mapel">Nama Mata Pelajarn</label>
                            <input type="text" class="form-control" name="nama_mapel" id="nama_mapel" required />
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
     <div class="modal fade" id="ubahMapelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Mapel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.mapel.update') }}" enctype="multipart/form-data">
                    @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="edit-kode_mapel">Kode Mapel</label>
                            <input type="text" class="form-control" name="kode_mapel" id="edit-kode_mapel" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-nama_mapel">Nama Mapel</label>
                            <input type="text" class="form-control" name="nama_mapel" id="edit-nama_mapel" required />
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
            $(document).on('click', '#btn-edit-mapel', function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "{{ url('/admin/ajaxadmin/dataMapel') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-kode_mapel').val(res.kode_mapel);
                        $('#edit-nama_mapel').val(res.nama_mapel);
                        $('#edit-id').val(res.id);
                    },
                });
            });
        });

        </script>
    @stop