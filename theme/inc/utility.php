<?php

/**
 * get filemtime
 */
function get_filemtime($uri) {
    $path = untrailingslashit(ABSPATH) . wp_parse_url($uri, PHP_URL_PATH);
    return @filemtime($path);
}

/**
 * render blade template
 */
use Jenssegers\Blade\Blade;

function view($name, $data = []) {
    static $blade;
    if (!$blade) {
        $theme_dir = get_stylesheet_directory();
        $views = $theme_dir . '/views';
        $cache = $theme_dir . '/cache';
        $blade = new Blade($views, $cache);
    }

    echo $blade->make($name, $data);
}
