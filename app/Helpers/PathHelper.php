<?php

namespace App\Helpers;

class PathHelper
{
    /**
     * Get the absolute root path based on config('filesystems.disks.public_uploads.root').
     * Single source of truth for all public uploaded assets.
     */
    public static function publicRootPath(string $path = ''): string
    {
        $root = config('filesystems.disks.public_uploads.root');

        if (!$root || !is_dir($root)) {
            $root = public_path();
        }

        $root = rtrim($root, DIRECTORY_SEPARATOR);

        if ($path === '') {
            return $root;
        }

        $fullPath = $root . DIRECTORY_SEPARATOR . ltrim($path, "/\\");

        if (!file_exists($fullPath) && file_exists(public_path($path))) {
            return public_path($path);
        }

        return $fullPath;
    }

    /**
     * Get modification timestamp safely for asset cache busting.
     * Prevents stat failed 500 errors if file is missing.
     */
    public static function assetVersion(string $path): string
    {
        $fullPath = static::publicRootPath($path);
        if (file_exists($fullPath)) {
            return (string) filemtime($fullPath);
        }
        return '1.0';
    }
}
