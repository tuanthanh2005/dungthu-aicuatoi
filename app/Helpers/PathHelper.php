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

        if (!$root || (!is_dir($root) && !is_dir(dirname($root)))) {
            $root = public_path();
        }

        $root = rtrim($root, DIRECTORY_SEPARATOR);

        if ($path === '') {
            return $root;
        }

        return $root . DIRECTORY_SEPARATOR . ltrim($path, "/\\");
    }
}
