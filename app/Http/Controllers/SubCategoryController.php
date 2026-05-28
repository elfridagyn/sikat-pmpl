<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'nama_subkategori' => 'required',
        ]);

        // 1. Ambil kode terakhir dari database
        $lastSub = SubCategory::latest()->first();

        // 2. Tentukan nomor urut
        $nextNumber = $lastSub ? ((int)substr($lastSub->kode_subkategori, 4) + 1) : 1;

        // 3. Format kode otomatis (contoh: SUB-001)
        $kodeOtomatis = 'SUB-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // 4. Simpan ke database
        SubCategory::create([
            'category_id' => $request->category_id,
            'nama_subkategori' => $request->nama_subkategori,
            'kode_subkategori' => $kodeOtomatis,
        ]);

        return redirect()->back()->with('success', 'Subkategori ' . $kodeOtomatis . ' berhasil dibuat!');
    }
    public function destroy($id)
    {
        $sub = \App\Models\SubCategory::findOrFail($id);
        $sub->delete();
        return redirect()->back()->with('success', 'Subkategori berhasil dihapus!');
    }
}
