<?php
get_header();
?>

<!-- HERO CON PARALLAX -->
<section class="hero" id="inicio">
  <div class="hero-background">
    <div class="animated-shape shape-1"></div>
    <div class="animated-shape shape-2"></div>
    <div class="animated-shape shape-3"></div>
  </div>
  <div class="hero-content fade-in">
    <h1 class="hero-title fade-in">ASYMMETRIC</h1>
    <h2 class="hero-subtitle fade-in-delay-1">Asesorías técnicas, proyectos comerciales y arquitectura</h2>
    <p class="hero-text fade-in-delay-2">Transformamos visiones en soluciones arquitectónicas con excelencia y rigor profesional</p>
    <div class="hero-cta fade-in-delay-3">
      <a href="#servicios" class="cta-button">Descubre Nuestros Servicios</a>
      <a href="#contacto" class="cta-secondary">Contáctanos</a>
    </div>
  </div>
</section>

<!-- SERVICIOS -->
<section id="servicios" class="servicios-section">
  <h2 class="section-title">Nuestros Servicios</h2>
  <div class="services-grid">
    <div class="service-card fade-in-up">
      <div class="service-icon">🏢</div>
      <h3>Asesorías Técnicas</h3>
      <p>Nos especializamos en evaluación técnica integral de proyectos inmobiliarios con máximo rigor</p>
      <a href="#contacto" class="service-link">Consultar →</a>
    </div>
    <div class="service-card fade-in-up">
      <div class="service-icon">🏪</div>
      <h3>Proyectos Comerciales</h3>
      <p>Transformamos espacios comerciales en soluciones funcionales, atractivas y rentables</p>
      <a href="#contacto" class="service-link">Consultar →</a>
    </div>
    <div class="service-card fade-in-up">
      <div class="service-icon">🏗️</div>
      <h3>Arquitectura</h3>
      <p>Diseño arquitectónico innovador orientado a calidad, sostenibilidad y excelencia</p>
      <a href="#contacto" class="service-link">Consultar →</a>
    </div>
  </div>
</section>

<!-- PORTAFOLIO CON FILTROS Y LIGHTBOX -->
<section id="portafolio" class="portafolio-section">
  <h2 class="section-title">Portafolio Destacado</h2>
  
  <div class="portfolio-filters fade-in">
    <button class="filter-btn active" data-filter="all">Todos</button>
    <button class="filter-btn" data-filter="comercial">Comercial</button>
    <button class="filter-btn" data-filter="residencial">Residencial</button>
    <button class="filter-btn" data-filter="industrial">Industrial</button>
  </div>

  <div class="portfolio-grid">
    <?php
    $portfolio_query = new WP_Query(array(
      'post_type' => 'portafolio',
      'posts_per_page' => -1
    ));

    if($portfolio_query->have_posts()):
      while($portfolio_query->have_posts()): $portfolio_query->the_post();
        
        // Obtener todos los campos ACF
        $image = get_field('imagen_destacada');
        $imagen_1 = get_field('imagen_1');
        $imagen_2 = get_field('imagen_2');
        $categoria = get_field('categoria') ? get_field('categoria') : 'Otro';
        $area = get_field('area') ? get_field('area') : '';
        $anio = get_field('ano') ? get_field('ano') : '';
        $ubicacion = get_field('ubicacion') ? get_field('ubicacion') : '';
        $tipo = get_field('tipo') ? get_field('tipo') : '';
        $desc = get_field('descripcion') ? get_field('descripcion') : '';
        
        // Generar slug para filtro basado en categoria
        $slug_tipo = 'all';
        if ($categoria) {
          $categoria_lower = strtolower(trim($categoria));
          if ($categoria_lower === 'comercial') {
            $slug_tipo = 'comercial';
          } elseif ($categoria_lower === 'residencial') {
            $slug_tipo = 'residencial';
          } elseif ($categoria_lower === 'industrial') {
            $slug_tipo = 'industrial';
          }
        }
    ?>
    
    <div class="portfolio-item fade-in-up" data-category="<?php echo esc_attr($slug_tipo); ?>">
      <div class="portfolio-image-wrapper">
        <?php if($image): ?>
          <img src="<?php echo esc_url($image['url']); ?>" alt="<?php the_title(); ?>" class="portfolio-image">
          <div class="portfolio-overlay">
            <div class="portfolio-info">
              <h3><?php the_title(); ?></h3>
              <p class="portfolio-category"><?php echo esc_html($tipo); ?></p>
              <button
                class="view-project open-project-modal"
                type="button"
                data-title="<?php echo esc_attr(get_the_title()); ?>"
                data-tipo="<?php echo esc_attr($tipo); ?>"
                data-anio="<?php echo esc_attr($anio); ?>"
                data-ubicacion="<?php echo esc_attr($ubicacion); ?>"
                data-categoria="<?php echo esc_attr($categoria); ?>"
                data-descripcion="<?php echo esc_attr($desc); ?>"
                data-imagen="<?php echo esc_url($image['url']); ?>"
                data-imagen1="<?php echo ($imagen_1 ? esc_url($imagen_1['url']) : ''); ?>"
                data-imagen2="<?php echo ($imagen_2 ? esc_url($imagen_2['url']) : ''); ?>"
              >
                Ver Proyecto →
              </button>
            </div>
          </div>
        <?php endif; ?>
      </div>
      <div class="portfolio-details">
        <h3><?php the_title(); ?></h3>
        <p><strong>Categoría:</strong> <?php echo esc_html($categoria); ?></p>
        <?php if($area): ?>
          <p><strong>Área:</strong> <?php echo esc_html($area); ?> m²</p>
        <?php endif; ?>
        <?php if($anio): ?>
          <p><strong>Año:</strong> <?php echo esc_html($anio); ?></p>
        <?php endif; ?>
        <?php if($ubicacion): ?>
          <p><strong>Ubicación:</strong> <?php echo esc_html($ubicacion); ?></p>
        <?php endif; ?>
      </div>
    </div>
    
    <?php
      endwhile;
      wp_reset_postdata();
    endif;
    ?>
  </div>
</section>

<!-- EQUIPO CON EFECTOS HOVER -->
<!-- EQUIPO CON EFECTOS HOVER -->
<section id="equipo" class="equipo-section">
  <h2 class="section-title">Nuestro Equipo</h2>
  <div class="team-grid">
    <?php
    $equipo_query = new WP_Query(array(
      'post_type' => 'equipo',
      'posts_per_page' => -1
    ));

    if($equipo_query->have_posts()):
      while($equipo_query->have_posts()): $equipo_query->the_post();
        
        $foto     = get_field('imagen_destacada');
        $cargo    = get_field('cargo') ? get_field('cargo') : '';
        $exp      = get_field('experiencia') ? get_field('experiencia') : '';
        $desc     = get_field('descripcion_breve') ? get_field('descripcion_breve') : '';
        $linkedin = get_field('linkedin_url') ? get_field('linkedin_url') : '';
        $email    = get_field('email_contacto') ? get_field('email_contacto') : '';
    ?>
    
    <div class="team-member fade-in-up">
      <div class="team-image-wrapper">
        <?php if ($foto): ?>
          <img src="<?php echo esc_url($foto['url']); ?>" alt="<?php the_title(); ?>" class="team-image">
        <?php else: ?>
          <img src="<?php echo get_template_directory_uri(); ?>/images/avatar-default.png" alt="<?php the_title(); ?>" class="team-image">
        <?php endif; ?>

        <div class="team-overlay">
          <div class="team-social">
            <?php if ($linkedin): ?>
              <a href="<?php echo esc_url($linkedin); ?>" class="social-link" title="LinkedIn" target="_blank" rel="noopener">in</a>
            <?php endif; ?>

            <?php if ($email): ?>
              <a href="mailto:<?php echo esc_attr($email); ?>" class="social-link" title="Email">✉</a>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <div class="team-info">
        <h4><?php the_title(); ?></h4>
        <?php if($cargo): ?>
          <p class="team-cargo"><?php echo esc_html($cargo); ?></p>
        <?php endif; ?>
        <?php if($exp): ?>
          <p class="team-exp"><em><?php echo esc_html($exp); ?> años de experiencia</em></p>
        <?php endif; ?>
        <?php if($desc): ?>
          <p class="team-desc"><?php echo esc_html($desc); ?></p>
        <?php endif; ?>
      </div>
    </div>
    
    <?php
      endwhile;
      wp_reset_postdata();
    endif;
    ?>
  </div>
</section>


<!-- CONTACTO -->
<section id="contacto" class="contacto-section">
  <h2 class="section-title">Contáctanos</h2>
  <div class="contact-wrapper fade-in">
    <?php echo do_shortcode('[contact-form-7 id="ID_AQUI" title="Contacto Home"]'); ?>
  </div>
</section>

<!-- MODAL FLOTANTE DE PROYECTO -->
<div id="project-modal" class="project-modal">
  <div class="project-modal__overlay"></div>
  <div class="project-modal__content">
    <button class="project-modal__close" aria-label="Cerrar proyecto">&times;</button>
    
    <div class="project-modal__image-wrapper">
      <div class="project-carousel">
        <button class="project-carousel__nav project-carousel__nav--prev" type="button" aria-label="Imagen anterior">‹</button>
        <div class="project-carousel__track"></div>
        <button class="project-carousel__nav project-carousel__nav--next" type="button" aria-label="Imagen siguiente">›</button>
      </div>
      <div class="project-carousel__dots"></div>
    </div>

    <div class="project-modal__info">
      <h3 class="project-modal__title"></h3>
      <p class="project-modal__meta project-modal__tipo"></p>
      <p class="project-modal__meta project-modal__anio"></p>
      <p class="project-modal__meta project-modal__ubicacion"></p>
      <p class="project-modal__meta project-modal__categoria"></p>
      <p class="project-modal__descripcion"></p>
    </div>
  </div>
</div>

<?php
get_footer();
?>
