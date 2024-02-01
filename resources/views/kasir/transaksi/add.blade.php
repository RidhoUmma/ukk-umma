@extends('kasir.kasir')
@section('content')
    <div class="content-body">

        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/kasir">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form method="POST" action="/transaksi/store">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Transaksi</h4>
                                    <button type="button" class="btn btn-primary btn-round ml-auto" data-toggle="modal"
                                        data-target="#modalCreate">
                                        <i class="fa fa-plus"></i>
                                        Tambah Data
                                    </button>
                                </div>
                                {{-- <hr /> --}}
                                {{-- <div class="row">
                                    <div class="col-md-6">
                                        <label>Barang</label>
                                        <select class="form-control" id="id_barang" name="kode_barang"
                                            onchange="tambahBarang()">
                                            <option value="" hidden>---Pilih Barang---</option>
                                            @foreach ($data_barang as $barang)
                                                <option value="{{ $barang->kode_barang }}">{{ $barang->kode_barang }} -
                                                    {{ $barang->name_barang }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}

                                {{-- <button type="button" class="btn btn-sm btn-primary" data-target="#modalCreate"
                                    data-toggle="modal">
                                    <i class="fa fa-plus"></i>
                                    Tambah Data
                                </button> --}}
                                <hr />
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">

                                        <tr>
                                            <th>No</th>
                                            <th>Barang</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                            <th>Action</th>
                                        </tr>
                                        <tr>
                                            <th>No</th>
                                            <th>Barang</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                            <th>
                                                <a href="" data-toggle="modal" class="btn btn-x5 btn-danger mr-3"><i
                                                        class="fa fa-trash"></i>Hapus</a>
                                            </th>
                                        </tr>
                                        {{-- <tbody id="tabelBarang">
                                            <td>1</td>
                                            <td>indomi</td>
                                            <td>indomi</td>
                                        </tbody> --}}
                                        <tr>
                                            <td colspan="5">Total Bayar</td>
                                            <td>Rp ???</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">Diskon</td>
                                            <td>Rp ???</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">Seluruh total</td>
                                            <td>Rp ???</td>
                                        </tr>
                                    </table>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No Transaksi</label>
                                            <input type="text" class="form-control" name="no_transaksi" value="NT-001"
                                                readonly required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tgl Transaksi</label>
                                            <input type="text" class="form-control" name="tgl_transaksi"
                                                value="{{ date('d/M/Y') }}" readonly required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Uang Pembeli</label>
                                            <input type="text" class="form-control" name="uang_pembeli" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Kembalian</label>
                                            <input type="text" class="form-control" name="kembalian" value=""
                                                readonly required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="modal-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Simpan</button>
                                <button type="button" class="btn btn-secondary"><i class="fa fa-undo"></i>Tutup</button>
                            </div> --}}
                        </form>
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
                    <h5 class="modal-title">Buat Data Barang</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form method="POST" action="/transaksi/cart">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="id_jenis">Jenis Barang</label>
                            <select class="form-control" id="id_jenis" name="id_jenis" required>
                                <option value="" hidden>---Pilih Jenis---</option>
                                @foreach ($data_barang as $barang)
                                    <option value="{{ $barang->kode_barang }}">{{ $barang->kode_barang }} -
                                        {{ $barang->name_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">

                            <label for="harga_jual">Harga jual</label>
                            <input type="text" class="form-control" name="harga_jual" id="harga_jual"
                                value="" required readonly>

                        </div>
                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input type="text" class="form-control" name="stok" id="stok"
                                value="" required readonly>
                        </div>
                        {{-- <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="text" class="form-control" name="harga" value="" readonly>
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input type="text" class="form-control" name="stok" value="" readonly>
                        </div> --}}
                        <div class="form-group">
                            <label for="qty">qty</label>
                            <input type="text" class="form-control" name="qty" value="" placeholder="Qty --"
                                required>
                        </div>
                        <div id="tampil_barang"></div>

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




    <!-- Tambahkan di bagian head atau sebelum penutup tag body -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
