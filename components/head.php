<head>
    <script defer src=<?="/assets/scripts/dist/$template.js" ?>></script>
    <?= getPreloadImages(); ?> 

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <link rel="stylesheet" href=<?="/assets/styles/pages/$template.css" ?> media="print" onload="this.media='all'">
    <link rel="stylesheet" media="screen and (min-width: 768px)" href=<?="/assets/styles/pages/$template-desktop.css" ?> media="print" onload="this.media='all'">
    <title><?= $title ?></title>
    <meta name="description" content="<?= $description ?>">
</head>