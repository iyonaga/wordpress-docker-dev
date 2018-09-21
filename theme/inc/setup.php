<?php

/**
 * theme supports
 */
add_action('after_setup_theme', function () {

    // add WP thumbnail support
	add_theme_support('post-thumbnails');

    // default thumbnail size
    // set_post_thumbnail_size(150, 150, true);
    // add_image_size('single-post', 700, 400, true);

    // enable support for title-tag
    add_theme_support('title-tag');

    // enable support for HTML5 markup.
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // add support for WP menus
    add_theme_support('menus');

    // enable support for post formats
    // add_theme_support('post-formats', array(
    //     'aside',             // title less blurb
    //     'gallery',           // gallery of images
    //     'link',              // quick link to other site
    //     'image',             // an image
    //     'quote',             // a quick quote
    //     'status',            // a Facebook like status update
    //     'video',             // video
    //     'audio',             // audio
    //     'chat'               // chat transcript
    // ));

    // remove admin bar css
    // add_theme_support('admin-bar', array('callback' => '__return_false'));
});
