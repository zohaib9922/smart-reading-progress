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

function srp_add_reading_time($content) {

    if (!is_single()) {
        return $content;
    }

    $word_count = str_word_count(strip_tags($content));

    $reading_time = ceil($word_count / 200);

    $reading_html = '<p class="srp-reading-time">⏱ Estimated Reading Time: ' . $reading_time . ' min</p>';

    return $reading_html . $content;
}

add_filter('the_content', 'srp_add_reading_time');

require_once plugin_dir_path(__FILE__) . 'includes/settings-page.php';

function srp_custom_styles() {

    $color = get_option('srp_bar_color', '#2563eb');

    echo '<style>
        #srp-progress-bar {
            background:' . esc_attr($color) . ';
        }
    </style>';
}

add_action('wp_head', 'srp_custom_styles');