<?php
function lukastheme_assets() {
    // Ładujemy główny styl motywu
    wp_enqueue_style('main-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'lukastheme_assets');

// Dodajemy wsparcie dla tytułów stron (żeby nie wpisywać <title> ręcznie)
add_theme_support('title-tag');