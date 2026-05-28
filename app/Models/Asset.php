<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Asset extends Model
{
    use HasFactory;

    protected $table = 'assets';

    protected $fillable = [
        'nama_aset',
        'kode_aset',
        'kategori_id',
        'merk',
        'tipe',
        'produsen',
        'no_seri',
        'tahun_produksi',
        'deskripsi',
        'lokasi',
        'kondisi',
        'tanggal_pembelian',
        'distributor',
        'no_invoice',
        'jumlah',
        'harga_satuan',
        'harga_total',
        'keterangan_tambahan',
        'umur_ekonomi',
        'penyusutan',
        'foto_aset',
        'status',
        'qr_code'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }

    /**
     * Relasi Riwayat Aktivitas / Mutasi Penugasan
     */
    public function histories(): HasMany
    {
        return $this->hasMany(AssetHistory::class, 'asset_id');
    }

    /**
     * Relasi Log Pemeliharaan Berkala
     */
    public function Northwestmaintenances(): HasMany
    {
        return $this->hasMany(Maintenance::class, 'asset_id');
    }

    // Alias penunjang agar tetap aman dipanggil dari sisi manapun
    // Hapus atau ganti Northwestmaintenances dengan ini
    public function maintenances(): HasMany
    {
        return $this->hasMany(Maintenance::class, 'asset_id');
    }
}
