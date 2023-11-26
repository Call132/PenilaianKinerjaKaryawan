<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- General CSS Files -->

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

    @media print {
        body {
            margin-top: 10px;
            /* Atur margin top untuk halaman cetak */
        }

        table {
            margin-top: 0;
            /* Reset margin top untuk tabel agar tetap pada posisinya */
        }
        

    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        text-align: center;
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

        <div class="card">
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
            <p style="text-indent: 18px;"> <span class="label">Nama Karyawan </span>: {{ $karyawan->name }}</p>
            <p style="text-indent: 18px;"> <span class="label">Posisi </span>: {{ $karyawan->posisi }}</p>
            <p style="text-indent: 18px;"> <span class="label">Department </span>: {{ $karyawan->department }}</p>
            <p style="text-indent: 18px;"> <span class="label">Mulai Bekerja </span>: {{
                \Carbon\Carbon::parse($karyawan->joining_date)->isoFormat('DD MMMM YYYY') }}</p>
            <p style="text-indent: 18px;"><span class="label">Tanggal Penilaian</span>: {{
                Carbon\Carbon::parse($penilaian->tanggal_penilaian)->isoFormat('DD MMMM YYYY') }}</p>
            <p style="text-indent: 18px;"><span class="label">Periode</span>: {{ $penilaian->periode }}</p>
            <p style="text-indent: 18px;"><span class="label">Tahun</span>: {{ $penilaian->tahun }}</p>

            <hr>
            <div class="mt-3">
                <ul style="list-style: none; padding: 0; margin: 18px;">
                    <li
                        style="margin-bottom: 8px; padding: 5px; border: 1px solid #ffffff; border-radius: 5px; background-color: #ffffff;">
                        Skor 5: Pelaku Luar Biasa</li>
                    <li
                        style="margin-bottom: 8px; padding: 5px; border: 1px solid #ffffff; border-radius: 5px; background-color: #ffffff;">
                        Skor 4: Melebihi Ekspektasi</li>
                    <li
                        style="margin-bottom: 8px; padding: 5px; border: 1px solid #ffffff; border-radius: 5px; background-color: #ffffff;">
                        Skor 3: Sesuai harapan</li>
                    <li
                        style="margin-bottom: 8px; padding: 5px; border: 1px solid #ffffff; border-radius: 5px; background-color: #ffffff;">
                        Skor 2: Perlu Perbaikan</li>
                    <li
                        style="margin-bottom: 8px; padding: 5px; border: 1px solid #ffffff; border-radius: 5px; background-color: #ffffff;">
                        Skor 1: Kinerja Tidak Memuaskan</li>
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
                        <td style="border: 1px solid black; height: 30px; width: 20%;">{{ ucwords(str_replace('_', ' ',
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


</body>

</html>