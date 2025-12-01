<?php
// Enqueue estilos
function asymmetric_theme_styles() {
  wp_enqueue_style('asymmetric-style', get_stylesheet_uri());
  wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Segoe+UI:wght@300;400;500;600;700;800&display=swap');
}
add_action('wp_enqueue_scripts', 'asymmetric_theme_styles');

// Enqueue scripts
function asymmetric_theme_scripts() {
  wp_enqueue_script('asymmetric-main', get_template_directory_uri() . '/js/main.js', array(), '2.0', true);
}
add_action('wp_enqueue_scripts', 'asymmetric_theme_scripts');

// Agregar soporte para thumbnails
add_theme_support('post-thumbnails');

// Registrar custom post types
function register_custom_post_types() {
  // Portafolio
  register_post_type('portafolio', array(
    'labels' => array('name' => 'Portafolio'),
    'public' => true,
    'has_archive' => true,
    'supports' => array('title', 'editor', 'thumbnail')
  ));
  
  // Equipo
  register_post_type('equipo', array(
    'labels' => array('name' => 'Equipo'),
    'public' => true,
    'has_archive' => true,
    'supports' => array('title', 'editor', 'thumbnail')
  ));
}
add_action('init', 'register_custom_post_types');

// Optimizaciones
function asymmetric_theme_tweaks() {
  // Remover emojis
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('wp_print_styles', 'print_emoji_styles');
}
add_action('init', 'asymmetric_theme_tweaks');
?>
