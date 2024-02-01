<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    //
    public function laporan()
    {

        return view('admin.laporan.laporan');
    }

    public function index()
    {
        $data = array(
            'title' => 'Data Transaksi',
            'data_barang' => DB::table('tbl_barang')->get(),
            // 'data_transaksi' => DB::table('tbl_transaksi')->get(),
        );

        return view('kasir.transaksi.add', $data);
    }
    // public function index()
    // {
    //     $data = array(
    //         'title' => 'Data Transaksi',
    //         'data_transaksi' => Transaksi::all(),
    //         'data_barang' => Barang::all(),
    //     );
    //     return view('kasir.transaksi.add', $data);
    // }
    // public function create()
    // {
    //     $data = array(
    //         'title' => 'Data User',

    //     );
    //     return view('kasir.transaksi.add', $data);
    // }
    public function tambahBarang(Request $request)
    {
        $id_barang = $request->input('id_barang');

        // Mengambil data barang berdasarkan ID
        $barang = DB::table('tbl_barang')->where('kode_barang', $id_barang)->first();

        // Menambahkan data barang ke dalam tabel transaksi
        DB::table('tbl_transaksi')->insert([
            'barang' => $barang->name_barang,
            'harga' => $barang->harga_jual,
            // tambahkan kolom-kolom lain sesuai kebutuhan
        ]);

        return redirect('/transaksi')->with('success', 'Barang berhasil ditambahkan ke transaksi');
    }
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'no_transaksi' => 'required',
            'tgl_transaksi' => 'required|date',
            // Sesuaikan dengan kolom-kolom lain yang diperlukan
        ]);

        // Simpan data transaksi ke dalam tabel transaksi
        $transaksi = new Transaksi([
            'no_transaksi' => $request->input('no_transaksi'),
            'tgl_transaksi' => $request->input('tgl_transaksi'),
            // Sesuaikan dengan kolom-kolom lain yang diperlukan
        ]);

        $transaksi->save();

        // Ambil data barang yang ada dalam transaksi
        $barangData = $request->input('barang');
        $hargaData = $request->input('harga');
        $qtyData = $request->input('qty');
        $subtotalData = $request->input('subtotal');

        // Loop untuk menyimpan data barang per baris
        for ($i = 0; $i < count($barangData); $i++) {
            DB::table('tbl_detail_transaksi')->insert([
                'transaksi_id' => $transaksi->id,
                'barang' => $barangData[$i],
                'harga' => $hargaData[$i],
                'qty' => $qtyData[$i],
                'subtotal' => $subtotalData[$i],
                // Sesuaikan dengan kolom-kolom lain yang diperlukan
            ]);
        }

        // Redirect atau lakukan aksi lain setelah berhasil menyimpan transaksi
        return redirect('/transaksi')->with('success', 'Transaksi berhasil disimpan');
    }
}
