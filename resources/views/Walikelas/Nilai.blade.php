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
           
                <table id="table-data" class="table table-striped table-white">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>Nama Guru</th>
                            <th>Mata Pelajaran</th>
                            <th>Kelas</th>
                            <th>Lihat Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($nilai as $row)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td class="text-center">{{ $row->nama_lengkap }}</td>
                            <td class="text-center">{{ $row->nama_mapel }}</td>
                            <td class="text-center">{{ $row->nama_kelas }}</td>
                          
                            <td class="text-center">
                                <a href="riwayat_nilai/{{ $row->id }}/"><i class="fa fa-eye"></i></a></td>
                        </tr>
                                @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

    @stop