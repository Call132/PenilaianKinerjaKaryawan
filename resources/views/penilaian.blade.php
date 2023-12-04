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
        <div class="card-body col-12">
            @if (!isset($karyawan))
            <!-- Tampilan formulir filter saat halaman diakses pertama kali -->
            <form method="post" action="{{ route('penilaian.filter') }}">
                @csrf
                <div class="form-group row">
                    <div class="form-group col-md-3">
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
                    </div>
                    <div class="form-group col-md-3">
                        <label for="tahun">Tahun:</label>
                        <input type="text" class="form-control" id="tahun" value="{{ old('tahun', now()->year)  }}"
                            name="tahun" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="periode">Periode:</label>
                        <select class="form-control" id="periode" name="periode" required>
                            <option value="janjun" {{ old('periode')=='janjun' ? 'selected' : '' }}>Januari - Juni
                            </option>
                            <option value="juldec" {{ old('periode')=='juldec' ? 'selected' : '' }}>Juli - Desember
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Filter</button>
                    </div>
                </div>
            </form>
            @else
            <form method="post" action="{{ route('penilaian.filter') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="department">Pilih Department:</label>
                        <select name="department" id="department" class="form-control">
                            <option value="semua" {{ $department == 'semua' ? 'selected' : '' }}> -- Silahkan Pilih department --</option>
                            <option value="Front office" {{ old('department')=='Front office' ? 'selected' : '' }}>Front
                                office</option>
                            <option value="Housekeeping" {{ old('department')=='Housekeeping' ? 'selected' : '' }}>
                                Housekeeping</option>
                            <option value="Engineering" {{ old('department')=='Engineering' ? 'selected' : '' }}>
                                Engineering</option>
                            <option value="Accounting" {{ old('department')=='Accounting' ? 'selected' : '' }}>
                                Accounting</option>
                            <option value="Sales" {{ old('department')=='Sales' ? 'selected' : '' }}>Sales</option>
                            <option value="FBS" {{ old('department')=='FBS' ? 'selected' : '' }}>FBS</option>
                            <option value="FBP" {{ old('department')=='FBP' ? 'selected' : '' }}>FBP</option>
                            <option value="HC & Security" {{ old('department')=='HC & Security' ? 'selected' : '' }}>HC
                                & Security</option>
                        </select>
                    </div>

                   
                    <div class="form-group col-md-3">
                        <label for="periode">Periode:</label>
                        <select class="form-control" id="periode" name="periode" required>
                            <option value="janjun" {{ $periode == 'janjun' ? 'selected' : '' }}>Januari - Juni</option>
                            <option value="juldec" {{ $periode == 'juldec' ? 'selected' : '' }}>Juli - Desember</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="tahun">Tahun:</label>
                        <input type="text" class="form-control" id="tahun" value="{{ $tahun }}" name="tahun" required>
                    </div>
                    <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Filter</button>
                    </div>
                </div>
            </form>
            <h2 class="text-center">Daftar Karyawan</h2>
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
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->name }}</td>
                                <td>
                                    @if ($data->sudahDinilai($periode, $tahun))
                                    <span class="badge badge-success">Sudah Dinilai</span>
                                    @else
                                    <span class="badge badge-danger">Belum Dinilai</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('penilaian.form', $data->id) }}" class="btn btn-primary">
                                        <i class="fa-solid fa-file"></i> Buat
                                    </a>

                                    @if ($data->penilaian->isNotEmpty())
                                    <a href="{{ route('penilaian.edit', $data->id) }}" class="btn btn-warning">
                                        <i class="fa-solid fa-edit"></i> Edit
                                    </a>
                                    <a href="{{ route('penilaian.cetak', $data->id) }}" class="btn btn-info">
                                        <i class="fa-solid fa-file"></i> Cetak
                                    </a>
                                    @else
                                    <!-- Tidak memberikan akses jika belum dinilai -->
                                    <span class="btn btn-secondary disabled">
                                        <i class="fa-solid fa-file"></i> Cetak
                                    </span>
                                    @endif
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            @if ($karyawan->currentPage() > 1)
                            <li class="page-item"><a class="page-link"
                                    href="{{ $karyawan->previousPageUrl() }}">Previous</a></li>
                            @endif

                            @for ($i = 1; $i <= $karyawan->lastPage(); $i++)
                                <li class="page-item {{ ($i == $karyawan->currentPage()) ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $karyawan->url($i) }}">{{ $i }}</a>
                                </li>
                                @endfor
                                @if ($karyawan->currentPage() < $karyawan->lastPage())
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $karyawan->nextPageUrl() }}">Next</a></li>
                                    @endif
                        </ul>
                    </nav>


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