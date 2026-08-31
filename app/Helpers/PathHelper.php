<?php

namespace App\Helpers;

class PathHelper
{
    public static function publicRootPath(string $path = ''): string
    {
        $cleanPath = ltrim($path, "/\\");

        // 1. Check if public_path() has the file
        if ($cleanPath !== '' && file_exists(public_path($cleanPath))) {
            return public_path($cleanPath);
        }

        // 2. Check preferred / public_html
        $preferred = config('filesystems.disks.public_uploads.root') ?: base_path('../public_html');
        if (is_dir($preferred)) {
            $candidate = rtrim($preferred, DIRECTORY_SEPARATOR) . ($cleanPath !== '' ? DIRECTORY_SEPARATOR . $cleanPath : '');
            if ($cleanPath === '' || file_exists($candidate)) {
                return $candidate;
            }
        }

        // Default to public_path
        return $cleanPath !== '' ? public_path($cleanPath) : public_path();
    }
}
