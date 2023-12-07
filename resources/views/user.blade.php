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
            <h1>Management User</h1>
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
            <h4>Daftar User</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pengguna</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                            @foreach ($user as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->roles->first()->name }}</td>
                                <td>
                                    <a href="" class="btn btn-warning" data-toggle="modal" data-target="#editUserModal"
                                        data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                                        data-email="{{ $item->email }}"
                                        data-role="{{ $item->roles->first()->name }}">Edit</a>
                                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#deleteUserModal"
                                        data-id="{{ $item->id }}">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal"><i
                                    class="fa-solid fa-plus"> </i> Tambah</a>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Tambah User Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form tambah user -->
                    <form action="{{ route('user.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama Pengguna</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <!-- Isi dengan opsi role yang sesuai -->
                                <option value="general manager">Geneal Manager</option>
                                <option value="head of department">Head of Department</option>
                                <option value="HRD">HRD</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit User -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form edit user -->
                    <form id="editUserForm" action="{{ route('user.update' , $item->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="editUserId">
                        <div class="form-group">
                            <label for="editName">Nama Pengguna</label>
                            <input type="text" class="form-control" id="editUserName" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="editEmail">Email</label>
                            <input type="email" class="form-control" id="editUserEmail" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="editRole">Role</label>
                            <select class="form-control" id="editUserRole" name="role" required>
                                <!-- Isi dengan opsi role yang sesuai -->
                                <option value="general manager">Geneal Manager</option>
                                <option value="head of department">Head of Department</option>
                                <option value="HRD">HRD</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Hapus User -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteUserModalLabel">Hapus User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- Form hapus user -->
                    <form action="{{ route('user.delete', $item->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" id="deleteUserId">
                        <p>Apakah Anda yakin ingin menghapus user ini?</p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
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
    <!-- JS untuk Modal Edit dan Hapus -->
    <script>
        $('#editUserModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var email = button.data('email');
            var role = button.data('role');
 
            // Mengisi nilai ke dalam form edit
            $('#editUserId').val(id);
            $('#editUserName').val(name);
            $('#editUserEmail').val(email);
            $('#editUserRole').val(role);
            // Perbarui URL aksi pada formulir edit
            var actionUrl = '{{ route("user.update", ":id") }}';
        actionUrl = actionUrl.replace(':id', id);
        $('#editUserForm').attr('action', actionUrl);
        });

        $('#deleteUserModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');

            // Mengisi nilai ke dalam form hapus
            $('#deleteUserId').val(id);
        });
    </script>





    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
    @endpush