@extends('adminlte::page')
@section('title', 'Data Ruangan')
@section('content_header')
<h1>Data Ruangan</h1>
@stop
@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Data Ruangan') }}</div>
            <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahRuanganModal"><i class="fa fa-plus"></i>
                    Tambah Data</button>
                    <hr />
                <table id="table-data" class="table table-striped table-white">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>Kode Ruangan</th>
                            <th>Nama Ruangan </th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($ruangan as $row)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="text-center">{{ $row->kode_ruangan }}</td>
                                <td class="text-center">{{ $row->nama_ruangan }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-ruangan" class="btn btn-xs btn-success"
                                            data-toggle="modal" data-target="#ubahRuanganModal"
                                            data-id="{{ $row->id }}"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-xs"></button>
                                            {!! Form::open(['url' => 'admin/ruangan/delete/'.$row->id, 'method' => 'POST']) !!}
                                        {{ Form::button('<i class="fa fa-times"></i>', ['class' => 'btn btn-xs btn-danger', 'onclick' => "deleteConfirmation('".$row->nama_ruangan."')"]) }}
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

<!-- Tambah Ruangan -->
<div class="modal fade" id="tambahRuanganModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Ruangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.ruangan.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="kode_ruangan">Kode Ruangan</label>
                            <input type="text" class="form-control" name="kode_ruangan" id="kode_ruangan" required />
                        </div>
                        <div class="form-group">
                            <label for="nama_ruangan">Nama Ruangan</label>
                            <input type="text" class="form-control" name="nama_ruangan" id="nama_ruangan" required />
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


     <!-- Ubah Ruangan -->
     <div class="modal fade" id="ubahRuanganModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Ruangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.ruangan.update') }}" enctype="multipart/form-data">
                    @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="edit-kode_ruangan">Kode Ruangan</label>
                            <input type="text" class="form-control" name="kode_ruangan" id="edit-kode_ruangan" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-nama_ruangan">Nama Ruangan</label>
                            <input type="text" class="form-control" name="nama_ruangan" id="edit-nama_ruangan" required />
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
            $(document).on('click', '#btn-edit-ruangan', function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "{{ url('/admin/ajaxadmin/dataRuangan') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-kode_ruangan').val(res.kode_ruangan);
                        $('#edit-nama_ruangan').val(res.nama_ruangan);
                        $('#edit-id').val(res.id);
                    },
                });
            });
        });

        </script>
    @stop