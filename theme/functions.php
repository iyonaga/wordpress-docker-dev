<?php

require_once ABSPATH . '/vendor/autoload.php';

/**
 * Config
 */
define('THEME_URI', trailingslashit(get_template_directory_uri()));
define('IMG_URI', THEME_URI . 'assets/dist/img/');
define('CSS_URI', THEME_URI . 'assets/dist/css/');
define('JS_URI', THEME_URI . 'assets/dist/js/');

/**
 * include files
 */
$includeFiles = [
    'inc/utility.php',
    'inc/setup.php',
    'inc/cleanup.php',
    'inc/enqueue.php',
    'inc/extras.php',
    'inc/admin/main.php'
];

foreach ($includeFiles as $file) {
    if (!$filepath = locate_template($file)) {
        trigger_error(sprintf('%s not found', $filepath), E_USER_ERROR);
    }
    require_once $filepath;
}

unset($file, $filepath);
