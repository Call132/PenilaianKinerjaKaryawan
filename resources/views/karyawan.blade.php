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
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4> Form</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('karyawan.store') }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="department" class="col-sm-3 col-form-label">Department</label>
                        <div class="col-sm-9">
                            <select name="department" id="department" class="form-control">
                                <option value="Front office">Front office</option>
                                <option value="Housekeeping">Housekeeping</option>
                                <option value="Engineering">Engineering</option>
                                <option value="Accounting">Accounting</option>
                                <option value="Sales">Sales</option>
                                <option value="FBS">FBS</option>
                                <option value="FBP">FBP</option>
                                <option value="HC & Security">HC & Security</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input id="name" name="name" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="posisi" class="col-sm-3 col-form-label">Posisi</label>
                        <div class="col-sm-9">
                            <input id="posisi" name="posisi" type="text" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tanggal_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-9">
                            <input id="tanggal_lahir" name="tanggal_lahir" type="date" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_hp" class="col-sm-3 col-form-label">No HP</label>
                        <div class="col-sm-9">
                            <input id="no_hp" name='no_hp' type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="joining_date" class="col-sm-3 col-form-label">Joining Date</label>
                        <div class="col-sm-9">
                            <input id="joining_date" name="joining_date" type="date" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <select id="status" name="status" class="form-control">
                                <option value="Casual">Casual</option>
                                <option value="Daily Worker">Daily Worker</option>
                                <option value="Karyawan Kontrak">Karyawan Kontrak</option>
                            </select>
                        </div>
                    </div>



                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
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