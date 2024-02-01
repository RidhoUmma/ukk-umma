@extends('admin.admin')
@section('content')
    <div class="content-body">

        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Jenis Barang</a></li>
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
                                <h4 class="card-title">Data Jenis Barang</h4>
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
                                            <th>Jenis</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($jenisBarang as $row)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $row->name_jenis }}</td>
                                                <td>
                                                    <a href="#modalEdit{{ $row->id }}" data-toggle="modal"
                                                        class="btn btn-x5 btn-primary mr-3"><i
                                                            class="fa fa-edit"></i>Edit</a>
                                                    <a href="#modalHapus{{ $row->id }}" data-toggle="modal"
                                                        class="btn btn-x5 btn-danger mr-3"><i
                                                            class="fa fa-trash"></i>Hapus</a>

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
                    <h5 class="modal-title">Buat Data Jenis Barang</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form method="POST" action="/jenisbarang/store" id="createForm"
                    onsubmit="return validateCreateForm() && createData()">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Jenis</label>
                            <input type="text" class="form-control" name="name_jenis" placeholder="Nama Jenis" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fa fa-undo"></i>Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($jenisBarang as $d)
        <div class="modal fade" id="modalEdit{{ $d->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Jenis Barang</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <form method="POST" action="/jenisbarang/update/{{ $d->id }}"id="updateForm{{ $d->id }}">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Jenis</label>
                                <input type="text" value="{{ $d->name_jenis }}" class="form-control" name="name_jenis"
                                    placeholder="Nama Jenis" required>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" onclick="updateData({{ $d->id }})"><i
                                    class="fa fa-save"></i>Simpan perubahan</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="fa fa-undo"></i>Tutup</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($jenisBarang as $d)
        <div class="modal fade" id="modalHapus{{ $d->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Data User</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <form method="GET" action="/jenisbarang/destroy/{{ $d->id }}"
                        id="deleteForm{{ $d->id }}">
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

    <script>
        function validateCreateForm() {
            var name_jenis = document.forms["createForm"]["name_jenis"].value;

            if (name_jenis == "") {
                Swal.fire({
                    title: 'Error!',
                    text: 'Nama Jenis tidak boleh kosong.',
                    icon: 'error'
                });
                return false;
            }

            // Jika semua validasi sukses, izinkan formulir untuk disubmit
            return true;
        }

        function createData() {
            // Log a message to the console to check if this function is being executed.
            console.log('createData function executed successfully.');

            // You can add your logic for creating data here.

            // Optionally, you can show a success alert after the form is submitted.
            showCreateSuccessAlert();

            // Return true or false based on the result of your operation.
            return true;
        }

        function showCreateSuccessAlert() {
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data berhasil dibuat.',
                icon: 'success'
            }).then((result) => {
                if (result.isConfirmed || result.isDismissed) {
                    // Redirect or perform other actions after the alert is closed
                    window.location.href = "/redirect-path"; // Replace with the appropriate path
                }
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
            // Tambahkan fungsi ajax di sini untuk memeriksa rujukan di tbl_barang
            $.ajax({
                url: '/jenisbarang/checkReference/' + id,
                type: 'GET',
                success: function(response) {
                    if (response.error) {
                        Swal.fire({
                            title: 'Gagal!',
                            text: response.error,
                            icon: 'error'
                        });
                    } else {
                        // Tidak ada rujukan, lanjutkan dengan penghapusan
                        document.getElementById('deleteForm' + id).submit();
                        showDeleteSuccessAlert(); // Pindahkan ini ke sini
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });
}

function showDeleteSuccessAlert() {
    Swal.fire({
        title: 'Berhasil!',
        text: 'Data berhasil dihapus.',
        icon: 'success'
    }).then((result) => {
        // Tambahkan logika atau redirect setelah alert berhasil ditutup
        // Misalnya, melakukan redirect ke halaman tertentu:
        window.location.href = "/redirect-path"; // Gantilah dengan path yang sesuai
    });
}

    </script>

    <!-- Add to the head section or before the closing body tag -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
