<?php
/**
 * LukasTheme Functions
 */

function lukastheme_assets() {
    // 1. Ładujemy główny styl (style.css)
    wp_enqueue_style('lukas-style', get_stylesheet_uri());

    // 2. Ładujemy plik JS
    wp_enqueue_script(
        'lukas-main-js', 
        get_template_directory_uri() . '/js/main.js', 
        array(), 
        '1.0', 
        true 
    );
}
add_action('wp_enqueue_scripts', 'lukastheme_assets');

// Dodajemy wsparcie dla tytułów stron
add_theme_support('title-tag');