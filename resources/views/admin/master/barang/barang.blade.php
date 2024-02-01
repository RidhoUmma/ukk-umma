@extends('admin.admin')
@section('content')
    <div class="content-body">

        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Barang</a></li>
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
                                <h4 class="card-title">Data Barang</h4>
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
                                            <th>Nama Jenis</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                            <th>Stok</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($barang as $row)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $row->name_jenis }}</td>
                                                <td>{{ $row->kode_barang }}</td>
                                                <td>{{ $row->name_barang }}</td>
                                                <td>Rp{{ number_format($row->harga_beli) }}</td>
                                                <td>Rp{{ number_format($row->harga_jual) }}</td>
                                                <td>{{ $row->stok }}</td>
                                                <td class="d-flex justify-content-ceter">
                                                    <a href="#modalEdit{{ $row->id }}" data-toggle="modal"
                                                        class="btn btn-x5 btn-primary mr-3"><i class="fa fa-edit"></i>
                                                        Edit</a>
                                                    <a href="#modalHapus{{ $row->id }}" data-toggle="modal"
                                                        class="btn btn-x5 btn-danger"><i class="fa fa-trash"></i> Hapus</a>
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

    <!-- resources/views/admin/master/barang/modal_create.blade.php -->

    <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Buat Data Barang</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form method="POST" action="/barang/store" id="createForm"
                    onsubmit="return validateCreateForm() && createData()">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="id_jenis">Jenis Barang</label>
                            <select class="form-control" id="id_jenis" name="id_jenis" required>
                                <option value="" hidden>---Pilih Jenis---</option>
                                @foreach ($jenisBarang as $jenis)
                                    <option value="{{ $jenis->id }}">{{ $jenis->name_jenis }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name_barang">Nama Barang</label>
                            <input type="text" class="form-control" name="name_barang" id="name_barang"
                                placeholder="Nama Barang" required>
                        </div>
                        <div class="form-group">
                            <label for="harga_beli">Harga Beli</label>
                            <input type="text" class="form-control" name="harga_beli" id="harga_beli"
                                placeholder="Harga Beli" required>
                        </div>
                        <div class="form-group">
                            <label for="harga_jual">Harga Jual</label>
                            <input type="text" class="form-control" name="harga_jual" id="harga_jual"
                                placeholder="Harga Jual" required>
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input type="text" class="form-control" name="stok" id="stok" placeholder="Stok"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i>
                            Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- resources/views/admin/master/barang/modal_update.blade.php -->

    @foreach ($barang as $row)
        <div class="modal fade" id="modalEdit{{ $row->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Barang</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <form method="POST" action="/barang/update/{{ $row->id }}"
                        id="updateForm{{ $row->id }}">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="id_jenis">Jenis Barang</label>
                                <select class="form-control" id="id_jenis" name="id_jenis" required>
                                    @foreach ($jenisBarang as $jenis)
                                        <option value="{{ $jenis->id }}"
                                            {{ $row->id_jenis == $jenis->id ? 'selected' : '' }}>
                                            {{ $jenis->name_jenis }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name_barang">Nama Barang</label>
                                <input type="text" class="form-control" name="name_barang" id="name_barang"
                                    value="{{ $row->name_barang }}" required>
                            </div>
                            <div class="form-group">
                                <label for="harga_beli">Harga Beli</label>
                                <input type="text" class="form-control" name="harga_beli" id="harga_beli"
                                    value="{{ $row->harga_beli }}" required>
                            </div>
                            <div class="form-group">
                                <label for="harga_jual">Harga Jual</label>
                                <input type="text" class="form-control" name="harga_jual" id="harga_jual"
                                    value="{{ $row->harga_jual }}" required>
                            </div>
                            <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="text" class="form-control" name="stok" id="stok"
                                    value="{{ $row->stok }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" onclick="updateData({{ $row->id }})"><i
                                    class="fa fa-save"></i> Simpan perubahan</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="fa fa-undo"></i> Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach



    @foreach ($barang as $row)
        <div class="modal fade" id="modalHapus{{ $row->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Data User</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <form method="GET" action="/barang/destroy/{{ $row->id }}"
                        id="deleteForm{{ $row->id }}">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <h5>Apakah Anda yakin ingin menghapus data ini?</h5>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger"
                                onclick="confirmDelete({{ $row->id }})"><i class="fa fa-trash"></i>Hapus</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="fa fa-undo"></i>Tutup</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach


    <!-- ... (script JavaScript untuk SweetAlert2 dan fungsi updateData) ... -->


    <script>
        function validateCreateForm() {
            var id_jenis = document.forms["createForm"]["id_jenis"].value;
            var name_barang = document.forms["createForm"]["name_barang"].value;
            var harga_beli = document.forms["createForm"]["harga_beli"].value;
            var harga_jual = document.forms["createForm"]["harga_jual"].value;
            var stok = document.forms["createForm"]["stok"].value;

            if (id_jenis == "" || name_barang == "" || harga_beli == "" || harga_jual == "" || stok == "") {
                Swal.fire({
                    title: 'Error!',
                    text: 'Semua field harus diisi.',
                    icon: 'error'
                });
                return false;
            }
            return true;
        }

        function createData() {
            // Add your logic for creating data here.
            // Optionally, show a success alert after the form is submitted.
            showCreateSuccessAlert();
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
            });
        }
    </script>



    <!-- Tambahkan di bagian head atau sebelum penutup tag body -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
