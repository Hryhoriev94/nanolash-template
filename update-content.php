<?php

set_error_handler(function ($severity, $message, $file, $line) {
    throw new ErrorException($message, $severity, $severity, $file, $line);
});

$content = require 'content/content.php';
$images = require 'content/images.php';
$otputFolder = 'content/dist/';
$contentFolder = $otputFolder . 'content/';
$imagesFolder = $otputFolder . 'images/';
if (!file_exists($otputFolder )) {
    mkdir($otputFolder , 0777, true);
}
if(!file_exists($contentFolder )) {
    mkdir($contentFolder , 0777, true);
}
if(!file_exists($imagesFolder )) {
    mkdir($imagesFolder , 0777, true);
}

try {
    foreach ($content as $page => $pageContent) {
        if ($page === 'products') {
            foreach ($pageContent as $product => $productContent) {
                $contentFile = $contentFolder  . $product . '.json';
                file_put_contents($contentFile, json_encode($productContent));
            }
        } else {
            $contentFile = $contentFolder . $page . '.json';
            file_put_contents($contentFile, json_encode($pageContent));
        }
    }
    foreach ($images as $name => $imageData) {
        $contentFile = $imagesFolder . 'images-' . $name . '.json';
        file_put_contents($contentFile, json_encode($imageData));
    }

    echo "<p style='color: green'>Done</p>";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
