<?php

/**
 * get filemtime
 */
function get_filemtime($uri) {
    $path = untrailingslashit(ABSPATH) . wp_parse_url($uri, PHP_URL_PATH);
    return @filemtime($path);
}
