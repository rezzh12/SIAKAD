<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>

<body>
    <h3 class="text-center">Nama Sekolah</h3>
    <h1 class="text-center">SMK 2 PASUNDAN</h1>
    <p class="text-center">Jl Pesantren Km 2, Sibreh, Aceh Besar, Telpon : 0651-23462</p>
    <br />

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
    <table id="table_data" class="table table-bordered">
        <thead>
            <tr class="text-center">
            <th>NO</th>
                            <th>Nama Mata pelajaran</th>
                            <th>KKM</th>
                            
                            <th>Nilai</th>
                            <th>Ketercapaian</th>
                            <th>Deskripsi</th>
            </tr>
        </thead>

        <tbody>
                    @php $no=1; @endphp
                        @foreach ($nilai as $row)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="text-center">{{ $row->nama_mapel }}</td>
                                <td class="text-center">75</td>
                                <td class="text-center">{{ $row->nilai }}</td>
                                <td class="text-center">{{ $row->ketercapaian }}</td>
                                <td class="text-center">{{ $row->Deskripsi }}</td>
                                
                            </tr>
                        @endforeach
                    </tbody>

    </table>

</body>

</html>