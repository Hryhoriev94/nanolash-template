<?php

function getAlias() { 
    $url = trim($_SERVER['REQUEST_URI'], '/');
    if ($url == '') {
        $url = '/';
    }
    if (!array_key_exists($url, CONFIG['routing'])) {
        return null;
    }
    return CONFIG['routing'][$url]['alias'];
}

function getTemplate() {
    $url = trim($_SERVER['REQUEST_URI'], '/');
    if ($url == '') {
        $url = '/';
    }
    if (!array_key_exists($url, CONFIG['routing'])) {
        return null;
    }
    return CONFIG['routing'][$url]['template'];
}

function getComponent(string $componentName, $args = null) {
    
    if (is_array($args)) {
        extract($args);
    }

    return include __DIR__ . "/components/$componentName" . '.php';
}

function getContent($alias) {
    $filename = "content/dist/content/$alias.json";
    if (!file_exists($filename)) {
        return null;
    }

    $json = file_get_contents($filename);
    $data = json_decode($json, true);

    return $data;
}

function getImages($key) {
    $filename = "content/dist/images/images-$key.json";
    if (!file_exists($filename)) {
        return null;
    }

    $json = file_get_contents($filename);
    $data = json_decode($json, true);

    return $data;
}

function getRouteByAlias($alias, $routing) {
    foreach ($routing as $route => $info) {
        if (isset($info['alias']) && $info['alias'] === $alias) {
            return "/" . $route;
        }
    }
    return false;
}

function getFullPath($path, $extension = false) {

    if($extension) {
        $path .= ".$extension";
    }

    if(isset(CONFIG['cdn']) && CONFIG['cdn']) {
        return CONFIG['cdn'] . $path . '?ver=' . @filemtime(dirname(__FILE__) . $path);
    } else {
        return 'https://' . $_SERVER['HTTP_HOST'] . $path . '?ver=' . @filemtime(dirname(__FILE__) . $path);
    }
}

function getPreloadImages() {
    $alias = getAlias();
    $images = getImages($alias);
    
    if (!isset($images['critical']) || empty($images['critical'])) {
        return '<!-- None critical images-->';
    }
    $criticalImages = $images['critical'];
    
    return $criticalImages;
}



