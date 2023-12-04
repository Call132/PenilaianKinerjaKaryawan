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

        <div class="card-body col-12">
            <form method="post" action="{{ route('hasil.filter') }}" class="mb-4">
                @csrf
                <div class="form-group row form-inline">
                    <label for="periode">Pilih Periode:</label>
                    <div class="col-md-2">
                        <select class="form-control" id="periode" name="periode" required>
                            <option value="janjun" {{ $periode==='janjun' ? 'selected' : '' }}>Januari - Juni
                            </option>
                            <option value="juldec" {{ $periode==='juldec' ? 'selected' : '' }}>Juli - Desember
                            </option>
                        </select>
                    </div>
                    <label for="tahun">Tahun:</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="tahun" name="tahun"
                            value="{{ $tahun ?? now()->year }}" required>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>

            <table class="table ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Karyawan</th>
                        <th>Nilai Akhir</th>
                        <th>Rekomendasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($karyawan as $item)
                    @php
                    $lastPenilaian = $item->hasilPenilaian->last();
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td> @if ($item->sudahDinilai($periode, $tahun))
                            {{ $item->hasilPenilaian->last()->nilai_akhir }}
                            @else
                            Belum Dinilai
                            @endif</td>
                        <td>
                            @if ($item->sudahDinilai($periode, $tahun))
                            {{ $item->rekomendasi ?? 'Belum Dinilai' }}
                            @else
                            Belum Dinilai
                            @endif
                        </td>
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