<?php

namespace App\Http\Controllers;

class AssetController extends Controller
{
    private function serveFrom(string $base, string $path)
    {
        $baseReal = realpath($base);
        if ($baseReal === false) {
            abort(404);
        }
        $file = realpath($baseReal . DIRECTORY_SEPARATOR . $path);
        if (!$file || strpos($file, $baseReal) !== 0 || !is_file($file)) {
            abort(404);
        }

        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        $mime = $this->mimeFor($ext);

        return response()->file($file, [
            'Content-Type' => $mime,
            'Cache-Control' => 'public, max-age=31536000',
        ]);
    }

    private function mimeFor(string $ext): string
    {
        return match ($ext) {
            'css' => 'text/css',
            'js' => 'application/javascript',
            'png' => 'image/png',
            'jpg', 'jpeg' => 'image/jpeg',
            'svg' => 'image/svg+xml',
            'gif' => 'image/gif',
            'woff' => 'font/woff',
            'woff2' => 'font/woff2',
            'ttf' => 'font/ttf',
            'eot' => 'application/vnd.ms-fontobject',
            'otf' => 'font/otf',
            default => 'application/octet-stream',
        };
    }

    public function css(string $path)
    {
        return $this->serveFrom(resource_path('css'), $path);
    }

    public function js(string $path)
    {
        return $this->serveFrom(resource_path('js'), $path);
    }

    public function img(string $path)
    {
        return $this->serveFrom(resource_path('img'), $path);
    }

    public function fonts(string $path)
    {
        return $this->serveFrom(resource_path('fonts'), $path);
    }
}

