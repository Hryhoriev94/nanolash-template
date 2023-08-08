<?php

function getAlias() {
    
    $config = require 'config.php';
    $url = trim($_SERVER['REQUEST_URI'], '/');
    if ($url == '') {
        $url = '/';
    }
    if (!array_key_exists($url, $config['routing'])) {
        return null;
    }
    return $config['routing'][$url]['alias'];
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
            return $route;
        }
    }
    return false;
}