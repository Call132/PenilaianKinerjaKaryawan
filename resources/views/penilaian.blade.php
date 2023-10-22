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
    </section>
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('penilaian.filter') }}">
                @csrf

                <div class="form-group">
                    <label for="department">Pilih Department:</label>
                    <select name="department" id="department" class="form-control">
                        <option> -- Silahkan Pilih department --</option>
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
            @dump($department)
            @if ($department)
            <h2>Daftar Karyawan Departemen {{ $department }}</h2>
            <table class="table table-striped-columns table-md">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->name }}</td>
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