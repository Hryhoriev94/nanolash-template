<head>    
<script defer src=<?="/assets/scripts/dist/$template.js" ?>></script>
    <link rel="preload" href=<?="/assets/styles/pages/$template.css" ?> as="style" media='all'>
    <link rel="preload" href=<?="/assets/styles/pages/$template-desktop.css" ?> as="style" media='screen and (min-width: 768px)'>
    <?= getPreloadImages(); ?> 
    <link rel="preload" href="/assets/fonts/roboto/roboto-100.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/assets/fonts/roboto/roboto-300.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/assets/fonts/roboto/roboto-400.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/assets/fonts/roboto/roboto-700.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/assets/fonts/roboto/roboto-900.woff2" as="font" type="font/woff2" crossorigin>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <style>
        <?php 
            $rootDir = $_SERVER['DOCUMENT_ROOT'];
            $fileName = "$template-critical.css";
            $filePath = "$rootDir/assets/styles/pages/$fileName";
            if (file_exists($filePath)) {
                $cssContent = file_get_contents($filePath);
                echo $cssContent;
            } else {
                echo "/* CSS file not found */";
            }
        ?>
    </style>


    <link rel="stylesheet" href=<?="/assets/styles/pages/$template.css" ?> as="style" media='all'>
    <link rel="stylesheet" href=<?="/assets/styles/pages/$template-desktop.css" ?> as="style" media='screen and (min-width: 768px)'>

    <title><?= $title ?></title>
    <meta name="description" content="<?= $description ?>">
</head>