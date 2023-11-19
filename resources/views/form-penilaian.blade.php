@extends('layouts.main')

@section('title', 'Form Penilaian')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Penilaian Kinerja</h1>
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

        <div class="card-header">
            <h3>PENILAIAN KINERJA</h3>
            <h5>Kepala Departemen dan Manajer Umum</h5>

        </div>
        <div class="card-body col-12">
            <form action="{{ route('penilaian.store') }}" method="POST">
                @csrf
                <div class="form-group row">
                    <input type="hidden" name="karyawan_id" value="{{ $karyawan->id }}">
                    <div class="col-md-6">
                        <label for="nama">Nama Karyawan :</label>
                        <input value="{{ $karyawan->name }}" type="text" class="form-control" id="nama" name="nama"
                            placeholder="Masukkan Nama Karyawan">
                    </div>
                    <div class="col-md-6">
                        <label for="masaJabatan">Masa Jabatan :</label>
                        <input type="text" class="form-control" id="masaJabatan" name="masaJabatan"
                            placeholder="Masukkan Masa Jabatan">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="posisi">Posisi :</label>
                        <input value="{{ $karyawan->posisi }}" type="text" class="form-control" id="posisi"
                            name="posisi" placeholder="Masukkan Posisi">
                    </div>
                    <div class="col-md-6">
                        <label for="department">Department :</label>
                        <select name="department" id="department" class="form-control">
                            <option value="{{ $karyawan->department }}">{{ $karyawan->department }}</option>
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
                    <div class="col-md-6">
                        <label for="mulaiBekerja">Mulai Bekerja (tgl/bln/thn) :</label>
                        <input value="{{ $karyawan->joining_date }}" type="date" class="form-control" id="mulaiBekerja"
                            name="mulaiBekerja">
                    </div>
                    <div class="col-md-6">
                        <label for="tglMulaiposisi">Tanggal Mulai di Jabatan/Posisi ini :</label>
                        <input type="date" class="form-control" id="tglMulaiposisi" name="tglMulaiposisi">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="tglPenilaian">Tanggal Penilaian :</label>
                        <input type="date" name="tanggal_penilaian" id="tglPenilaian" class="form-control"
                            placeholder="">
                    </div>
                    <div class="col-md-3">
                        <label for="periodePenilaian">Periode Awal Penilaian :</label>
                        <input type="month" class="form-control" id="periodePenilaian" name="periode_penilaian">
                    </div>
                </div>
                <hr>
                <div class="card-header">
                    <h6>Tujuan Penilaian (Centang kotak yang sesuai)</h6>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" value="masaPercobaan" name="tujuan" id="masaPercobaan">
                    <label class="form-check-label" for="masaPercobaan">
                        Masa Percobaan 1,2,3
                    </label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tujuan" id="promosi">
                    <label class="form-check-label" for="promosi">
                        Promosi
                    </label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tujuan" id="penilaianBerkala">
                    <label class="form-check-label" for="penilaianBerkala">
                        Penilaian Berkala
                    </label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tujuan" id="reviewEnamBulan">
                    <label class="form-check-label" for="reviewEnamBulan">
                        Review Enam Bulan
                    </label>
                </div>


                <div class="mt-3">
                    <ul>
                        <li>Skor 5: Pelaku Luar Biasa</li>
                        <li>Skor 4: Melebihi Ekspektasi</li>
                        <li>Skor 3: Sesuai harapan</li>
                        <li>Skor 2: Perlu Perbaikan</li>
                        <li>Skor 1: Kinerja Tidak Memuaskan</li>
                    </ul>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Kriteria Penilaian</th>
                            <th>Bobot</th>
                            <th>Komentar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Service Spirit</td>
                            <td><input type="text" class="form-control" name="nilai_service_spirit"> </td>
                            <td><input type="text" class="form-control" name="komentar_service_spirit"></td>
                        </tr>
                        <tr>
                            <td>Customer Focus/Quality of Work</td>
                            <td><input type="text" class="form-control" name="nilai_customer_focus"> </td>
                            <td><input type="text" class="form-control" name="komentar_customer_focus"></td>
                        </tr>
                        <tr>
                            <td>Sales Ability</td>
                            <td><input type="text" class="form-control" name="nilai_sales_ability"> </td>
                            <td><input type="text" class="form-control" name="komentar_sales_ability"></td>
                        </tr>
                        <tr>
                            <td>Initiative</td>
                            <td><input type="text" class="form-control" name="nilai_initiative"> </td>
                            <td><input type="text" class="form-control" name="komentar_initiative"></td>
                        </tr>
                        <tr>
                            <td>Adaptation</td>
                            <td><input type="text" class="form-control" name="nilai_adaptation"> </td>
                            <td><input type="text" class="form-control" name="komentar_adaptation"></td>
                        </tr>
                        <tr>
                            <td>Decision Making</td>
                            <td><input type="text" class="form-control" name="nilai_decision_making"> </td>
                            <td><input type="text" class="form-control" name="komentar_decision_making"></td>
                        </tr>
                        <tr>
                            <td>Change Management</td>
                            <td><input type="text" class="form-control" name="nilai_change_management"> </td>
                            <td><input type="text" class="form-control" name="komentar_change_management"></td>
                        </tr>
                        <tr>
                            <td>Communication</td>
                            <td><input type="text" class="form-control" name="nilai_communication"> </td>
                            <td><input type="text" class="form-control" name="komentar_communication"></td>
                        </tr>
                        <tr>
                            <td>Team Coordination/Commitment</td>
                            <td><input type="text" class="form-control" name="nilai_team_coordination"> </td>
                            <td><input type="text" class="form-control" name="komentar_team_coordination"></td>
                        </tr>
                        <tr>
                            <td>Leadership/Team Spirit</td>
                            <td><input type="text" class="form-control" name="nilai_leadership"> </td>
                            <td><input type="text" class="form-control" name="komentar_leadership"></td>
                        </tr>
                        <tr>
                            <td>People Development</td>
                            <td><input type="text" class="form-control" name="nilai_people_development"> </td>
                            <td><input type="text" class="form-control" name="komentar_people_development"></td>
                        </tr>
                        <tr>
                            <td>Commercial Awareness</td>
                            <td><input type="text" class="form-control" name="nilai_commercial_awareness"> </td>
                            <td><input type="text" class="form-control" name="komentar_commercial_awareness"></td>
                        </tr>
                        <tr>
                            <td>Problem Solving</td>
                            <td><input type="text" class="form-control" name="nilai_problem_solving"> </td>
                            <td><input type="text" class="form-control" name="komentar_problem_solving"></td>
                        </tr>
                        <tr>
                            <td>Integrity</td>
                            <td><input type="text" class="form-control" name="nilai_integrity"> </td>
                            <td><input type="text" class="form-control" name="komentar_integrity"></td>
                        </tr>
                        <tr>
                            <td>Corporate Sense</td>
                            <td><input type="text" class="form-control" name="nilai_corporate_sense"> </td>
                            <td><input type="text" class="form-control" name="komentar_corporate_sense"></td>
                        </tr>
                        <tr>
                            <td>Capacity of Analyze Perspective</td>
                            <td><input type="text" class="form-control" name="nilai_analyze_perspective"> </td>
                            <td><input type="text" class="form-control" name="komentar_analyze_perspective"></td>
                        </tr>
                        <tr>
                            <td>Time and Task Management</td>
                            <td> <input type="text" class="form-control" name="nilai_time_management"></td>
                            <td><input type="text" class="form-control" name="komentar_time_management"></td>
                        </tr>
                    </tbody>
                </table>





                <button type="submit" class="btn btn-primary">Submit</button>
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