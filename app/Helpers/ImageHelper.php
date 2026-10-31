<?php

namespace App\Helpers;

class ImageHelper
{
    /**
     * Get the proper URL for an image path
     * Handles URLs, asset paths, and storage paths
     *
     * @param string|null $path
     * @param string|null $default
     * @return string
     */
    public static function url(?string $path, ?string $default = null): string
    {
        if (empty($path)) {
            return $default ? self::url($default) : '';
        }

        // Already a full URL
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        // Asset path (starts with /assets)
        if (str_starts_with($path, '/assets')) {
            return url($path);
        }

        // Already has /storage prefix
        if (str_starts_with($path, '/storage')) {
            return url($path);
        }

        // Uploads path (starts with /uploads)
        if (str_starts_with($path, '/uploads')) {
            return url($path);
        }

        // Storage path without prefix - add /storage/
        return url('/storage/' . $path);
    }
}

