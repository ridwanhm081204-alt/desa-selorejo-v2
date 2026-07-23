<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KknSetting extends Model
{
    protected $table = 'kkn_settings';
    protected $fillable = ['key', 'value'];

    /**
     * Helper: ambil satu setting by key, decode JSON jika JSON valid
     */
    public static function get(string $key, $default = null)
    {
        $row = static::where('key', $key)->first();
        if (!$row) return $default;

        $decoded = json_decode($row->value, true);
        return (json_last_error() === JSON_ERROR_NONE) ? $decoded : $row->value;
    }

    /**
     * Helper: simpan satu setting by key
     */
    public static function set(string $key, $value): void
    {
        $encoded = is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : $value;
        static::updateOrCreate(['key' => $key], ['value' => $encoded]);
    }
}
