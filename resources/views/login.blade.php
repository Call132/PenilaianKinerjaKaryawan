@extends('layouts.auth')
@section('title', 'Login')
@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
<div class="card card-primary">
    <div class="card-header">
        <h4>Login</h4>
        <p>Sistem Penilaian Kinerja Karyawan</p>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
            @csrf
            <div class="form-group">
                <label for="name">Username</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid 
                    
                @enderror" name="name" tabindex="1" required autofocus value="{{ old('name') }}">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="invalid-feedback">
                    Please fill in your Username
                </div>
            </div>
            <div class="form-group">
                <div class="d-block">
                    <label for="password" class="control-label">Password</label>
                </div>
                <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="invalid-feedback">
                    please fill in your password
                </div>
            </div>



            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    Login
                </button>
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