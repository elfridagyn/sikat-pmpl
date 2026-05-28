<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Category;
use App\Models\AssetAttachment;
use App\Models\AssetHistory;
use App\Exports\AssetExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class AssetController extends Controller
{
    public function exportExcel() // Hapus parameter $id jika ada
    {
        return Excel::download(new AssetExport, 'semua-data-aset.xlsx');
    }

    public function exportPdf($id)
    {
        $asset = Asset::with('category')->findOrFail($id);
        $pdf = Pdf::loadView('assets.pdf-single', compact('asset'));
        return $pdf->download('details-' . $asset->kode_aset . '.pdf');
    }

    public function index(Request $request)
    {
        $query = Asset::with('category');

        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->search) {
            $query->where('nama_aset', 'like', '%' . $request->search . '%');
        }
        if ($request->kategori) {
            $query->where('kategori_id', $request->kategori);
        }

        $assets = $query->latest()->paginate(10);
        $categories = Category::all();

        return view('assets.index', compact('assets', 'categories'));
    }

    public function create()
    {
        return view('assets.create', ['categories' => Category::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_aset'           => 'required|string|max:255',
            'kode_aset'           => 'nullable|string|max:100',
            'kategori_id'         => 'nullable|exists:categories,id',
            'merk'                => 'required|string|max:255',
            'tipe'                => 'nullable|string|max:255',
            'lokasi'              => 'required|string|max:255',
            'kondisi'             => 'required|string|max:255',
            'produsen'            => 'nullable|string|max:255',
            'no_seri'             => 'nullable|string|max:255',
            'tahun_produksi'      => 'nullable|integer|min:1900|max:' . date('Y'),
            'deskripsi'           => 'nullable|string',
            'tanggal_pembelian'   => 'required|date',
            'distributor'         => 'required|string|max:255',
            'no_invoice'          => 'nullable|string|max:255',
            'jumlah'              => 'required|integer|min:1',
            'harga_satuan'        => 'required|numeric|min:0',
            'keterangan_tambahan' => 'nullable|string',
            'umur_ekonomi'        => 'required|integer|min:1',
            'foto_aset'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'lampiran'            => 'nullable|mimes:jpg,jpeg,png,pdf,docx,xlsx|max:5120'
        ]);

        $harga_total = $request->jumlah * $request->harga_satuan;
        $penyusutan_per_bulan = $harga_total / ($request->umur_ekonomi * 12);

        $fotoPath = null;
        if ($request->hasFile('foto_aset')) {
            $fotoPath = $request->file('foto_aset')->store('assets/foto', 'public');
        }

        $asset = Asset::create([
            'nama_aset'           => $request->nama_aset,
            'kode_aset'           => $request->kode_aset ?? '18/INV/' . date('Y'),
            'kategori_id'         => $request->kategori_id,
            'merk'                => $request->merk,
            'tipe'                => $request->tipe,
            'lokasi'              => $request->lokasi,
            'kondisi'             => $request->kondisi,
            'produsen'            => $request->produsen,
            'no_seri'             => $request->no_seri,
            'tahun_produksi'      => $request->tahun_produksi,
            'deskripsi'           => $request->deskripsi,
            'tanggal_pembelian'   => $request->tanggal_pembelian,
            'distributor'         => $request->distributor,
            'no_invoice'          => $request->no_invoice,
            'jumlah'              => $request->jumlah,
            'harga_satuan'        => $request->harga_satuan,
            'harga_total'         => $harga_total,
            'keterangan_tambahan' => $request->keterangan_tambahan,
            'umur_ekonomi'        => $request->umur_ekonomi,
            'penyusutan'          => $penyusutan_per_bulan,
            'foto_aset'           => $fotoPath,
            'status'              => 'aktif'
        ]);

        $qrName = 'qr-' . $asset->id . '.svg';
        $qrPath = public_path('qrcodes/' . $qrName);

        if (!file_exists(public_path('qrcodes'))) {
            mkdir(public_path('qrcodes'), 0755, true);
        }

        file_put_contents(
            $qrPath,
            \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
                ->size(300)
                ->generate(route('assets.show', $asset->id))
        );

        $asset->update(['qr_code' => 'qrcodes/' . $qrName]);

        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $path = $file->store('attachments', 'public');

            AssetAttachment::create([
                'asset_id'    => $asset->id,
                'nama_file'   => $path,
                'tipe_file'   => $file->getClientOriginalExtension(),
                'upload_date' => now()
            ]);
        }

        AssetHistory::create([
            'asset_id'   => $asset->id,
            'user_id'    => Auth::id(),
            'aktivitas'  => 'Menambahkan Asset',
            'keterangan' => 'Asset baru berhasil dibuat melalui formulir detail SIKAT',
            'tanggal'    => now()
        ]);

        return redirect()->route('assets.index')->with('success', 'Asset berhasil ditambahkan');
    }

    public function show($id)
    {
        $asset = Asset::with([
            'category',
            'histories.user',
            'maintenances' => function ($query) {
                $query->orderBy('tanggal_perbaikan', 'desc')->take(5);
            }
        ])->findOrFail($id);

        return view('assets.show', compact('asset'));
    }

    public function storeHistory(Request $request, $id)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'user_id'       => 'required|exists:users,id'
        ]);

        $asset = Asset::findOrFail($id);
        $targetUser = \App\Models\User::findOrFail($request->user_id);

        AssetHistory::create([
            'asset_id'   => $asset->id,
            'user_id'    => $targetUser->id,
            'aktivitas'  => 'Mutasi Penugasan',
            'keterangan' => 'Tanggung jawab operasional aset dialihkan kepada ' . $targetUser->name,
            'tanggal'    => $request->tanggal_mulai
        ]);

        return redirect()->back()->with('success', 'Riwayat penugasan penanggung jawab berhasil ditambahkan!');
    }

    public function downloadQr($id)
    {
        $asset = Asset::findOrFail($id);

        if ($asset->qr_code && file_exists(public_path($asset->qr_code))) {
            return response()->download(public_path($asset->qr_code), 'QR-' . $asset->id . '.svg');
        }

        return redirect()->back()->with('error', 'Berkas QR Code tidak ditemukan fisik.');
    }

    public function edit(Asset $asset)
    {
        return view('assets.edit', [
            'asset'      => $asset,
            'categories' => Category::all()
        ]);
    }

    public function update(Request $request, Asset $asset)
    {
        // Cek apakah ada request status (untuk aktif/non-aktif)
        if ($request->has('status')) {
            $newStatus = $request->status; // 'aktif' atau 'non-aktif'
            $oldStatus = $asset->status;

            $asset->update(['status' => $newStatus]);

            \App\Models\AssetHistory::create([
                'asset_id'   => $asset->id,
                'user_id'    => \Illuminate\Support\Facades\Auth::id(),
                'aktivitas'  => 'Update Status',
                'keterangan' => 'Status aset diubah dari ' . $oldStatus . ' menjadi ' . $newStatus,
                'tanggal'    => now()
            ]);

            return redirect()->back()->with('success', 'Status aset berhasil diubah menjadi ' . $newStatus);
        }

        // BARU SETELAH ITU JALANKAN VALIDASI UNTUK UPDATE DATA
        $validated = $request->validate([
            'nama_aset'         => 'required|string|max:255',
            // ... (validasi lainnya)
        ]);

        // ... (logic update lainnya)


        // 2. Validasi Data
        $validated = $request->validate([
            'nama_aset'         => 'required|string|max:255',
            'kategori_id'       => 'nullable|exists:categories,id',
            'merk'              => 'required|string|max:255',
            'tipe'              => 'nullable|string|max:255',
            'lokasi'            => 'required|string|max:255',
            'kondisi'           => 'required|string|max:255',
            'produsen'          => 'nullable|string|max:255',
            'no_seri'           => 'nullable|string|max:255',
            'tahun_produksi'    => 'nullable|integer',
            'deskripsi'         => 'nullable|string',
            'tanggal_pembelian' => 'required|date',
            'distributor'       => 'required|string|max:255',
            'no_invoice'        => 'nullable|string|max:255',
            'jumlah'            => 'required|integer|min:1',
            'harga_satuan'      => 'required|numeric|min:0',
            'umur_ekonomi'      => 'required|integer|min:1',
            'foto_aset'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // 3. Kalkulasi Finansial
        $harga_total = $request->jumlah * $request->harga_satuan;
        $penyusutan_per_bulan = $harga_total / ($request->umur_ekonomi * 12);

        // 4. Handle Foto
        if ($request->hasFile('foto_aset')) {
            // Hapus foto lama jika ada
            if ($asset->foto_aset) {
                Storage::disk('public')->delete($asset->foto_aset);
            }
            $validated['foto_aset'] = $request->file('foto_aset')->store('assets/foto', 'public');
        }

        // 5. Update data aset
        $asset->update(array_merge($validated, [
            'harga_total' => $harga_total,
            'penyusutan'  => $penyusutan_per_bulan
        ]));

        // 6. Catat ke History
        AssetHistory::create([
            'asset_id'   => $asset->id,
            'user_id'    => Auth::id(),
            'aktivitas'  => 'Update Asset',
            'keterangan' => 'Informasi aset "' . $asset->nama_aset . '" diperbarui.',
            'tanggal'    => now()
        ]);

        return redirect()->route('assets.show', $asset->id)->with('success', 'Asset berhasil diupdate');
    }

    public function destroy(Asset $asset)
    {
        // Hapus foto jika ada saat aset dihapus
        if ($asset->foto_aset) {
            Storage::disk('public')->delete($asset->foto_aset);
        }

        AssetHistory::create([
            'asset_id'   => $asset->id,
            'user_id'    => Auth::id(),
            'aktivitas'  => 'Hapus Asset',
            'keterangan' => 'Asset dihapus dari sistem',
            'tanggal'    => now()
        ]);

        $asset->delete();
        return redirect()->route('assets.index')->with('success', 'Asset berhasil dihapus');
    }
}
