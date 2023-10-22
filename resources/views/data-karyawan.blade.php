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
    </section>
    <div class="card">
        <div class="card-header">
            <a href="{{ route('karyawan.create') }}" class="btn btn-primary m-auto">Tambah</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped-columns table-md">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Department</th>
                            <th>Nama</th>
                            <th>Posisi</th>
                            <th>Tanggal Lahir</th>
                            <th>No HP</th>
                            <th>Joining Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($karyawan as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->department }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->posisi }}</td>
                            <td>{{ $data->tanggal_lahir }}</td>
                            <td>{{ $data->no_hp }}</td>
                            <td>{{ $data->joining_date }}</td>
                            <td>
                                <div class="badge badge-secondary">{{ $data->status }}</div>
                            </td>
                            <td>
                                <a href="{{ route('karyawan.edit', $data->id) }}" class="btn btn-warning"><i
                                        class="fa-solid fa-edit"></i></a>
                                <a href="{{ route('karyawan.delete', $data->id) }}" class="btn btn-danger"><i
                                        class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


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
@endsection