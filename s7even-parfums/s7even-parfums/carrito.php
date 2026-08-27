<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/productos.php';
require_once __DIR__ . '/includes/carrito.php';

$base = '';
$page_title = 'Tu carrito — S7even Parfums';
$items = s7_carrito_items();
$total = s7_carrito_total();

require __DIR__ . '/includes/header.php';
?>

<section class="carrito-page">
  <p class="eyebrow center">Tu selección</p>
  <h1 class="section-title center">Carrito</h1>

  <?php if (empty($items)): ?>
    <div class="carrito-vacio">
      <p>Tu carrito está vacío por ahora.</p>
      <a href="tienda.php" class="btn btn--gold">Ir a la tienda</a>
    </div>
  <?php else: ?>

    <div class="carrito-tabla-wrap">
      <table class="carrito-tabla">
        <thead>
          <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($items as $item): $p = $item['producto']; ?>
            <tr>
              <td data-label="Producto">
                <span class="carrito-tabla__nombre"><?= htmlspecialchars($p['nombre']) ?></span>
                <span class="carrito-tabla__notas"><?= htmlspecialchars($p['notas']) ?></span>
              </td>
              <td data-label="Precio"><?= s7_formato_precio($p['precio']) ?></td>
              <td data-label="Cantidad">
                <form action="carrito-actualizar.php" method="post" class="cantidad-form">
                  <input type="hidden" name="accion" value="actualizar">
                  <input type="hidden" name="id" value="<?= htmlspecialchars($p['id']) ?>">
                  <input type="number" name="cantidad" value="<?= (int)$item['cantidad'] ?>" min="1" max="<?= (int)$p['stock'] ?>">
                  <button type="submit" class="btn-mini">Actualizar</button>
                </form>
              </td>
              <td data-label="Subtotal"><?= s7_formato_precio($item['subtotal']) ?></td>
              <td data-label="">
                <form action="carrito-actualizar.php" method="post">
                  <input type="hidden" name="accion" value="quitar">
                  <input type="hidden" name="id" value="<?= htmlspecialchars($p['id']) ?>">
                  <button type="submit" class="carrito-quitar" aria-label="Quitar producto">&times;</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div class="carrito-resumen">
      <form action="carrito-actualizar.php" method="post">
        <input type="hidden" name="accion" value="vaciar">
        <button type="submit" class="btn-mini">Vaciar carrito</button>
      </form>

      <div class="carrito-total">
        <span>Total</span>
        <strong><?= s7_formato_precio($total) ?></strong>
      </div>

      <a href="checkout.php" class="btn btn--gold btn--full">Proceder al pedido</a>
    </div>

  <?php endif; ?>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
