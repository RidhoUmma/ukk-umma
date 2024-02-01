<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::join('tbl_jenis_barang', 'tbl_jenis_barang.id', '=', 'tbl_barang.id_jenis')
            ->select('tbl_barang.*', 'tbl_jenis_barang.name_jenis')
            ->get();
        $jenisBarang = JenisBarang::all();
        return view('admin.master.barang.barang', compact('barang', 'jenisBarang'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_jenis' => 'required',
            'name_barang' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
        ]);
        Barang::create([
            'id_jenis' => $request->id_jenis,
            'name_barang' => $request->name_barang,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
        ]);
        return redirect('/barang')->with('success', 'Barang created successfully');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_jenis' => 'required',
            'name_barang' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
        ]);

        $barang = Barang::findOrFail($id);

        $barang->update([
            'id_jenis' => $request->id_jenis,
            'name_barang' => $request->name_barang,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
        ]);

        return redirect('/barang')->with('success', 'Barang updated successfully');
    }

    public function destroy($id)
    {
        $barang = Barang::where('id', $id)->delete();

        return redirect('/barang')->with('success', 'Barang deleted successfully');
    }
}
