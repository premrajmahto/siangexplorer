<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService
{
    public static function upload(UploadedFile $file, string $folder = 'uploads'): string
    {
        $name = Str::random(20) . '.' . $file->getClientOriginalExtension();
        return $file->storeAs($folder, $name, 'public');
    }

    public static function uploadMultiple(array $files, string $folder = 'uploads'): array
    {
        $paths = [];
        foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                $paths[] = static::upload($file, $folder);
            }
        }
        return $paths;
    }

    public static function delete(?string $path): bool
    {
        if ($path && Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }
        return false;
    }
}
