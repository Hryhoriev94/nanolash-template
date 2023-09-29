<?php
$config = require 'config.php';
define('CONFIG', $config);
$dev_mode = $config['dev_mode'];
require 'functions.php';

$cacheFile = 'cache/' . md5($_SERVER['REQUEST_URI']) . '.html';
$cacheTime = 1800; 

if (file_exists($cacheFile) && time() - $cacheTime < filemtime($cacheFile) && !$dev_mode) {
    header("Cache-Control: private, max-age=3600, pre-check=3600");
    header("Pragma: private");
    header("Expires: " . date(DATE_RFC822, strtotime("1 hour")));
    readfile($cacheFile);
    exit;
}

ob_start(); 
if(!$dev_mode) {
    header("Cache-Control: private, max-age=3600, pre-check=3600");
    header("Pragma: private");
    header("Expires: " . date(DATE_RFC822, strtotime("1 hour")));
}
?>

<!DOCTYPE html>
<html lang="en">
<?php 

    
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
<?php
if(!$dev_mode) {

if (!file_exists('cache')) {
    mkdir('cache', 0755, true);
}
file_put_contents($cacheFile, ob_get_contents());
}

ob_end_flush();
?>





