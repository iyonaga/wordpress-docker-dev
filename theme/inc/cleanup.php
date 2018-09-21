<?php

/**
 * initialize the cleanup
 */
add_action('after_setup_theme', function () {
    // launching operation cleanup
    add_action('init', 'cleanup_head');

    // remove WP version from RSS
    add_filter('the_generator', 'remove_rss_version');

    // remove pesky injected css for recent comments widget
    add_filter('wp_head', 'remove_wp_widget_recent_comments_style', 1);

    // clean up comment styles in the head
    add_action('wp_head', 'remove_recent_comments_style', 1);

    // clean up gallery output in wp
    add_filter('gallery_style', 'gallery_style');
});

/**
 * head cleanup
 */
function cleanup_head () {
    // remove category feeds
    remove_action('wp_head', 'feed_links_extra', 3);

    // remove post and comment feeds
    remove_action('wp_head', 'feed_links', 2);

    // remove EditURI link
    remove_action('wp_head', 'rsd_link');

    // remove wlwmanifest (Windows Live Writer) link
    remove_action('wp_head', 'wlwmanifest_link');

    // remove previous link
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);

    // remove start link
    remove_action('wp_head', 'start_post_rel_link', 10, 0);

    // remove adjacent posts link
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

    // remove index link
    remove_action('wp_head', 'index_rel_link');

    // remove canonical link
    remove_action('wp_head', 'rel_canonical', 10, 0);

    // remove shortlink
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

    // remove WP version
    remove_action('wp_head', 'wp_generator');

    // remove WP version from css
    add_filter('style_loader_src', 'remove_wp_ver_strings', 9999);

    // remove WP version from script
    add_filter('script_loader_src', 'remove_wp_ver_strings', 9999);

    // remove property from linktag
    add_filter('style_loader_tag', 'remove_property_tag', 9999);

    // remove emoji code
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');

    // remove embed script(version4.4 or later)
    remove_action('wp_head','rest_output_link_wp_head');
    remove_action('wp_head','wp_oembed_add_discovery_links');
    remove_action('wp_head','wp_oembed_add_host_js');
}

/**
 * remove WP version from RSS
 */
function remove_rss_version() {
    return '';
}

/**
 * remove injected CSS for recent comments widget
 */
function remove_wp_widget_recent_comments_style() {
    if (has_filter('wp_head', 'wp_widget_recent_comments_style')) {
        remove_filter('wp_head', 'wp_widget_recent_comments_style');
    }
}

/**
 * remove injected CSS from recent comments widget
 */
function remove_recent_comments_style() {
    global $wp_widget_factory;
    if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
        remove_action(
            'wp_head',
            array(
                $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
                'recent_comments_style'
            )
        );
    }
}

/**
 * remove injected CSS from gallery
 */
function gallery_style($css) {
    return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}

/**
 * Remove WP Version Number
 */
function remove_wp_ver_strings($src) {
    if (strpos($src, 'ver='. get_bloginfo('version'))) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}

/**
 * remove property tag from 'link' tag
 */
function remove_property_tag($tag) {
    return preg_replace(
        array("| type='.+?'\s*|", "| id='.+?'\s*|", '| />|'),
        array(' ',' ', '>'),
        $tag
    );
}
