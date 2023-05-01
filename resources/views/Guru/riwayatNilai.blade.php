@extends('adminlte::page')
@section('title', 'Data Nilai')
@section('content_header')
<h1>Data Nilai</h1>
@stop
@section('content')
    <div class="container-fluid">
    <div>
                    <table id="table-data" class="table table-white">
                    @foreach ($riwayat as $row)
                        <tbody>
                            <tr>
                                <td>Nama Guru</td>
                                <td>:{{ $row->nama_lengkap }} </td>
                            </tr>
                            <tr>
                                <td>Nama Mata Pelajaran</td>
                                <td>:{{ $row->nama_mapel }}</td>
                            </tr>
                            <tr>
                                <td>Nama Kelas</td>
                                <td>:{{ $row->nama_kelas }}</td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    </div>
                    <hr />

                    <div>
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Nilai Siswa') }}</div>
            <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahRiwayatModal"><i class="fa fa-plus"></i>
                    Tambah Data</button>
                    <hr />
                <table id="table-data" class="table table-striped table-white">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Nilai</th>
                            <th>Ketercapaian</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($nilai as $row)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="text-center">{{ $row->NISN }}</td>
                                <td class="text-center">{{ $row->nama_lengkap }}</td>
                                <td class="text-center">{{ $row->nilai }}</td>
                                <td class="text-center">{{ $row->ketercapaian }}</td>
                                <td class="text-center">{{ $row->Deskripsi }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-riwayat" class="btn btn-xs btn-success"
                                            data-toggle="modal" data-target="#ubahRiwayatModal"
                                            data-id="{{ $row->idr }}"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-xs"></button>
                                            {!! Form::open(['url' => 'guru/riwayat_nilai/delete/'.$row->idr, 'method' => 'POST']) !!}
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
    </div>
<!-- Tambah Mapel -->
<div class="modal fade" id="tambahRiwayatModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Riwayat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('guru.riwayat.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="NISN">NISN</label>
                            <input type="text" class="form-control" name="NISN" id="NISN" required />
                        </div>
                        <div class="form-group">
                            <label for="Nilai">Nilai</label>
                            <input type="text" class="form-control" name="Nilai" id="Nilai" required />
                        </div>
                        <div class="form-group">
                        <label for="Ketercapaian">Ketercapaian</label>
                            <select name="Ketercapaian" id="Ketercapaian" class="form-control">
                            <option value="">Pilih Ketercapaian</option>
                                <option value="Sangat Baik">Sangat Baik</option>
                                <option value="Baik">Baik</option>
                                <option value="Cukup">Cukup</option>
                                <option value="Kurang">Kurang</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Deskripsi">Deskripsi</label>
                            <input type="text" class="form-control" name="Deskripsi" id="Deskripsi" required />
                        </div>
                        </div>
                        
                <div class="modal-footer">
                @foreach ($nilai as $row)
                <input type="hidden" name="nilai_id" id="nilai_id" value="{{$row->id}}" />
                @endforeach
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


     <!-- Ubah Tingkatan -->
     <div class="modal fade" id="ubahRiwayatModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Riwayat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('guru.riwayat.update') }}" enctype="multipart/form-data">
                    @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="edit-NISN">NISN</label>
                            <input type="text" class="form-control" name="NISN" id="edit-NISN" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-Nilai">Nilai</label>
                            <input type="text" class="form-control" name="Nilai" id="edit-Nilai" required />
                        </div>
                        <div class="form-group">
                        <label for="edit-Ketercapaian">Ketercapaian</label>
                            <select name="Ketercapaian" id="edit-Ketercapaian" class="form-control">
                                <option value="">Pilih Ketercapaian</option>
                                <option value="Sangat Baik">Sangat Baik</option>
                                <option value="Baik">Baik</option>
                                <option value="Cukup">Cukup</option>
                                <option value="Kurang">Kurang</option>
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-Deskripsi">Deskripsi</label>
                            <input type="text" class="form-control" name="Deskripsi" id="edit-Deskripsi" required />
                        </div>
                        </div>
                        

                <div class="modal-footer">
                @foreach ($nilai as $row)
                <input type="hidden" name="nilai_id" id="nilai_id" value="{{$row->id}}" />
                @endforeach
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
            $(document).on('click', '#btn-edit-riwayat', function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "{{ url('/guru/ajaxadmin/dataRiwayat') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-NISN').val(res.NISN);
                        $('#edit-Nilai').val(res.nilai);
                        $('#edit-Ketercapaian').val(res.ketercapaian);
                        $('#edit-Deskripsi').val(res.Deskripsi);
                        $('#edit-id').val(res.id);
                    },
                });
            });
        });

  
        </script>
    @stop