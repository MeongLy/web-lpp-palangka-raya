<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Pengumuman extends Model
{
  use SoftDeletes;

  protected $table = 'pengumumans';

  protected $fillable = [
    'judul',
    'slug',
    'isi',
    'gambar',
    'link',
    'link_label',
    'tipe',
    'prioritas',
    'mulai_tayang',
    'selesai_tayang',
    'is_active',
  ];

  protected $casts = [
    'is_active'      => 'boolean',
    'prioritas'      => 'integer',
    'mulai_tayang'   => 'datetime',
    'selesai_tayang' => 'datetime',
  ];

  // ========================================
  // BOOT — Auto-slug
  // ========================================
  protected static function booted(): void
  {
    static::creating(function ($model) {
      if (empty($model->slug)) {
        $model->slug = static::generateUniqueSlug($model->judul);
      }
    });

    static::updating(function ($model) {
      if ($model->isDirty('judul') && empty($model->slug)) {
        $model->slug = static::generateUniqueSlug($model->judul, $model->id);
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
   * Scope: yang sedang dalam masa tayang.
   */
  public function scopeTayang($query)
  {
    $now = now();

    return $query->where(function ($q) use ($now) {
      // Belum ada jadwal mulai → tayang
      $q->whereNull('mulai_tayang')
        ->orWhere('mulai_tayang', '<=', $now);
    })->where(function ($q) use ($now) {
      // Belum ada jadwal selesai → tayang
      $q->whereNull('selesai_tayang')
        ->orWhere('selesai_tayang', '>=', $now);
    });
  }

  /**
   * Scope: untuk popup.
   */
  public function scopePopup($query)
  {
    return $query->whereIn('tipe', ['popup', 'keduanya']);
  }

  /**
   * Scope: urutkan prioritas tertinggi dulu.
   */
  public function scopePrioritas($query)
  {
    return $query->orderBy('prioritas', 'desc')->latest();
  }

  /**
   * Scope: siap tayang (aktif + dalam jadwal + popup).
   */
  public function scopeSiapTayang($query)
  {
    return $query->active()->tayang()->popup()->prioritas();
  }

    // ========================================
    // ACCESSOR
    // ========================================

  /**
   * Cek apakah pengumuman masih dalam masa tayang.
   */
  public function getIsTayangAttribute(): bool
  {
    $now = now();

    if ($this->mulai_tayang && $now->lessThan($this->mulai_tayang)) {
      return false;
    }

    if ($this->selesai_tayang && $now->greaterThan($this->selesai_tayang)) {
      return false;
    }

    return true;
  }

  /**
   * Status label untuk admin.
   */
  public function getStatusLabelAttribute(): string
  {
    if (!$this->is_active) {
      return 'Nonaktif';
    }

    if (!$this->is_tayang) {
      return 'Terjadwal / Kadaluarsa';
    }

    return 'Tayang';
  }
}
