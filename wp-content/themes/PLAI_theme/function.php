<?php

function montheme_supports() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
};
function montheme_register_assets() {
    wp_enqueue_style( 'montheme-css-principal', get_template_directory_uri() . '/public/style.css', [], '1.0');
    wp_enqueue_script( 'montheme-script-principal', get_template_directory_uri() . 'public/script.js', [], false, true);
};

function montheme_title_separator($separateur_original){
    return (' | ');
};

add_action('after_setup_theme', 'montheme_supports');
add_action('wp_enqueue_scripts', 'montheme_register_assets');
add_action('document_title_separator', 'montheme_title_separator');