<?php

$directory = new RecursiveDirectoryIterator('assets/img');
$iterator = new RecursiveIteratorIterator($directory);

foreach ($iterator as $info) {
    if ($info->isFile() && in_array($info->getExtension(), ['jpg', 'png'])) {
        convertImageToWebP($info->getPathname());
    }
}

function convertImageToWebP($imagePath, $quality = 80) {
    $info = getimagesize($imagePath);

    if ($info['mime'] === 'image/jpeg') {
        $image = imagecreatefromjpeg($imagePath);
    } elseif ($info['mime'] === 'image/png') {
        $image = imagecreatefrompng($imagePath);
    } else {
        return;
    }

    $outputPath = str_replace(['.jpg', '.png'], '.webp', $imagePath);
    imagewebp($image, $outputPath, $quality);
    imagedestroy($image);
}