@extends('adminlte::page')
@section('title', 'Jadwal Pelajaran')
@section('content_header')
<h1>Jadwal Pelajaran</h1>
@stop
@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Jadwal Pelajaran') }}</div>
            <div class="card-body">
                    <hr />
                <table id="table-data" class="table table-striped table-white">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>Mata Pelajaran</th>
                            <th>Guru</th>
                            <th>Ruangan</th>
                            <th>Hari</th>
                            <th>Jam</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($jadwal as $row)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="text-center">{{$row->mapel->nama_mapel}}</td>
                                <td class="text-center">{{$row->guru->nama_lengkap}}</td>
                                <td class="text-center">{{$row->ruangan->nama_ruangan}}</td>
                                <td class="text-center">{{$row->hari}}</td>
                                <td class="text-center">{{$row->jam}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @stop