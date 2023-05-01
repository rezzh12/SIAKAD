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
                                <td>NISN</td>
                                <td>: {{$row->NISN}}</td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>:{{$row->nama_lengkap}}</td>
                            </tr>
                            <tr>
                                <td>Kelas</td>
                                <td>:{{$row->nama_kelas}}</td>
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
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($nilai as $row)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="text-center">{{ $row->NISN }}</td>
                                <td class="text-center">{{ $row->nama_mapel }}</td>
                                <td class="text-center">{{ $row->nilai }}</td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
                    url: "{{ url('/admin/ajaxadmin/dataRiwayat') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-NISN').val(res.NISN);
                        $('#edit-Nilai').val(res.nilai);
                        $('#edit-id').val(res.id);
                    },
                });
            });
        });

  
        </script>
    @stop