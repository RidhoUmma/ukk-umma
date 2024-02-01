@extends('admin.admin')
@section('content')
    <div class="content-body">

        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Data User</h4>
                                <button type="button" class="btn btn-primary btn-round ml-auto" data-toggle="modal"
                                    data-target="#modalCreate">
                                    <i class="fa fa-plus"></i>
                                    Tambah Data
                                </button>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($data_user as $row)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $row->name }}</td>
                                                <td>{{ $row->email }}</td>
                                                <td>{{ $row->role }}</td>
                                                <td>
                                                    <a href="#modalEdit{{ $row->id }}" data-toggle="modal"
                                                        class="btn btn-x5 btn-primary mr-3"><i class="fa fa-edit"></i>Edit</a>
                                                    <a href="#modalHapus{{ $row->id }}" data-toggle="modal"
                                                        class="btn btn-x5 btn-danger mr-3"><i class="fa fa-trash"></i>Hapus</a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #/ container -->
    </div>

    <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Buat Data User</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form method="POST" action="/user/store" id="createForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="name" placeholder="Nama" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select name="role" class="form-control" required>
                                <option value="" hidden>---Pilih Jenis---</option>
                                <option value="admin">Admin</option>
                                <option value="kasir">Kasir</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" onclick="createData()"><i
                                class="fa fa-save"></i>Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fa fa-undo"></i>Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @foreach ($data_user as $d)
        <div class="modal fade" id="modalEdit{{ $d->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data User</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <form method="POST" action="/user/update/{{ $d->id }}" id="updateForm{{ $d->id }}">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" value="{{ $d->name }}" class="form-control" name="name"
                                    placeholder="Nama" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" value="{{ $d->email }}" class="form-control" name="email"
                                    placeholder="Email" required>
                            </div>
                            {{-- <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Biarkan kosong untuk tetap menggunakan kata sandi saat ini">
                    </div> --}}
                            <div class="form-group">
                                <label>Role</label>
                                <select name="role" class="form-control" required>
                                    <option {{ $d->role === 'admin' ? 'selected' : '' }} value="admin">Admin</option>
                                    <option {{ $d->role === 'kasir' ? 'selected' : '' }} value="kasir">Kasir</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"onclick="updateData({{ $d->id }})"><i
                                    class="fa fa-save"></i>Simpan perubahan</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="fa fa-undo"></i>Tutup</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach


    @foreach ($data_user as $d)
        <div class="modal fade" id="modalHapus{{ $d->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Data User</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <form method="GET" action="/user/destroy/{{ $d->id }}" id="deleteForm{{ $d->id }}">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <h5>Apakah Anda yakin ingin menghapus data ini?</h5>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger"
                                onclick="confirmDelete({{ $d->id }})"><i class="fa fa-trash"></i>Hapus</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="fa fa-undo"></i>Tutup</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    <!-- ... (Bagian-bagian sebelumnya) ... -->

    <script>
        function createData() {
            // Form validation
            var name = document.forms["createForm"]["name"].value;
            var email = document.forms["createForm"]["email"].value;
            var password = document.forms["createForm"]["password"].value;
            var role = document.forms["createForm"]["role"].value;

            if (name === "" || email === "" || password === "" || role === "") {
                Swal.fire({
                    title: 'Error!',
                    text: 'Semua field harus diisi.',
                    icon: 'error'
                });
                return false;
            }

            // Submit the form
            document.getElementById('createForm').submit();
            showCreateSuccessAlert();
        }

        function showCreateSuccessAlert() {
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data berhasil dibuat.',
                icon: 'success'
            }).then(() => {
                // You can add additional actions here after the user clicks 'OK'
            });
        }

        function updateData(id) {
            // Simpan data menggunakan AJAX atau formulir submit biasa
            // Setelah sukses, tampilkan pemberitahuan SweetAlert2
            document.getElementById('updateForm' + id).submit();
            showUpdateSuccessAlert(); // Added this line
        }

        function showUpdateSuccessAlert() {
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data berhasil diperbarui.',
                icon: 'success'
            }).then(() => {
                // You can add additional actions here after the user clicks 'OK'
            });
        }

        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm' + id).submit();
                    showDeleteSuccessAlert(); // Added this line
                }
            });
        }

        function showDeleteSuccessAlert() {
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data berhasil dihapus.',
                icon: 'success'
            }).then(() => {
                // You can add additional actions here after the user clicks 'OK'
            });
        }
    </script>

    <!-- Tambahkan di bagian head atau sebelum penutup tag body -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
