@extends('layouts.main')
@section('title', 'karyawan')
@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Daftar Karyawan</h1>
            </div>
            <div class="card">
                <div class="card-header">
                    <a href="" class="btn btn-primary m-auto">Tambah</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped-columns table-bordered table-md table">
                            <tr>
                                <th>#</th>
                                <th>Department</th>
                                <th>Nama</th>
                                <th>Tanggal Lahir</th>
                                <th>No HP</th>
                                <th>Joining Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Irwansyah Saputra</td>
                                <td>test</td>
                                <td>2017-01-09</td>
                                <td>test</td>
                                <td>test</td>
                                <td>
                                    <div class="badge badge-success">Active</div>
                                </td>
                                <td><a href="#" class="btn btn-secondary">Hapus</a></td>
                            </tr>
                            
                        </table>
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
