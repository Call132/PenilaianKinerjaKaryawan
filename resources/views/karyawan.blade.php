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
                <h1>Karyawan</h1>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4> Form</h4>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Department</label>
                        <div class="col-sm-9">

                            <select class="form-control">
                                <option>Front office</option>
                                <option>Housekeeping</option>
                                <option>Engineering</option>
                                <option>Accounting</option>
                                <option>Sales</option>
                                <option>FBS</option>
                                <option>FBP</option>
                                <option>HC & Security</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">No HP</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Joining Date</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
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
