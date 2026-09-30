<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Galeri extends Model
{
    /**
     * Kolom yang boleh diisi massal.
     */
    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'harga',
        'is_produk',
        'satuan',
        'stok',
        'gambar',
        'keterangan',
        'kategori',
        'jenis',
        'urutan',
        'is_active',
    ];

    /**
     * Casting tipe data.
     */
    protected $casts = [
        'is_active' => 'boolean',
        'is_produk' => 'boolean',
        'harga'     => 'decimal:2',
        'stok'      => 'integer',
        'urutan'    => 'integer',
    ];

    // ========================================
    // BOOT — Auto-generate slug
    // ========================================
    protected static function booted(): void
    {
        static::creating(function ($galeri) {
            if (empty($galeri->slug) && !empty($galeri->judul)) {
                $galeri->slug = static::generateUniqueSlug($galeri->judul);
            }
        });

        static::updating(function ($galeri) {
            if ($galeri->isDirty('judul') && empty($galeri->slug)) {
                $galeri->slug = static::generateUniqueSlug(
                    $galeri->judul,
                    $galeri->id
                );
            }
        });
    }

    private static function generateUniqueSlug(string $judul, ?int $exceptId = null): string
    {
        $slug = Str::slug($judul);
        $original = $slug;
        $count = 1;

        while (
            static::where('slug', $slug)
            ->when($exceptId, fn($q) => $q->where('id', '!=', $exceptId))
            ->exists()
        ) {
            $slug = $original . '-' . $count++;
        }

        return $slug;
    }

    // ========================================
    // ACCESSOR
    // ========================================

    /**
     * Format harga ke Rupiah.
     * Pemakaian: $galeri->harga_rupiah
     */
    public function getHargaRupiahAttribute(): ?string
    {
        return $this->harga
            ? 'Rp ' . number_format((float) $this->harga, 0, ',', '.')
            : null;
    }

    /**
     * Cek apakah stok tersedia.
     * Pemakaian: $galeri->stok_tersedia
     */
    public function getStokTersediaAttribute(): bool
    {
        return $this->stok === null || $this->stok > 0;
    }

    // ========================================
    // SCOPE
    // ========================================

    /**
     * Scope: hanya yang aktif.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: urutkan berdasarkan kolom `urutan`.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc');
    }

    /**
     * Scope: hanya produk.
     */
    public function scopeProduk($query)
    {
        return $query->where('is_produk', true);
    }

    /**
     * Scope: hanya kegiatan (bukan produk).
     */
    public function scopeKegiatan($query)
    {
        return $query->where('is_produk', false);
    }

    /**
     * Scope: terbaru.
     */
    public function scopeTerbaru($query)
    {
        return $query->latest();
    }

    // ========================================
    // ROUTE MODEL BINDING
    // ========================================

    /**
     * Pakai slug sebagai route key.
     */
    public function getRouteKeyName(): string
    {
        // return 'slug';
        return request()->is('admin/*') ? 'id' : 'slug';
    }
}
