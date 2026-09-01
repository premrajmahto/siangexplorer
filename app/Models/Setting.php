<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value', 'group'];

    public static function get(string $key, $default = null)
    {
        if ($default === null) {
            if ($key === 'contact_email') $default = 'amritamaharaj93@gmail.com';
            if ($key === 'site_logo') $default = '/images/logo.png';
        }

        try {
            return Cache::remember("setting_{$key}", 3600, function () use ($key, $default) {
                $setting = static::where('key', $key)->first();
                return ($setting && !empty($setting->value)) ? $setting->value : $default;
            });
        } catch (\Throwable $e) {
            return $default;
        }
    }

    public static function set(string $key, $value, string $group = 'general'): self
    {
        $setting = static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );

        Cache::forget("setting_{$key}");

        return $setting;
    }
}
