@extends(auth()->user()->role === 'admin' ? 'admin.admin' : 'kasir.kasir')
@section('content')
    <div class="content-body">

        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        @if (auth()->user()->role === 'admin')
                            <a href="/admin">Dashboard</a>
                        @elseif(auth()->user()->role === 'kasir')
                            <a href="/kasir">Dashboard</a>
                        @else
                            <!-- Handle other roles if needed -->
                        @endif
                    </li>
                    
                    {{-- <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                     --}}
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @foreach ($data_profile as $d)
                        <form method="POST" action="/profile/updateprofile/{{ $d->id }}">
                            @csrf
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Profile</h4>
                                </div>
                                <hr />
                        
                                <!-- Hidden Input for Role -->
                                <input type="hidden" name="role" value="{{ $d->role }}" required>
                        
                                <div class="row">
                                    <div class="col-md-12">
                                        {{-- <img src="assets/theme/images/user/logok.png" height="100" width="100" alt="Admin Image"> --}}
                                        {{-- <img src="@if (auth()->user()->role === 'admin') assets/theme/images/user/9.jpg @elseif(auth()->user()->role === 'kasir') assets/theme/images/user/logok.png @else <!-- Handle other roles if needed --> @endif" height="100" width="100" alt="Admin Image"> --}}
                                        <img src="@if (auth()->user()->role === 'admin') assets/theme/images/user/9.jpg @elseif(auth()->user()->role === 'kasir') assets/theme/images/user/logok.png @else <!-- Handle other roles if needed --> @endif" class="rounded-circle" style="margin-bottom: 10px;" height="100" width="100" alt="Admin Image">
                                        </div>
                                        <hr/>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> Nama</label>
                                                <!-- Read-only Input for Name -->
                                                <input type="text" class="form-control" name="name" placeholder="Nama" value="{{ $d->name }}" readonly required>
                                            </div>
                                        </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Email</label>
                                            <!-- Read-only Input for Email -->
                                            <input type="email" class="form-control" name="email" placeholder="Total Belanja" value="{{ $d->email }}" readonly required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Role</label>
                                            <!-- Read-only Input for Email -->
                                            <input type="text" class="form-control" name="role" placeholder="Role" value="{{ $d->role }}" readonly required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Remove Card Footer -->
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
