@extends('adminlte::page')
@section('title', 'Data Nilai')
@section('content_header')
<h1>Data Nilai</h1>
@stop
@section('content')
    <div class="container-fluid">
    <div>
                    <table id="table-data" class="table table-white">
                    @foreach ($akademik as $row)
                        <tbody>
                            <tr>
                                <td>Tahun Akademik</td>
                                <td>:{{ $row->tahun_akademik }} </td>
                            </tr>
                            <tr>
                                <td>Semester</td>
                                <td>:{{ $row->semester }}</td>
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
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahNilaiModal"><i class="fa fa-plus"></i>
                    Tambah Data</button>
                    <hr />
                <table id="table-data" class="table table-striped table-white">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>Nama Guru</th>
                            <th>Mata Pelajaran</th>
                            <th>Kelas</th>
                            <th>Aksi</th>
                            <th>Lihat Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($nilai as $row)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td class="text-center">{{ $row->guru->nama_lengkap }}</td>
                            <td class="text-center">{{ $row->mapel->nama_mapel }}</td>
                            <td class="text-center">{{ $row->kelas->nama_kelas }}</td>
                            <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-nilai" class="btn btn-xs btn-success"
                                            data-toggle="modal" data-target="#ubahNilaiModal"
                                            data-id="{{ $row->id }}"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-xs"></button>
                                            {!! Form::open(['url' => 'admin/nilai_siswa/delete/'.$row->id, 'method' => 'POST']) !!}
                                        {{ Form::button('<i class="fa fa-times"></i>', ['class' => 'btn btn-xs btn-danger', 'onclick' => "deleteConfirmation('".$row->mapel->nama_mapel."')"]) }}
                                    {!! Form::close() !!}
                                    </div>
                                </td>
                            <td class="text-center">
                                <a href="riwayat_nilai/{{ $row->id }}"><i class="fa fa-eye"></i></a></td>
                        </tr>
                                @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

    <!-- Tambah Mapel -->
<div class="modal fade" id="tambahNilaiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Nilai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.nilai.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                        <label for="akademik">Tahun Akademik</label>
                            <select name="akademik" id="akademik" class="form-control">
                                <option value="">Pilih Tahun Akademik</option>
                                @foreach($akademik as $ak)
                            <option value="{{$ak->id}}">{{$ak->tahun_akademik}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="guru">Guru</label>
                            <select name="guru" id="guru" class="form-control">
                                <option value="">Pilih Guru</option>
                                @foreach($guru as $gr)
                            <option value="{{$gr->NUPTK}}">{{$gr->nama_lengkap}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="mapel">Mata Pelajaran</label>
                            <select name="mapel" id="mapel" class="form-control">
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach($mapel as $ml)
                            <option value="{{$ml->id}}">{{$ml->nama_mapel}}</option>
                            @endforeach
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
                        
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


     <!-- Ubah Tingkatan -->
     <div class="modal fade" id="ubahNilaiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Nilai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.nilai.update') }}" enctype="multipart/form-data">
                    @csrf
                        @method('PATCH')
                       <div class="form-group">
                        <label for="edit-akademik">Tahun Akademik</label>
                            <select name="akademik" id="edit-akademik" class="form-control">
                                <option value="">Pilih Tahun Akademik</option>
                                @foreach($akademik as $ak)
                            <option value="{{$ak->id}}">{{$ak->tahun_akademik}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="edit-guru">Guru</label>
                            <select name="guru" id="edit-guru" class="form-control">
                                <option value="">Pilih Guru</option>
                                @foreach($guru as $gr)
                            <option value="{{$gr->NUPTK}}">{{$gr->nama_lengkap}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="edit-mapel">Mata Pelajaran</label>
                            <select name="mapel" id="edit-mapel" class="form-control">
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach($mapel as $ml)
                            <option value="{{$ml->id}}">{{$ml->nama_mapel}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="edit-kelas">Kelas</label>
                            <select name="kelas" id="edit-kelas" class="form-control">
                                <option value="">Pilih Kelas</option>
                                @foreach($kelas as $ks)
                            <option value="{{$ks->id}}">{{$ks->nama_kelas}}</option>
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
            $(document).on('click', '#btn-edit-nilai', function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "{{ url('/admin/ajaxadmin/dataNilai') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-akademik').val(res.tahun__akademik_id);
                        $('#edit-guru').val(res.NUPTK);
                        $('#edit-mapel').val(res.mapel_id);
                        $('#edit-kelas').val(res.kelas_id);
                        $('#edit-id').val(res.id);
                    },
                });
            });
        });

  
        </script>
    @stop