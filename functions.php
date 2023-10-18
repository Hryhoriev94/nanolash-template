<?php

function getAlias($url = null, $routing = null) {
    if ($url === null) {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        if ($url == '') {
            $url = '/';
        }
    }

    if ($routing === null) {
        $routing = CONFIG['routing'];
    }

    if (array_key_exists($url, $routing)) {
        return $routing[$url]['alias'];
    } else {
        foreach ($routing as $route => $config) {
            if (isset($config['products'])) {
                $alias = getAlias($url, $config['products']);
                if ($alias !== null) {
                    return $alias;
                }
            }
        }
    }

    return null;
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
    $data =  preg_replace('/\s+/', ' ', $json);
    $data = json_decode($data, true);

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

function getRouteByAlias($alias, $routing = CONFIG['routing']) {
    foreach ($routing as $route => $info) {
        // Проверка алиаса для текущего маршрута
        if (isset($info['alias']) && $info['alias'] === $alias) {
            return "/" . $route;
        }
        
        // Проверка наличия вложенных продуктов
        if (isset($info['products'])) {
            foreach ($info['products'] as $productRoute => $productInfo) {
                if (isset($productInfo['alias']) && $productInfo['alias'] === $alias) {
                    return "/" . $productRoute;
                }
            }
        }
    }
    return false;
}

function findRoute($url, $routing) {
    foreach ($routing as $route => $info) {
        if ($url === $route) {
            return $info;
        }
        
        if (isset($info['products'])) {
            foreach ($info['products'] as $productRoute => $productInfo) {
                if ($url === $productRoute) {
                    return $productInfo;
                }
            }
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

function getCurrentMarkName() {
    if (isset($_SERVER['HTTP_HOST'])) {
        $host = $_SERVER['HTTP_HOST'];
        $hostParts = explode('.', $host);
        if (count($hostParts) > 1) {
            $domainName = $hostParts[count($hostParts) - 2];
            return $domainName;
        }
    }
}

function getMarkNameByUrl($url) {
    $parsedUrl = parse_url($url);
    if (isset($parsedUrl['host'])) {
        $host = $parsedUrl['host'];
        $hostParts = explode('.', $host);
        if (count($hostParts) > 1) {
            $domainName = $hostParts[count($hostParts) - 2];
            return $domainName;
        }
    }
}

function isCurrentMark($url) {
    return getCurrentMarkName() === getMarkNameByUrl($url) ? true : false;
}

function isCDN() {
    return CONFIG['cdn'];
}

function getImage($url) {
    return isCDN() ? CONFIG['cdn_url'] . $url : $url;
}

function getTypeByAlias($alias) {
    return CONFIG['products'][$alias]['type'];
}

