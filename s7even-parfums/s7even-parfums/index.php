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
      <a href="tienda.php" class="btn btn--gold">Ver la colección</a>
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

<!-- ===== COLECCIÓN (destacados, con carrito real) ===== -->
<section class="coleccion" id="coleccion">
  <p class="eyebrow center">La Colección</p>
  <h2 class="section-title center">Siete criaturas,<br>siete esencias.</h2>
  <p class="section-sub center">Cada fragancia lleva el nombre de un instinto. Elige el tuyo.</p>

  <?php if ($mensaje === '1'): ?>
    <p class="alerta alerta--exito" id="tienda-mensaje">Agregado al carrito. <a href="carrito.php">Ver carrito →</a></p>
  <?php endif; ?>

  <div class="coleccion__grid">
    <?php foreach (s7_catalogo() as $p): ?>
      <article class="frasco-card">
        <div class="frasco-card__stage">
          <div class="frasco <?= htmlspecialchars($p['clase']) ?>">
            <div class="frasco__cap"></div>
            <div class="frasco__neck"></div>
            <div class="frasco__body"><span>S7</span></div>
          </div>
        </div>
        <span class="frasco-card__num"><?= htmlspecialchars($p['numero']) ?></span>
        <h3><?= htmlspecialchars($p['nombre']) ?></h3>
        <p class="frasco-card__notes"><?= htmlspecialchars($p['notas']) ?></p>
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

  <div class="coleccion__more">
    <a href="tienda.php" class="btn btn--outline">Ir a la tienda completa</a>
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
        <li><strong>WhatsApp</strong><span>+<?= htmlspecialchars(WHATSAPP_NUMERO) ?></span></li>
        <li><strong>Correo</strong><span><?= htmlspecialchars(CORREO_CONTACTO) ?></span></li>
        <li><strong>Atelier</strong><span>Morales, San Martín, Perú</span></li>
      </ul>
      <div class="contacto__social">
        <a href="#" aria-label="Instagram">IG</a>
        <a href="#" aria-label="TikTok">TT</a>
        <a href="#" aria-label="Facebook">FB</a>
      </div>
    </div>

    <form class="contacto__form" id="contactForm">
      <p class="eyebrow">Lista de acceso</p>
      <h3>Únete a la manada</h3>
      <p class="form-sub">Sé el primero en oler el lanzamiento No. VII. Sin spam, solo esencia.</p>

      <label>
        <span>Nombre</span>
        <input type="text" name="nombre" placeholder="Tu nombre" required>
      </label>
      <label>
        <span>Correo</span>
        <input type="email" name="correo" placeholder="tucorreo@email.com" required>
      </label>
      <label>
        <span>Mensaje (opcional)</span>
        <textarea name="mensaje" rows="3" placeholder="Cuéntanos qué instinto buscas..."></textarea>
      </label>
      <button type="submit" class="btn btn--gold btn--full">Enviar</button>
      <p class="form-status" id="formStatus"></p>
    </form>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
