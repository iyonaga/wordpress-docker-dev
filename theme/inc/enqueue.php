<?php

/**
 * enqueue styles and scripts
 */
add_action('wp_enqueue_scripts', function () {
    if (!is_admin()) {

        /* stylesheet
        ------------------------*/
        wp_register_style('main', CSS_URI . 'style.css', array(), get_filemtime(CSS_URI . 'style.css'));
        wp_enqueue_style('main');

        /* script
        ------------------------*/
        wp_deregister_script('jquery');
        wp_register_script('vendor', JS_URI . 'vendor.js', array(), get_filemtime(JS_URI . 'vendor.js'), true);
        wp_register_script('app', JS_URI . 'app.js', array('vendor'), get_filemtime(JS_URI . 'app.js'), true);
        wp_enqueue_script('app');
    }
}, 999);
