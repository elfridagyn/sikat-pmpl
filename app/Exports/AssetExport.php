<?php

namespace App\Exports;

use App\Models\Asset;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AssetExport implements FromCollection, WithHeadings, WithMapping
{
    protected $assets;

    // Jika Anda ingin mengekspor SEMUA data
    public function __construct()
    {
        $this->assets = Asset::all();
    }

    public function collection()
    {
        return $this->assets;
    }

    /**
     * Menambahkan baris keterangan (header informasi) di bagian atas
     */
    public function headings(): array
    {
        return [
            ['LAPORAN DATA ASET'], // Baris 1
            ['Dicetak pada: ' . now()->format('d-m-Y H:i:s')], // Baris 2
            [''], // Baris kosong untuk spasi
            ['ID', 'Nama Aset', 'Merk', 'Lokasi', 'Status', 'Tanggal Pembelian'] // Header kolom utama
        ];
    }

    /**
     * Memetakan data ke kolom-kolom yang sudah ditentukan
     */
    public function map($asset): array
    {
        return [
            $asset->id,
            $asset->nama_aset,
            $asset->merk,
            $asset->lokasi,
            $asset->status,
            $asset->tanggal_pembelian ? \Carbon\Carbon::parse($asset->tanggal_pembelian)->format('d M Y') : '-',
        ];
    }
}