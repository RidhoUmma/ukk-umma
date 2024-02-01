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
                        @foreach ($data_diskon as $d)
                            <form method="POST" action="/setdiskon/update/{{ $d->id }}">
                                @csrf
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Setting Diskon</h4>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Total Belanja</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend"><span class="input-group-text">Rp</span>
                                                </div>
                                                <input type="number" class="form-control" name="total_belanja"
                                                    placeholder="Total Belanja" value="{{ $d->total_belanja }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Diskon</label>
                                            <div class="input-group mb-3">
                                                <input type="number" class="form-control" name="diskon"
                                                    placeholder="Diskon" value="{{ $d->diskon }}" required>
                                                <div class="input-group-append"><span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" onclick="return updateData();"><i
                                            class="fa fa-save"></i> Simpan</button>
                                </div>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- #/ container -->
    </div>

    <!-- ... Your existing code ... -->

    <script>
        function updateData() {
            // Add validation for non-empty fields
            var total_belanja = document.forms[0]["total_belanja"].value;
            var diskon = document.forms[0]["diskon"].value;

            if (total_belanja === "" || diskon === "") {
                Swal.fire({
                    title: 'Error!',
                    text: 'Total Belanja dan Diskon tidak boleh kosong.',
                    icon: 'error'
                });
                return false;
            }

            // Prepare data for AJAX request
            var formData = new FormData(document.forms[0]);

            // Submit the form asynchronously using AJAX
            $.ajax({
                type: 'POST',
                url: '/setdiskon/update/{{ $d->id }}',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Show SweetAlert for success
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data berhasil diperbarui.',
                        icon: 'success'
                    });
                },
                error: function(error) {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat memperbarui data.',
                        icon: 'error'
                    });
                }
            });

            return false; // Prevent the form from submitting traditionally
        }
    </script>

    <!-- ... Your existing code ... -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <!-- Add to the head section or before the closing body tag -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Replace the CDN script with a local path -->
    <script src="/path/to/sweetalert2@11"></script>
@endsection
