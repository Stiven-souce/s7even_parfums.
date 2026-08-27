<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/productos.php';
require_once __DIR__ . '/includes/carrito.php';

$base = '';
$page_title = 'Tienda — S7even Parfums';
$mensaje = $_GET['agregado'] ?? null;

require __DIR__ . '/includes/header.php';
?>

<section class="tienda-hero">
  <p class="eyebrow center">La Colección Completa</p>
  <h1 class="section-title center">Siete criaturas,<br>siete esencias.</h1>
  <p class="section-sub center">Elige tu instinto. Envíos a todo el Perú.</p>
</section>

<?php if ($mensaje): ?>
  <div class="alerta alerta--exito">
    Agregado al carrito. <a href="carrito.php">Ver carrito →</a>
  </div>
<?php endif; ?>

<section class="coleccion coleccion--tienda">
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
        </div>

        <form action="carrito-agregar.php" method="post" class="frasco-card__form">
          <input type="hidden" name="id" value="<?= htmlspecialchars($p['id']) ?>">
          <input type="hidden" name="volver" value="tienda">
          <input type="number" name="cantidad" value="1" min="1" max="<?= (int)$p['stock'] ?>" aria-label="Cantidad">
          <button type="submit" class="btn btn--outline btn--full">Agregar al carrito</button>
        </form>
      </article>
    <?php endforeach; ?>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
