@extends('layouts.main')

@section('title', 'Hasil Penilaian Karyawan')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
<style>
    a {
        margin: 10px;
    }


    select {
        width: 50px;
        padding: 8px;
        margin: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    button[type="submit"] {
        background-color: #007BFF;
        color: #fff;
        padding: 8px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-right: 16px;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>
@endpush
@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Hasil Penilaian Karyawan</h1>
        </div>
    </section>
    <div class="card">
        <div class="card-body">
            <table class="table ">
                <thead class="text-align-left">
                    <tr>
                        <th>#</th>
                        <th>Nama Karyawan</th>
                        <th>Nilai Akhir</th>
                        <th>Rekomendasi</th>
                    </tr>
                </thead>
                <tbody>
                
                    
                    @foreach ($karyawan as $item)
                    
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->hasilPenilaian->last()->nilai_akhir ?? 'Belum Dinilai'}}</td>
                        <td>{{ $item->rekomendasi ?? 'Belum Dinilai' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    @if ($karyawan->currentPage() > 1)
                    <li class="page-item"><a class="page-link" href="{{ $karyawan->previousPageUrl() }}">Previous</a>
                    </li>
                    @endif

                    @for ($i = 1; $i <= $karyawan->lastPage(); $i++)
                        <li class="page-item {{ ($i == $karyawan->currentPage()) ? 'active' : '' }}">
                            <a class="page-link" href="{{ $karyawan->url($i) }}">{{ $i }}</a>
                        </li>
                        @endfor
                        @if ($karyawan->currentPage() < $karyawan->lastPage())
                            <li class="page-item"><a class="page-link" href="{{ $karyawan->nextPageUrl() }}">Next</a>
                            </li>
                            @endif
                </ul>
            </nav>
        </div>
    </div>

</div>


@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
<script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
<script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
<script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>




<!-- Page Specific JS File -->
<script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush