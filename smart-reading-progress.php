<?php
/**
 * Plugin Name: Smart Reading Progress
 * Plugin URI: https://example.com
 * Description: Adds a reading progress bar and reading time estimate to posts.
 * Version: 1.0.0
 * Author: Your Name
 * License: GPL2
 */

if (!defined('ABSPATH')) {
    exit;
}

function srp_enqueue_assets() {
    wp_enqueue_style(
        'srp-style',
        plugin_dir_url(__FILE__) . 'assets/css/style.css'
    );

    wp_enqueue_script(
        'srp-script',
        plugin_dir_url(__FILE__) . 'assets/js/progress.js',
        array(),
        false,
        true
    );
}

add_action('wp_enqueue_scripts', 'srp_enqueue_assets');

function srp_render_progress_bar() {
    echo '<div id="srp-progress-bar"></div>';
}

add_action('wp_footer', 'srp_render_progress_bar');