<?php

if (!defined('ABSPATH')) {
    exit;
}

function srp_register_settings_menu() {
    add_options_page(
        'Smart Reading Progress',
        'Reading Progress',
        'manage_options',
        'smart-reading-progress',
        'srp_settings_page_html'
    );
}

add_action('admin_menu', 'srp_register_settings_menu');

function srp_settings_page_html() {
    ?>

    <div class="wrap">
        <h1>Smart Reading Progress Settings</h1>

        <form method="post" action="options.php">
            <?php
            settings_fields('srp_settings_group');
            do_settings_sections('smart-reading-progress');
            submit_button();
            ?>
        </form>
    </div>

    <?php
}

function srp_register_settings() {

    register_setting('srp_settings_group', 'srp_bar_color');

    add_settings_section(
        'srp_main_section',
        'Main Settings',
        null,
        'smart-reading-progress'
    );

    add_settings_field(
        'srp_bar_color',
        'Progress Bar Color',
        'srp_color_field_callback',
        'smart-reading-progress',
        'srp_main_section'
    );
}

add_action('admin_init', 'srp_register_settings');

function srp_color_field_callback() {

    $color = get_option('srp_bar_color', '#2563eb');

    echo '<input type="text" name="srp_bar_color" value="' . esc_attr($color) . '">';
}<?php

if (!defined('ABSPATH')) {
    exit;
}

function srp_register_settings_menu() {
    add_options_page(
        'Smart Reading Progress',
        'Reading Progress',
        'manage_options',
        'smart-reading-progress',
        'srp_settings_page_html'
    );
}

add_action('admin_menu', 'srp_register_settings_menu');

function srp_settings_page_html() {
    ?>

    <div class="wrap">
        <h1>Smart Reading Progress Settings</h1>

        <form method="post" action="options.php">
            <?php
            settings_fields('srp_settings_group');
            do_settings_sections('smart-reading-progress');
            submit_button();
            ?>
        </form>
    </div>

    <?php
}

function srp_register_settings() {

    register_setting('srp_settings_group', 'srp_bar_color');

    add_settings_section(
        'srp_main_section',
        'Main Settings',
        null,
        'smart-reading-progress'
    );

    add_settings_field(
        'srp_bar_color',
        'Progress Bar Color',
        'srp_color_field_callback',
        'smart-reading-progress',
        'srp_main_section'
    );
}

add_action('admin_init', 'srp_register_settings');

function srp_color_field_callback() {

    $color = get_option('srp_bar_color', '#2563eb');

    echo '<input type="text" name="srp_bar_color" value="' . esc_attr($color) . '">';
}