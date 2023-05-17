@extends('adminlte::page')
<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@section('title', 'Data Nilai')
@section('content_header')
<h1>Data Nilai</h1>
@stop
@section('content')
        <div class="card card-default">
            <div class="card-header">{{ __('Laporan Nilai Siswa') }}</div>
            <div class="card-body">
           
                <table id="table-data" class="table table-striped table-white">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>NISN</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($walikelas as $row)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td class="text-center">{{ $row->NISN }}</td>
                            <td class="text-center">{{ $row->nama_lengkap }}</td>
                            <td class="text-center">{{ $row->nama_kelas }}</td>
                          
                            <td class="text-center">
                                <a href="print/{{ $row->NISN}}"><i></i>Laporkan</a></td>
                        </tr>
                                @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

    @stop