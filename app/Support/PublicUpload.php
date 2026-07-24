<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;

class PublicUpload
{
    public static function store(UploadedFile $file, string $directory): string
    {
        $safeDirectory = self::normalizeDirectory($directory);
        $destination = public_path('upload/' . $safeDirectory);

        if (! is_dir($destination)) {
            mkdir($destination, 0755, true);
        }

        $filename = $file->hashName();
        $file->move($destination, $filename);

        return 'upload/' . $safeDirectory . '/' . $filename;
    }

    public static function delete(?string $path): void
    {
        if (! $path) {
            return;
        }

        $safePath = self::normalizeDirectory($path);
        $fullPath = public_path($safePath);

        if (is_file($fullPath)) {
            unlink($fullPath);
        }
    }

    protected static function normalizeDirectory(string $directory): string
    {
        $trimmedDirectory = trim($directory, '/');

        if ($trimmedDirectory === '') {
            return 'uploads';
        }

        $segments = preg_split('#[\\/]+#', $trimmedDirectory);
        $safeSegments = [];

        foreach ($segments ?: [] as $segment) {
            $segment = trim($segment);

            if ($segment === '' || $segment === '.' || $segment === '..') {
                continue;
            }

            $safeSegments[] = $segment;
        }

        if ($safeSegments === []) {
            return 'uploads';
        }

        return implode('/', $safeSegments);
    }
}
