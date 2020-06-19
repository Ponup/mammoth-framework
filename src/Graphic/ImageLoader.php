<?php

declare(strict_types=1);

namespace Mammoth\Graphic;

class ImageLoader
{

    public function load(string $path, ?int &$width, ?int &$height): array
    {
        if (!file_exists($path)) {
            throw new \Exception('File not found: ' . $path);
        }

        $extension = pathinfo($path, PATHINFO_EXTENSION);
        if (in_array($extension, ['jpg', 'jpeg'])) {
            $img = imagecreatefromjpeg($path);
        } elseif ('png' == $extension) {
            $img = imagecreatefrompng($path);
        } else {
            throw new \Exception('Unsupported extension: ' . $extension);
        }

        $pixels = [];

        $width = imagesx($img);
        $height = imagesy($img);
        for ($h = 0; $h < $height; $h++) {
            for ($w = 0; $w < $width; $w++) {
                $pixels[] = imagecolorat($img, $w, $h);
            }
        }
        return $pixels;
    }
}
