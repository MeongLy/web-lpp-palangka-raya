<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $fillable = [
        'judul',
        'slug',
        'gambar',       // Gambar utama (backward compatibility)
        'gambars',      // Multiple gambar (JSON)
        'deskripsi',
        'isi',
        'tanggal',
        'is_published',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'is_published' => 'boolean',
        'gambars' => 'array',  // ← Cast JSON ke array
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('tanggal', 'desc');
    }

    /**
     * Ambil semua gambar (dari gambars atau fallback ke gambar)
     */
    public function getAllGambarsAttribute()
    {
        if ($this->gambars && is_array($this->gambars) && count($this->gambars) > 0) {
            return $this->gambars;
        }
        return $this->gambar ? [$this->gambar] : [];
    }

    /**
     * Ambil gambar utama (gambar pertama)
     */
    public function getGambarUtamaAttribute()
    {
        $gambars = $this->getAllGambarsAttribute();
        return count($gambars) > 0 ? $gambars[0] : null;
    }
}
