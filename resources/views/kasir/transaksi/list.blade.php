@extends('kasir.kasir')
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
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Transaksi</h4>
                                <button type="button" class="btn btn-primary btn-round ml-auto" href="/transaksi/create">
                                    <i class="fa fa-plus"></i>
                                    Tambah Data
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Transaksi</th>
                                        <th>Tanggal</th>
                                        <th>Total Bayar</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($data_transaksi as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->no_transaksi }}</td>
                                            <td>{{ date('d/M/Y', strtotine($row->tgl_transaksi)) }}</td>
                                            <td>Rp{{ number_format($row->total_bayar) }}</td>
                                            <td>
                                                <a href="#" target="_blank" class="btn btn-x5 btn-primary mr-3"><i
                                                        class="fa fa-print"></i> Cetak</a>
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
        <!-- #/ container -->
    </div>
@endsection
