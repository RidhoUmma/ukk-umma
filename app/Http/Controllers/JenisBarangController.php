<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use Illuminate\Http\Request;

class JenisBarangController extends Controller
{
    public function index()
    {
        $jenisBarang = array(
            'title' => 'Data User',
            'jenisBarang' => JenisBarang::all(),
        );
        return view('admin.master.jenisbarang.jenisbarang', $jenisBarang);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name_jenis' => 'required',
        ], [
            'name_jenis.required' => 'Nama Jenis tidak boleh kosong.',
        ]);
        JenisBarang::create([
            'name_jenis' => $request->name_jenis,
        ]);
        return redirect('/jenisbarang')->with('success', 'Jenis Barang created successfully');
    }
    // public function create()
    // {
    //     return view('jenisbarang.create');
    // }
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'jenisbarang' => 'required',
    //     ]);

    //     JenisBarang::create($request->all());

    //     return redirect()->route('jenisbarang.index')
    //         ->with('success', 'Jenis Barang created successfully');
    // }

    // public function edit(JenisBarang $jenisBarang)
    // {
    //     return view('jenisbarang.edit', compact('jenisBarang'));
    // }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_jenis' => 'required',
        ]);
        JenisBarang::where('id', $id)
            ->where('id', $id)
            ->update([
                'name_jenis' => $request->name_jenis,
            ]);

        return redirect('/jenisbarang')->with('success', 'Jenis Barang update successfully');
    }

    public function destroy($id)
    {
        $jenisBarang = JenisBarang::find($id);

        if (!$jenisBarang) {
            return redirect('/jenisbarang')->with('error', 'Jenis Barang not found');
        }

        // Check if there are any related entries in tbl_barang
        if ($jenisBarang->barangs()->exists()) {
            return redirect('/jenisbarang')->with('error', 'Cannot delete jenis_barang because it is still referenced in tbl_barang');
        }

        // No references found, proceed with deletion
        $jenisBarang->delete();

        return redirect('/jenisbarang')->with('success', 'Jenis Barang deleted successfully');
    }
    public function checkReference($id)
    {
        $jenisBarang = JenisBarang::find($id);

        if (!$jenisBarang) {
            return response()->json(['error' => 'Jenis Barang tidak ditemukan']);
        }

        // Periksa apakah ada entri terkait di tbl_barang
        if ($jenisBarang->barangs()->exists()) {
            // Data dirujuk dalam tbl_barang, kirim pesan kesalahan
            return response()->json(['error' => 'Tidak dapat menghapus Jenis Barang ini karena sudah digunakan di Barang']);
        }

        // Tidak ada referensi ditemukan
        return response()->json(['success' => true]);
    }
}
