// ===== ANIMACIONES AL SCROLL =====
const observerOptions = {
  threshold: 0.1,
  rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.style.opacity = '1';
      entry.target.style.transform = 'translateY(0)';
      observer.unobserve(entry.target);
    }
  });
}, observerOptions);

document.querySelectorAll('.fade-in-up').forEach(el => {
  el.style.opacity = '0';
  el.style.transform = 'translateY(30px)';
  el.style.transition = 'opacity 0.8s ease-out, transform 0.8s ease-out';
  observer.observe(el);
});

// ===== CONTADOR DE ESTADÍSTICAS =====
function animateCounter(element, target, duration = 2000) {
  let current = 0;
  const increment = target / (duration / 16);
  
  const counter = setInterval(() => {
    current += increment;
    if (current >= target) {
      element.textContent = target + '+';
      clearInterval(counter);
    } else {
      element.textContent = Math.floor(current);
    }
  }, 16);
}

document.querySelectorAll('.stat-number').forEach(stat => {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const target = parseInt(entry.target.getAttribute('data-target'));
        animateCounter(entry.target, target);
        observer.unobserve(entry.target);
      }
    });
  });
  observer.observe(stat);
});

// ===== FILTROS DE PORTAFOLIO =====
document.querySelectorAll('.filter-btn').forEach(button => {
  button.addEventListener('click', () => {
    document.querySelectorAll('.filter-btn').forEach(btn => {
      btn.classList.remove('active');
    });
    
    button.classList.add('active');
    
    const filter = button.getAttribute('data-filter');
    const items = document.querySelectorAll('.portfolio-item');
    
    items.forEach(item => {
      const category = item.getAttribute('data-category');
      
      if (filter === 'all' || category === filter) {
        item.style.display = 'block';
        item.style.animation = 'fadeInUp 0.6s ease-out forwards';
      } else {
        item.style.display = 'none';
      }
    });
  });
});

// ===== SMOOTH SCROLL PARA LINKS INTERNOS =====
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    const href = this.getAttribute('href');
    if (href !== '#' && document.querySelector(href)) {
      e.preventDefault();
      document.querySelector(href).scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });
    }
  });
});

// ===== EFECTOS DE HOVER EN TARJETAS =====
document.querySelectorAll('.service-card, .team-member, .portfolio-item').forEach(card => {
  card.addEventListener('mouseenter', function() {
    this.style.transition = 'all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1)';
  });
});

// ===== NAVBAR ACTIVA AL SCROLL =====
window.addEventListener('scroll', () => {
  document.querySelectorAll('.nav-list a').forEach(link => {
    const section = document.querySelector(link.getAttribute('href'));
    if (section) {
      const rect = section.getBoundingClientRect();
      if (rect.top <= 100 && rect.bottom >= 100) {
        document.querySelectorAll('.nav-list a').forEach(a => a.style.color = 'var(--color-dark)');
        link.style.color = 'var(--color-primary)';
      }
    }
  });
});

// ===== MODAL DE PROYECTO + CARRUSEL =====
document.addEventListener('DOMContentLoaded', function () {
  const modal = document.getElementById('project-modal');
  if (!modal) return;

  const modalTitle = modal.querySelector('.project-modal__title');
  const modalTipo = modal.querySelector('.project-modal__tipo');
  const modalAnio = modal.querySelector('.project-modal__anio');
  const modalUbicacion = modal.querySelector('.project-modal__ubicacion');
  const modalCategoria = modal.querySelector('.project-modal__categoria');
  const modalDesc = modal.querySelector('.project-modal__descripcion');
  const closeBtn = modal.querySelector('.project-modal__close');
  const overlay = modal.querySelector('.project-modal__overlay');

  const track = modal.querySelector('.project-carousel__track');
  const dotsContainer = modal.querySelector('.project-carousel__dots');
  const prevBtn = modal.querySelector('.project-carousel__nav--prev');
  const nextBtn = modal.querySelector('.project-carousel__nav--next');

  let currentIndex = 0;
  let slides = [];
  let dots = [];

  function buildCarousel(images) {
    track.innerHTML = '';
    dotsContainer.innerHTML = '';
    slides = [];
    dots = [];
    currentIndex = 0;

    images.forEach((src, index) => {
      if (!src) return;
      const slide = document.createElement('div');
      slide.className = 'project-carousel__slide';
      const img = document.createElement('img');
      img.src = src;
      slide.appendChild(img);
      track.appendChild(slide);
      slides.push(slide);

      const dot = document.createElement('button');
      dot.type = 'button';
      dot.className = 'project-carousel__dot';
      dot.addEventListener('click', () => goToSlide(index));
      dotsContainer.appendChild(dot);
      dots.push(dot);
    });

    updateCarousel();
  }

  function updateCarousel() {
    if (!slides.length) return;
    track.style.transform = `translateX(-${currentIndex * 100}%)`;
    dots.forEach((dot, idx) => {
      dot.classList.toggle('project-carousel__dot--active', idx === currentIndex);
    });
  }

  function goToSlide(index) {
    if (!slides.length) return;
    if (index < 0) index = slides.length - 1;
    if (index >= slides.length) index = 0;
    currentIndex = index;
    updateCarousel();
  }

  function openProjectModal(button) {
    const images = [
      button.dataset.imagen || '',
      button.dataset.imagen1 || '',
      button.dataset.imagen2 || ''
    ].filter(Boolean);

    buildCarousel(images);

    modalTitle.textContent = button.dataset.title || '';
    modalTipo.textContent = button.dataset.tipo ? `Tipo: ${button.dataset.tipo}` : '';
    modalAnio.textContent = button.dataset.anio ? `Año: ${button.dataset.anio}` : '';
    modalUbicacion.textContent = button.dataset.ubicacion ? `Ubicación: ${button.dataset.ubicacion}` : '';
    modalCategoria.textContent = button.dataset.categoria ? `Categoría: ${button.dataset.categoria}` : '';
    modalDesc.textContent = button.dataset.descripcion || '';

    modal.classList.add('project-modal--active');
    document.body.style.overflow = 'hidden';
  }

  function closeProjectModal() {
    modal.classList.remove('project-modal--active');
    document.body.style.overflow = '';
  }

  document.querySelectorAll('.open-project-modal').forEach(btn => {
    btn.addEventListener('click', () => openProjectModal(btn));
  });

  prevBtn.addEventListener('click', () => goToSlide(currentIndex - 1));
  nextBtn.addEventListener('click', () => goToSlide(currentIndex + 1));

  closeBtn.addEventListener('click', closeProjectModal);
  overlay.addEventListener('click', closeProjectModal);

  document.addEventListener('keydown', e => {
    if (!modal.classList.contains('project-modal--active')) return;
    if (e.key === 'Escape') closeProjectModal();
    if (e.key === 'ArrowLeft') goToSlide(currentIndex - 1);
    if (e.key === 'ArrowRight') goToSlide(currentIndex + 1);
  });
});

// NAV RESPONSIVA (HAMBURGUESA)
document.addEventListener('DOMContentLoaded', function () {
  const toggle = document.querySelector('.nav-toggle');
  const navList = document.querySelector('.nav-list');
  if (!toggle || !navList) return;

  toggle.addEventListener('click', () => {
    navList.classList.toggle('nav-open');
  });

  navList.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
      navList.classList.remove('nav-open');
    });
  });
});
