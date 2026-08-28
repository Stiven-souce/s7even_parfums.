<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/productos.php';
require_once __DIR__ . '/includes/carrito.php';

$base = '';
$page_title = 'S7even Parfums — El instinto, embotellado';
$mensaje = $_GET['agregado'] ?? null;

require __DIR__ . '/includes/header.php';
?>

<!-- ===== HERO ===== -->
<section class="hero" id="top">
  <div class="hero__coils" aria-hidden="true">
    <svg viewBox="0 0 1200 900" xmlns="http://www.w3.org/2000/svg" class="coil-svg">
      <path id="serpentPath" class="serpent-path" d="M -50 780 C 150 900, 250 650, 420 700 C 620 760, 560 480, 780 460 C 980 440, 900 220, 1080 160 C 1180 130, 1220 60, 1260 -20" />
    </svg>
  </div>

  <div class="hero__content">
    <p class="eyebrow">Colección de Autor — No. 07</p>
    <img src="assets/logo.png" alt="S7even Parfums" class="hero__logo">
    <h1 class="hero__title">El instinto,<br><em>embotellado.</em></h1>
    <p class="hero__sub">Siete esencias nacidas del pulso salvaje que vive bajo la piel. Perfumería de autor para quienes no piden permiso para ser recordados.</p>
    <div class="hero__actions">
      <a href="catalogo.php" class="btn btn--gold">Ver Catálogo</a>
      <a href="#manifiesto" class="btn btn--ghost">Nuestra historia</a>
    </div>
  </div>

  <div class="hero__scroll" aria-hidden="true">
    <span></span>
    <p>Desliza</p>
  </div>
</section>

<!-- ===== DIVIDER 1 : firma serpiente ===== -->
<div class="divider" aria-hidden="true">
  <svg viewBox="0 0 1000 60" class="divider-svg">
    <path class="divider-path" d="M0 30 C 150 0, 250 60, 400 30 C 500 10, 520 45, 620 30 C 750 10, 800 50, 1000 30" />
  </svg>
</div>

<!-- ===== MANIFIESTO ===== -->
<section class="manifiesto" id="manifiesto">
  <div class="manifiesto__grid">
    <div class="manifiesto__visual" aria-hidden="true">
      <div class="s7-mark">
        <svg viewBox="0 0 400 400" class="s7-svg">
          <path class="s7-line" d="M280 90
                   C 200 40, 100 70, 100 150
                   C 100 230, 220 220, 220 290
                   C 220 350, 130 370, 90 320" />
        </svg>
        <span class="s7-digit">7</span>
      </div>
    </div>

    <div class="manifiesto__text">
      <p class="eyebrow">Manifiesto</p>
      <h2>Elegancia con<br>colmillos.</h2>
      <p class="lead">S7even nace de una idea simple: el lujo verdadero no se comporta, se impone. Cada fragancia está construida como se mueve un felino en la oscuridad — con precisión, silencio y una certeza absoluta de su propio poder.</p>
      <div class="manifiesto__stats">
        <div class="stat">
          <span class="stat__num">VII</span>
          <span class="stat__label">Esencias fundadoras</span>
        </div>
        <div class="stat">
          <span class="stat__num">72h</span>
          <span class="stat__label">De permanencia en piel</span>
        </div>
        <div class="stat">
          <span class="stat__num">100%</span>
          <span class="stat__label">Extracto de perfumería</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== PIRÁMIDE OLFATIVA ===== -->
<section class="piramide" id="piramide">
  <p class="eyebrow center">La Anatomía del Aroma</p>
  <h2 class="section-title center">Tres instintos,<br>una sola criatura.</h2>

  <div class="piramide__grid">
    <article class="nota-card">
      <div class="nota-card__icon" aria-hidden="true">
        <svg viewBox="0 0 60 60"><path d="M30 5 L45 35 L30 55 L15 35 Z" /></svg>
      </div>
      <span class="nota-card__eyebrow">Salida — El acecho</span>
      <h3>Notas de Cabeza</h3>
      <p>Bergamota de Calabria, pimienta rosa y un chispazo de cardamomo verde. El primer instinto: atrae antes de que puedas nombrarlo.</p>
    </article>

    <article class="nota-card nota-card--elevated">
      <div class="nota-card__icon" aria-hidden="true">
        <svg viewBox="0 0 60 60"><path d="M30 5 L45 35 L30 55 L15 35 Z" /></svg>
      </div>
      <span class="nota-card__eyebrow">Corazón — La caza</span>
      <h3>Notas de Corazón</h3>
      <p>Iris siberiano, cuero curtido y flor de azahar nocturna. El carácter se revela: suave por fuera, indomable por dentro.</p>
    </article>

    <article class="nota-card">
      <div class="nota-card__icon" aria-hidden="true">
        <svg viewBox="0 0 60 60"><path d="M30 5 L45 35 L30 55 L15 35 Z" /></svg>
      </div>
      <span class="nota-card__eyebrow">Fondo — La huella</span>
      <h3>Notas de Fondo</h3>
      <p>Ámbar gris, oud de Assam y almizcle animal. Lo que queda en la piel de quien ya se fue. Memoria pura.</p>
    </article>
  </div>
</section>

<!-- ===== DIVIDER 2 ===== -->
<div class="divider divider--flip" aria-hidden="true">
  <svg viewBox="0 0 1000 60" class="divider-svg">
    <path class="divider-path" d="M0 30 C 150 0, 250 60, 400 30 C 500 10, 520 45, 620 30 C 750 10, 800 50, 1000 30" />
  </svg>
</div>

<!-- ===== COLECCIÓN CON CARRUSEL ANIMADO ===== -->
<section class="coleccion" id="coleccion">
  <p class="eyebrow center">La Colección</p>
  <h2 class="section-title center">Siete criaturas,<br>siete esencias.</h2>
  <p class="section-sub center">Cada fragancia lleva el nombre de un instinto. Elige el tuyo.</p>

  <?php if ($mensaje === '1'): ?>
    <p class="alerta alerta--exito" id="tienda-mensaje">Agregado al carrito. <a href="carrito.php">Ver carrito →</a></p>
  <?php endif; ?>

  <div class="slider-container">
    <button class="slider-btn prev-btn" id="prevBtn" aria-label="Anterior">❮</button>
    
    <div class="coleccion__track" id="sliderTrack">
      <?php foreach (s7_catalogo() as $p): ?>
        <article class="frasco-card slider-item">
          <div class="frasco-card__stage">
            <!-- Enlace en la imagen -->
            <a href="producto.php?id=<?= urlencode($p['id']) ?>">
              <?php if (!empty($p['imagen'])): ?>
                <img src="<?= htmlspecialchars($p['imagen']) ?>" alt="<?= htmlspecialchars($p['nombre']) ?>" class="prod-img-real">
              <?php else: ?>
                <div class="frasco <?= htmlspecialchars($p['clase'] ?? 'gold') ?>">
                  <div class="frasco__cap"></div>
                  <div class="frasco__neck"></div>
                  <div class="frasco__body"><span>S7</span></div>
                </div>
              <?php endif; ?>
            </a>
          </div>

          <span class="frasco-card__num"><?= htmlspecialchars($p['numero'] ?? 'TOP') ?></span>
          
          <!-- Enlace en el título -->
          <h3>
            <a href="producto.php?id=<?= urlencode($p['id']) ?>" style="color: inherit; text-decoration: none;">
              <?= htmlspecialchars($p['nombre']) ?>
            </a>
          </h3>

          <p class="frasco-card__notes"><?= htmlspecialchars($p['notas'] ?? $p['descripcion'] ?? '') ?></p>
          
          <div class="frasco-card__foot">
            <span class="price"><?= s7_formato_precio($p['precio']) ?></span>
            <form action="carrito-agregar.php" method="post">
              <input type="hidden" name="id" value="<?= htmlspecialchars($p['id']) ?>">
              <input type="hidden" name="cantidad" value="1">
              <input type="hidden" name="volver" value="index">
              <button type="submit" class="btn-mini">Agregar</button>
            </form>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <button class="slider-btn next-btn" id="nextBtn" aria-label="Siguiente">❯</button>
  </div>

  <div class="coleccion__more">
    <a href="catalogo.php" class="btn btn--outline">Ir a la tienda completa</a>
  </div>
</section>

<!-- ===== CITA / BANNER ===== -->
<section class="cita">
  <div class="cita__coil" aria-hidden="true">
    <svg viewBox="0 0 400 400"><path d="M340 60 C 260 20, 140 50, 140 140 C 140 230, 280 220, 280 300 C 280 360, 180 380, 130 330" /></svg>
  </div>
  <blockquote>
    "No diseñamos perfumes.<br>Domesticamos instintos."</blockquote>
  <p class="cita__firma">— Fundadora, S7even Parfums</p>
</section>

<!-- ===== CONTACTO ===== -->
<section class="contacto" id="contacto">
  <div class="contacto__grid">
    <div class="contacto__info">
      <p class="eyebrow">Encuéntranos</p>
      <h2>¿Listo para<br>tu instinto?</h2>
      <p class="lead">Escríbenos para pedidos, distribución al por mayor o una cita privada de olfateo en nuestro atelier.</p>
      <ul class="contacto__list">
        <li>
          <strong>WhatsApp</strong>
          <span>
            <a href="https://wa.me/51982424158" target="_blank" style="color: inherit; text-decoration: underline;">
              +51 982 424 158
            </a>
          </span>
        </li>
        <li><strong>Correo</strong><span><?= htmlspecialchars(CORREO_CONTACTO) ?></span></li>
        <li><strong>Atelier</strong><span>Morales, San Martín, Perú</span></li>
      </ul>
      <div class="contacto__social">
        <a href="#" aria-label="Instagram">IG</a>
        <a href="#" aria-label="TikTok">TT</a>
        <a href="#" aria-label="Facebook">FB</a>
      </div>
    </div>

    <!-- Formulario configurado para enviar a WhatsApp -->
    <form class="contacto__form" id="contactForm">
      <p class="eyebrow">Lista de acceso</p>
      <h3>Únete a la manada</h3>
      <p class="form-sub">Sé el primero en oler el lanzamiento No. VII. Sin spam, solo esencia.</p>

      <label>
        <span>Nombre</span>
        <input type="text" id="contactNombre" name="nombre" placeholder="Tu nombre" required>
      </label>
      <label>
        <span>Correo</span>
        <input type="email" id="contactCorreo" name="correo" placeholder="tucorreo@email.com" required>
      </label>
      <label>
        <span>Mensaje (opcional)</span>
        <textarea id="contactMensaje" name="mensaje" rows="3" placeholder="Cuéntanos qué instinto buscas..."></textarea>
      </label>
      <button type="submit" class="btn btn--gold btn--full">Enviar a WhatsApp</button>
      <p class="form-status" id="formStatus"></p>
    </form>
  </div>
</section>

<!-- ===== ESTILOS Y SCRIPTS DEL SLIDER ===== -->
<style>
.slider-container {
  position: relative;
  max-width: 1200px;
  margin: 40px auto;
  overflow: hidden;
  padding: 10px 45px;
}

.coleccion__track {
  display: flex;
  gap: 25px;
  transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
}

.slider-item {
  flex: 0 0 calc(33.333% - 17px);
  min-width: 280px;
}

.prod-img-real {
  max-height: 200px;
  width: auto;
  object-fit: contain;
  filter: drop-shadow(0 5px 15px rgba(0,0,0,0.7));
  transition: transform 0.3s ease;
  margin: 0 auto;
  display: block;
}

.frasco-card:hover .prod-img-real {
  transform: scale(1.08);
}

.slider-btn {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(18, 18, 18, 0.85);
  border: 1px solid #c5a059;
  color: #c5a059;
  width: 45px;
  height: 45px;
  border-radius: 50%;
  cursor: pointer;
  z-index: 10;
  font-size: 1.2rem;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
}

.slider-btn:hover {
  background: #c5a059;
  color: #000;
  box-shadow: 0 0 15px rgba(197, 160, 89, 0.5);
}

.prev-btn { left: 0; }
.next-btn { right: 0; }

@media (max-width: 900px) {
  .slider-item { flex: 0 0 calc(50% - 13px); }
}
@media (max-width: 600px) {
  .slider-item { flex: 0 0 100%; }
}
</style>

<script>
// Script de WhatsApp
document.getElementById('contactForm').addEventListener('submit', function(e) {
  e.preventDefault();
  
  const nombre = document.getElementById('contactNombre').value.trim();
  const correo = document.getElementById('contactCorreo').value.trim();
  const mensaje = document.getElementById('contactMensaje').value.trim();
  const numWa = "51982424158";

  let textoWA = `✨ *NUEVA CONSULTA - S7EVEN PARFUMS* ✨\n\n`;
  textoWA += `*Nombre:* ${nombre}\n`;
  textoWA += `*Correo:* ${correo}\n`;
  if (mensaje) {
    textoWA += `*Mensaje:* ${mensaje}\n`;
  }

  const url = `https://api.whatsapp.com/send?phone=${numWa}&text=${encodeURIComponent(textoWA)}`;
  window.open(url, '_blank');
});

// Script del Carrousel Automático
document.addEventListener("DOMContentLoaded", () => {
  const track = document.getElementById("sliderTrack");
  const nextBtn = document.getElementById("nextBtn");
  const prevBtn = document.getElementById("prevBtn");
  const items = document.querySelectorAll(".slider-item");
  
  if (!track || items.length === 0) return;

  let currentIndex = 0;
  let autoSlideTimer;

  function getVisibleItems() {
    if (window.innerWidth <= 600) return 1;
    if (window.innerWidth <= 900) return 2;
    return 3;
  }

  function updateSlider() {
    const visibleItems = getVisibleItems();
    const maxIndex = items.length - visibleItems;
    
    if (currentIndex > maxIndex) currentIndex = 0;
    if (currentIndex < 0) currentIndex = maxIndex < 0 ? 0 : maxIndex;

    const itemWidth = items[0].getBoundingClientRect().width + 25;
    track.style.transform = `translateX(-${currentIndex * itemWidth}px)`;
  }

  function nextSlide() {
    currentIndex++;
    updateSlider();
  }

  function prevSlide() {
    currentIndex--;
    updateSlider();
  }

  function startAutoSlide() {
    autoSlideTimer = setInterval(nextSlide, 3500);
  }

  function stopAutoSlide() {
    clearInterval(autoSlideTimer);
  }

  nextBtn.addEventListener("click", () => { stopAutoSlide(); nextSlide(); startAutoSlide(); });
  prevBtn.addEventListener("click", () => { stopAutoSlide(); prevSlide(); startAutoSlide(); });

  track.parentElement.addEventListener("mouseenter", stopAutoSlide);
  track.parentElement.addEventListener("mouseleave", startAutoSlide);

  window.addEventListener("resize", updateSlider);

  startAutoSlide();
});
</script>

<?php require __DIR__ . '/includes/footer.php'; ?>
