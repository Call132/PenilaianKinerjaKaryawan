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
            <h1>Penilaian</h1>
        </div>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
            @endif
    </section>
    <div class="card">
        <div class="card-body">
            @if (!isset($karyawan))
            <!-- Tampilan formulir filter saat halaman diakses pertama kali -->
            <form method="post" action="{{ route('penilaian.filter') }}">
                @csrf
                <div class="form-group">
                    <label for="department">Pilih Department:</label>
                    <select name="department" id="department" class="form-control">
                        <option value="semua"> -- Silahkan Pilih department --</option>
                        <option value="Front office">Front office</option>
                        <option value="Housekeeping">Housekeeping</option>
                        <option value="Engineering">Engineering</option>
                        <option value="Accounting">Accounting</option>
                        <option value="Sales">Sales</option>
                        <option value="FBS">FBS</option>
                        <option value="FBP">FBP</option>
                        <option value="HC & Security">HC & Security</option>
                    </select>
                    <div style="margin-top: 10px;">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
            @else
            <!-- Tampilan daftar karyawan departemen setelah filter -->
            <form method="post" action="{{ route('penilaian.filter') }}">
                @csrf
                <div class="form-group">
                    <label for="department">Pilih Department:</label>
                    <select name="department" id="department" class="form-control">
                        <option value="semua"> -- Silahkan Pilih department --</option>
                        <option value="Front Office">Front office</option>
                        <option value="Housekeeping">Housekeeping</option>
                        <option value="Engineering">Engineering</option>
                        <option value="Accounting">Accounting</option>
                        <option value="Sales">Sales</option>
                        <option value="FBS">FBS</option>
                        <option value="FBP">FBP</option>
                        <option value="HC & Security">HC & Security</option>
                    </select>
                    <div style="margin-top: 10px;">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
            <h2 class="text-center">Daftar Karyawan Departemen {{ $department }}</h2>
            <form action="" method="">
                <div class="table-responsive">
                    <table class="table table-striped-columns table-md">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Status Penilaian</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($karyawan as $data)

                            @php
                            $status = $data->penilaian_status;
                            if ($status == false) {
                            $status = 'Belum Dinilai';
                            }else {
                            $status = 'Sudah Dinilai';
                            }
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->name }}</td>
                                <td>
                                    @if ($status == 'Belum Dinilai')
                                    <span class="badge badge-danger">{{ $status }}</span>
                                    @else
                                    <span class="badge badge-success">{{ $status }}</span>
                                    @endif
                                </td>
                                <td><a href="{{ route('penilaian.form', $data->id) }}" class="btn btn-primary"><i
                                            class="fa-solid fa-file"></i> Buat</a></td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                  
                </div>
            </form>
            @endif
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