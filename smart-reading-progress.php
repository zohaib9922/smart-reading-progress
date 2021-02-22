<?php
/**
 * Plugin Name: Smart Reading Progress
 * Description: Adds a reading progress bar and reading time estimate to posts.
 * Version: 1.1.0
 * Author: Zohaib Hassan
 * License: GPL2
 */

if (!defined('ABSPATH')) {
    exit;
}

/*
|--------------------------------------------------------------------------
| Load Settings Page
|--------------------------------------------------------------------------
*/

require_once plugin_dir_path(__FILE__) . 'includes/settings-page.php';

/*
|--------------------------------------------------------------------------
| Enqueue Assets
|--------------------------------------------------------------------------
*/

function srp_enqueue_assets() {

    wp_enqueue_style(
        'srp-style',
        plugin_dir_url(__FILE__) . 'assets/css/style.css',
        array(),
        '1.1.0'
    );

    wp_enqueue_script(
        'srp-script',
        plugin_dir_url(__FILE__) . 'assets/js/progress.js',
        array(),
        '1.1.0',
        true
    );
}

add_action('wp_enqueue_scripts', 'srp_enqueue_assets');

/*
|--------------------------------------------------------------------------
| Render Progress Bar
|--------------------------------------------------------------------------
*/

function srp_render_progress_bar() {

    if (!is_single()) {
        return;
    }

    echo '<div id="srp-progress-bar"></div>';
}

add_action('wp_body_open', 'srp_render_progress_bar');

/*
|--------------------------------------------------------------------------
| Reading Time
|--------------------------------------------------------------------------
*/

function srp_add_reading_time($content) {

    if (!is_single()) {
        return $content;
    }

    $word_count = str_word_count(strip_tags($content));

    $reading_time = ceil($word_count / 200);

    $reading_html =
        '<p class="srp-reading-time">
            ⏱ Estimated Reading Time: ' .
            esc_html($reading_time) .
        ' min
        </p>';

    return $reading_html . $content;
}

add_filter('the_content', 'srp_add_reading_time');

/*
|--------------------------------------------------------------------------
| Dynamic Styles
|--------------------------------------------------------------------------
*/

function srp_custom_styles() {

    $color = get_option('srp_bar_color', '#2563eb');

    echo '<style>
        #srp-progress-bar {
            background: ' . esc_attr($color) . ';
        }
    </style>';
}

add_action('wp_head', 'srp_custom_styles');