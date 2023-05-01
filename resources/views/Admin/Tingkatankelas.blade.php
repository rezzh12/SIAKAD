@extends('adminlte::page')
@section('title', 'Data Tingkatan')
@section('content_header')
<h1>Data Tingkatan</h1>
@stop
@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Data Tingkatan Kelas') }}</div>
            <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahTingkatanModal"><i class="fa fa-plus"></i>
                    Tambah Data</button>
                    <hr />
                <table id="table-data" class="table table-striped table-white">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>Kode Tingkat Kelas</th>
                            <th>Nama Tingkatan Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($tingkatan as $row)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="text-center">{{ $row->kode_tingkatan }}</td>
                                <td class="text-center">{{ $row->nama_tingkatan }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-tingkatan" class="btn btn-xs btn-success"
                                            data-toggle="modal" data-target="#ubahTingkatanModal"
                                            data-id="{{ $row->id }}"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-xs"></button>
                                            {!! Form::open(['url' => 'admin/tingkatan/delete/'.$row->id, 'method' => 'POST']) !!}
                                        {{ Form::button('<i class="fa fa-times"></i>', ['class' => 'btn btn-xs btn-danger', 'onclick' => "deleteConfirmation('".$row->nama_tingkatan."')"]) }}
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
<div class="modal fade" id="tambahTingkatanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Tingkatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.tingkatan.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="kode_tingkatan">Kode tingkatan</label>
                            <input type="text" class="form-control" name="kode_tingkatan" id="kode_tingkatan" required />
                        </div>
                        <div class="form-group">
                            <label for="nama_tingkatan">Nama tingkatan</label>
                            <input type="text" class="form-control" name="nama_tingkatan" id="nama_tingkatan" required />
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
     <div class="modal fade" id="ubahTingkatanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Jurusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.tingkatan.update') }}" enctype="multipart/form-data">
                    @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="edit-kode_tingkatan">Kode Tingkatan</label>
                            <input type="text" class="form-control" name="kode_tingkatan" id="edit-kode_tingkatan" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-nama_tingkatan">Nama Tingkatan</label>
                            <input type="text" class="form-control" name="nama_tingkatan" id="edit-nama_tingkatan" required />
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
            $(document).on('click', '#btn-edit-tingkatan', function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "{{ url('/admin/ajaxadmin/dataTingkatan') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-kode_tingkatan').val(res.kode_tingkatan);
                        $('#edit-nama_tingkatan').val(res.nama_tingkatan);
                        $('#edit-id').val(res.id);
                    },
                });
            });
        });

        
        </script>
    @stop