@extends('layouts.main')

@section('title', 'Dashboard')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush
@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
    </section>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Department</h4>
                    </div>
                    <div class="card-body">
                        {{ $totalDepartments }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Karyawan</h4>
                    </div>
                    <div class="card-body">
                        {{ $karyawan->count() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-check-circle fa-3x"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Karyawan Dipertahankan</h4>
                    </div>
                    <div class="card-body">
                        {{ $dipertahankan }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-times-circle fa-3x"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Karyawan Tidak Dipertahankan</h4>
                    </div>
                    <div class="card-body">
                        {{ $tidakDipertahankan }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body col-12">
            
           {{--  <form method="post" action="{{ route('home.filter') }}" class="mb-4">
                @csrf
                <div class="form-row">
                    <div class="form-group ">
                        <label for="periode">Pilih Periode:</label>
                        <select class="form-control" id="periode" name="periode" required>
                            <option value="janjun" {{ (now()->month >= 1 && now()->month <= 6) ? 'selected' : '' }}>Januari - Juni</option>
                            <option value="juldec" {{ (now()->month > 6) ? 'selected' : '' }} >Juli - Desember</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="tahun">Pilih Tahun:</label>
                        <input type="text" class="form-control" id="tahun" name="tahun"
                            value="{{ old('tahun', now()->year) }}" required>
                    </div>
                    <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Filter</button>
                    </div>
                </div>
            </form>

            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Karyawan</th>
                        <th>Nilai Akhir</th>
                        <th>Peringkat</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($karyawan as $data)
                    @php
                    $lastPenilaian = $data->hasilPenilaian->where('periode', $periode)->where('tahun', $tahun)->last();
                    $threshold = 0.4;

                    @endphp
                    
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->name }}</td>
                        <td>
                            @if ($data->sudahDinilai($periode, $tahun) && $lastPenilaian)
                            {{ floatval($lastPenilaian->nilai_akhir) }}
                            @else
                            Belum Dinilai
                            @endif
                        </td>
                        <td>
                            {{ $data->peringkat ?? 'Penilaian Belum Dilakukan' }}
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
            </nav> --}}
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