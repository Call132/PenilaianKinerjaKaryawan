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
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Kriteria</th>
                        <th>Bobot</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody style="text-align: center">
                    @foreach ($kriteria as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ ucwords(str_replace('_', ' ', $item->kriteria)) }}</td>
                        <td>{{ $item->bobot }}</td>
                        <td><a href="{{ route('kriteria.update', $item->id) }}" class="btn btn-warning"
                                data-toggle="modal" data-target="#editKriteriaModal" data-id="{{ $item->id }}"
                                data-nama="{{ $item->kriteria }}" data-bobot="{{ $item->bobot }}">
                                <i class="fa-solid fa-pen-square"></i>
                            </a>
                            <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal"
                                data-id="{{ $item->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#addKriteriaModal"><i
                            class="fa-solid fa-plus"></i> Tambah</a>
                </tfoot>
            </table>
        </div>
    </div>
</div>
{{-- modal tambah kriteria --}}
<div class="modal fade" id="addKriteriaModal" tabindex="-1" role="dialog" aria-labelledby="addKriteriaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addKriteriaModalLabel">Tambah Kriteria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- Form tambah kriteria --}}
                <form id="addKriteriaForm" action="{{ route('kriteria.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="addKriteriaNama">Nama Kriteria:</label>
                        <input type="text" class="form-control" id="addKriteriaNama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="addKriteriaBobot">Bobot:</label>
                        <input type="number" class="form-control" id="addKriteriaBobot" name="bobot" min="0.01"
                            step='0.01' required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- modal edit --}}
<div class="modal fade" id="editKriteriaModal" tabindex="-1" role="dialog" aria-labelledby="editKriteriaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKriteriaModalLabel">Edit Kriteria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- Form edit kriteria --}}
                <form id="editKriteriaForm" action="{{ route('kriteria.update', $item->id) }}" method="POST">
                    
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="editKriteriaNama">Nama Kriteria:</label>
                        <input type="text" class="form-control" id="editKriteriaNama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="bobot">Bobot:</label>
                        <input type="number" class="form-control" min='0.01' step="0.01" id="editKriteriaBobot"
                            name="bobot" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
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
                <form id="deleteKriteriaForm" action="#" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
                </form>
            </div>
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
<script>
    var deleteItemId;

    $('#confirmDeleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        deleteItemId = button.data('id');
    });

    $('#confirmDeleteBtn').on('click', function () {
        // Update action URL dynamically based on the selected item
        var actionUrl = '{{ route("kriteria.delete", ":id") }}';
        actionUrl = actionUrl.replace(':id', deleteItemId);

        // Set the form action and submit the form
        $('#deleteKriteriaForm').attr('action', actionUrl).submit();
    });
</script>



<script>
    $('#editKriteriaModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var nama = button.data('nama');
        var bobot = button.data('bobot');

        var actionUrl = '{{ route("kriteria.update", ":id") }}';
        actionUrl = actionUrl.replace(':id', id);
        

        $('#editKriteriaForm').attr('action', actionUrl);
        $('#editKriteriaNama').val(nama);
        $('#editKriteriaBobot').val(bobot);
    });
</script>


<!-- Page Specific JS File -->
<script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush