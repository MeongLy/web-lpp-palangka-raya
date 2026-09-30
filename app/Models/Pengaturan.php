<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $fillable = [
        'key',
        'value',
        'group',
    ];

    /**
     * Ambil nilai berdasarkan key
     */
    public static function get($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Simpan / update nilai berdasarkan key
     */
    public static function set($key, $value, $group = 'umum')
    {
        return self::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );
    }

    /**
     * Ambil semua pengaturan berdasarkan group (return array)
     */
    public static function getGroup($group)
    {
        return self::where('group', $group)
            ->pluck('value', 'key')
            ->toArray();
    }
}
