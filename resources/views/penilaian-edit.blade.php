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
            <form action="{{ route('penilaian.update', $karyawan->id) }} " method="POST">
                @method('PUT')
                @csrf
                <div class="form-group row">
                    <input type="hidden" name="karyawan_id" value="{{ $karyawan->id }}">
                    <div class="col-md-6">
                        <label for="nama">Nama Karyawan :</label>
                        <input value="{{ $karyawan->name }}" type="text" class="form-control" id="nama" name="nama"
                            placeholder="Masukkan Nama Karyawan" disabled>
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
                            name="posisi" placeholder="Masukkan Posisi Karyawan" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="department">Department :</label>
                        <select name="department" id="department" class="form-control" disabled>
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
                            name="mulaiBekerja" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="tglMulaiposisi">Tanggal Mulai di Jabatan/Posisi ini : </label>
                        <input type="date" class="form-control" id="tglMulaiposisi" name="tglMulaiposisi">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="tglPenilaian">Tanggal Penilaian :</label>
                        <input type="date" value="{{ $penilaian->tanggal_penilaian }}" name="tanggal_penilaian"
                            id="tglPenilaian" class="form-control" placeholder="" disabled>
                    </div>


                    <div class="col-md-3">

                        <label for="tahun">Tahun:</label>
                        <input type="number" value="{{ $penilaian->tahun }}" class="form-control" id="tahun"
                            name="tahun" disabled>
                    </div>

                    <div class="col-md-3">
                        <label for="periode">Periode:</label>
                        <select class="form-control" id="periode" name="periode" disabled>
                            @php
                            if($penilaian->periode == 'janjun'){
                            $penilaian->periode = 'Januari - Juni';
                            }elseif($penilaian->periode == 'juldec'){
                            $penilaian->periode = 'Juli - Desember';
                            }
                            @endphp
                            <option value="{{ $penilaian->periode }}">{{ $penilaian->periode }}</option>
                            <option value="janjun">Januari - Juni</option>
                            <option value="juldec">Juli - Desember</option>
                        </select>
                    </div>

                </div>
                <hr>
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
                            <th>Skor</th>
                            <th>Komentar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kriteriaNames as $kriteriaName)
                        <tr>
                            <td>{{ ucwords(str_replace('_', ' ', $kriteriaName)) }}</td>
                            <td>
                                <select name="nilai_{{ $kriteriaName }}" class="form-control" id="">
                                    <option value="{{ $skor[$kriteriaName] }}">{{ $skor[$kriteriaName] }}</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="komentar_{{ $kriteriaName }}"
                                    value="{{ $komentar[$kriteriaName]  }}">
                            </td>
                        </tr>
                        @endforeach
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