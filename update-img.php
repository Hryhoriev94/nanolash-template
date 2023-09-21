<?php

$directory = new RecursiveDirectoryIterator('assets/img');
$iterator = new RecursiveIteratorIterator($directory);

// deleteExistingWebPImages($iterator);

// function deleteExistingWebPImages($iterator) {
//     foreach ($iterator as $fileInfo) {
//         if ($fileInfo->isFile() && $fileInfo->getExtension() === 'webp') {
//             unlink($fileInfo->getPathname());
//         }
//     }
// }

foreach ($iterator as $info) {
    if ($info->isFile() && in_array($info->getExtension(), ['jpg', 'png'])) {
        convertImageToWebP($info->getPathname());
    }
}

function convertImageToWebP($imagePath, $quality = 100) {
    $info = getimagesize($imagePath);
    try {
        if ($info['mime'] === 'image/jpeg') {
            $image = imagecreatefromjpeg($imagePath);
        } elseif ($info['mime'] === 'image/png') {
            $image = imagecreatefrompng($imagePath);
            $imageTrueColor = imagecreatetruecolor(imagesx($image), imagesy($image));
            imagealphablending($imageTrueColor, false);
            imagesavealpha($imageTrueColor, true);
            $transparent = imagecolorallocatealpha($imageTrueColor, 0, 0, 0, 127);
            imagefilledrectangle($imageTrueColor, 0, 0, imagesx($image), imagesy($image), $transparent);

            imagecopy($imageTrueColor, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
            imagedestroy($image);
            $image = $imageTrueColor;
        } else {
            return;
        }
        $outputPath = str_replace(['.jpg', '.png'], '.webp', $imagePath);
        imagewebp($image, $outputPath, $quality);
        imagedestroy($image);
    } catch (Exception $error) {
        var_dump($error);
    }
}

