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
                <form action="{{ route('karyawan.update', $data->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <label for="department" class="col-sm-3 col-form-label">Department</label>
                        <div class="col-sm-9">
                            <select id="department" name="department" class="form-control">
                                <option value="Front office" {{ $data->department == 'Front office' ? 'selected' : ''
                                    }}>Front office</option>
                                <option value="Housekeeping" {{ $data->department == 'Housekeeping' ? 'selected' : ''
                                    }}>Housekeeping</option>
                                <option value="Engineering" {{ $data->department == 'Engineering' ? 'selected' : ''
                                    }}>Engineering</option>
                                <option value="Accounting" {{ $data->department == 'Accounting' ? 'selected' : ''
                                    }}>Accounting</option>
                                <option value="Sales" {{ $data->department == 'Sales' ? 'selected' : '' }}>Sales
                                </option>
                                <option value="FBS" {{ $data->department == 'FBS' ? 'selected' : '' }}>FBS</option>
                                <option value="FBP" {{ $data->department == 'FBP' ? 'selected' : '' }}>FBP</option>
                                <option value="HC & Security" {{ $data->department == 'HC & Security' ? 'selected' : ''
                                    }}>HC & Security</option>
                            </select>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input value="{{ $data->name }}" id="name" name="name" type="text" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="posisi" class="col-sm-3 col-form-label">Posisi</label>
                        <div class="col-sm-9">
                            <input value="{{ $data->posisi }}" id="posisi" name="posisi" type="text"
                                class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-9">
                            <input value="{{ $data->tanggal_lahir }}" id="tanggal_lahir" name="tanggal_lahir"
                                type="date" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_hp" class="col-sm-3 col-form-label">No HP</label>
                        <div class="col-sm-9">
                            <input value="{{ $data->no_hp }}" id="no_hp" name='no_hp' type="text" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="joining_date" class="col-sm-3 col-form-label">Joining Date</label>
                        <div class="col-sm-9">
                            <input value="{{ $data->joining_date }}" id="joining_date" name="joining_date" type="date"
                                class="form-control" required>
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