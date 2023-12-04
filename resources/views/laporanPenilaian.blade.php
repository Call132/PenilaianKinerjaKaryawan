<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="/library/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/components.css">


</head>
<style>
    *,
    body {
        font-family: 'Poppins', sans-serif;
        
    }

    div {
        margin-top: 5px;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 10px;
    }



    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        text-align: center;
    }
    p{
        text-align: justify ;
        font-size: 12px;
    }

    .label {
        display: inline-block;
        min-width: 180px;
        margin-top: 2px;
        /* Sesuaikan dengan lebar minimum yang Anda inginkan */
    }

    img {
        width: 30%;
        text-align: center;
        justify-content: center;
        margin-left: 250px;
    }
</style>


<body>
    <div class="main-content">

        <div class="card ">
            <div class="card-header">
                <img src="{{ public_path('img/yulia.png') }}" alt="yulia.png">
                <h2>Penilaian Kinerja</h2>
                <h3>Kepala Departemen dan Manajer Umum</h3>

            </div>
            @php
            if($penilaian->periode == 'janjun'){
            $penilaian->periode = 'Januari - Juni';
            }elseif($penilaian->periode == 'juldec'){
            $penilaian->periode = 'Juli - Desember';
            }
            @endphp
            <div class="card-body col-12">

                <div class="row">
                    <div class="col-md-6">
                        <p style="text-indent: 18px;"><span class="label">Nama Karyawan</span>: {{ $karyawan->name }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p style="text-indent: 18px;"><span class="label">Posisi</span>: {{ $karyawan->posisi }}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p style="text-indent: 18px;"><span class="label">Department</span>: {{ $karyawan->department }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p style="text-indent: 18px;"><span class="label">Mulai Bekerja </span>: {{
                            \Carbon\Carbon::parse($karyawan->joining_date)->isoFormat('DD MMMM YYYY') }}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p style="text-indent: 18px;"><span class="label">Tanggal Penilaian</span>: {{
                            Carbon\Carbon::parse($penilaian->tanggal_penilaian)->isoFormat('DD MMMM YYYY') }}
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p style="text-indent: 18px;"><span class="label">Periode </span>: {{ $penilaian->periode }}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <p style="text-indent: 18px;"><span class="label">Tahun </span>: {{ $penilaian->tahun }}
                        </p>
                    </div>
                </div>


                <hr>
                <div class="mt-3">
                    <ul class="list-inline" style="padding: 0; margin: 18px;">
                        <li class="list-inline-item" style="margin-right: 8px;">
                            <div
                                style="padding: 5px; border: 1px solid #ffffff; border-radius: 5px; background-color: #ffffff;">
                                Skor 5: Pelaku Luar Biasa
                            </div>
                        </li>
                        <li class="list-inline-item" style="margin-right: 8px;">
                            <div
                                style="padding: 5px; border: 1px solid #ffffff; border-radius: 5px; background-color: #ffffff;">
                                Skor 4: Melebihi Ekspektasi
                            </div>
                        </li>
                        <li class="list-inline-item" style="margin-right: 8px;">
                            <div
                                style="padding: 5px; border: 1px solid #ffffff; border-radius: 5px; background-color: #ffffff;">
                                Skor 3: Sesuai harapan
                            </div>
                        </li>
                        <li class="list-inline-item" style="margin-right: 8px;">
                            <div
                                style="padding: 5px; border: 1px solid #ffffff; border-radius: 5px; background-color: #ffffff;">
                                Skor 2: Perlu Perbaikan
                            </div>
                        </li>
                        <li class="list-inline-item">
                            <div
                                style="padding: 5px; border: 1px solid #ffffff; border-radius: 5px; background-color: #ffffff;">
                                Skor 1: Kinerja Tidak Memuaskan
                            </div>
                        </li>
                    </ul>
                </div>



                <table style="border-collapse: collapse; width: 100%; border: 1px solid black;">
                    <thead>
                        <tr>
                            <th style="border: 1px thin black height: 30px;;">Kriteria Penilaian</th>
                            <th style="border: 1px solid black height: 30px;;">Skor</th>
                            <th style="border: 1px solid black height: 30px;;">Komentar</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: justify">
                        @foreach ($kriteriaNames as $kriteriaName)
                        <tr>
                            <td style="border: 1px solid black; height: 30px; width: 20%;">{{ ucwords(str_replace('_', '
                                ',
                                $kriteriaName)) }}</td>
                            <td style="border: 1px solid black; height: 30px; text-align: center;">
                                {{ $skor[$kriteriaName] }}
                            </td>
                            <td style="border: 1px solid black; height: 30px; text-align: justify;">
                                <p style="margin-left: 5px; ">{{ $komentar[$kriteriaName] }}</p>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</body>

</html>