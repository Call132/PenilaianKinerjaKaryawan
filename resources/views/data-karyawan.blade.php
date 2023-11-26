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
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @elseif (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    </section>
    <div class="card">
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
                                <a href="{{ route('karyawan.delete', $data->id) }}" class="btn btn-danger"
                                    data-toggle="modal" data-target="#confirmDeleteModal"><i
                                        class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <div class="flex">
                            <a href="{{ route('karyawan.create') }}" class="btn btn-primary"><i
                                    class="fa-solid fa-plus-circle"></i> Tambah</a>
                        </div>
                    </tfoot>
                </table>
                <div class="card-body">
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
            </div>
        </div>
    </div>
</div>
<!-- Modal Konfirmasi Penghapusan -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Penghapusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus item ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form action="{{ route('karyawan.delete', $data->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
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