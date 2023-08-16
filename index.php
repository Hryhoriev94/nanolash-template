<!DOCTYPE html>
<html lang="en">
<?php 
    $config = require 'config.php';
    require 'functions.php';
    
    $url = isset($_GET['url']) ? trim($_GET['url'], '/') : '/';
    
    if ($url == '') {
        $url = '/';
    }
    
    if (!array_key_exists($url, $config['routing'])) {
        $url = '404';
    }
    
    $templateName = $config['routing'][$url]['template'];
    $templateFile = $config['templates'][$templateName];
    require 'templates/' . $templateFile;
?>
</html>


