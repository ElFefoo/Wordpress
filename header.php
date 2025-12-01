<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplelightbox/2.14.1/simple-lightbox.min.css" />
</head>
<body <?php body_class(); ?>>
    <!-- HEADER -->
    <header>
      <nav class="navbar">
       <div class="logo">
  <a href="<?php echo home_url('/'); ?>">
    <img src="http://localhost/miweb/wp-content/uploads/2025/11/logo-asymmetric-1.png" alt="Asymmetric Logo">
    <span class="logo-text">ASYMMETRIC</span>
  </a>
</div>

			<button class="nav-toggle" aria-label="Abrir menú">
  ☰
</button>
        <button class="menu-toggle" id="menuToggle">
          <span></span>
          <span></span>
          <span></span>
        </button>
        <ul class="nav-list" id="navList">
          <li><a href="<?php echo esc_url(home_url('/')); ?>#servicios">Servicios</a></li>
          <li><a href="<?php echo esc_url(home_url('/')); ?>#portafolio">Portafolio</a></li>
          <li><a href="<?php echo esc_url(home_url('/')); ?>#contacto">Contacto</a></li>
          <li><a href="<?php echo esc_url( home_url('/') ); ?>#equipo" class="nav-btn">Equipo</a></li>

        </ul>
      </nav>
    </header>
