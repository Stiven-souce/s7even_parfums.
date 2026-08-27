<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/productos.php';
require_once __DIR__ . '/includes/carrito.php';

$base = '';
$page_title = 'Finalizar pedido — S7even Parfums';
$items = s7_carrito_items();
$total = s7_carrito_total();

if (empty($items)) {
    header('Location: tienda.php');
    exit;
}

$errores = $_SESSION['checkout_errores'] ?? [];
$valores = $_SESSION['checkout_valores'] ?? [];
unset($_SESSION['checkout_errores'], $_SESSION['checkout_valores']);

require __DIR__ . '/includes/header.php';
?>

<section class="checkout-page">
  <p class="eyebrow center">Último paso</p>
  <h1 class="section-title center">Confirma tu pedido</h1>

  <div class="checkout-grid">

    <div class="checkout-resumen">
      <h3>Resumen</h3>
      <ul class="checkout-lista">
        <?php foreach ($items as $item): $p = $item['producto']; ?>
          <li>
            <span><?= (int)$item['cantidad'] ?>&times; <?= htmlspecialchars($p['nombre']) ?></span>
            <span><?= s7_formato_precio($item['subtotal']) ?></span>
          </li>
        <?php endforeach; ?>
      </ul>
      <div class="checkout-total">
        <span>Total a pagar</span>
        <strong><?= s7_formato_precio($total) ?></strong>
      </div>

      <div class="checkout-info-pago">
        <p class="eyebrow">Métodos de pago</p>
        <p>Yape / Plin: <strong><?= htmlspecialchars(YAPE_PLIN_NUMERO) ?></strong></p>
        <p><?= htmlspecialchars(CUENTA_BANCARIA) ?></p>
        <p class="checkout-info-pago__nota">Confirmamos tu pedido por WhatsApp apenas lo recibamos.</p>
      </div>
    </div>

    <form action="procesar-pedido.php" method="post" class="checkout-form">
      <p class="eyebrow">Tus datos</p>

      <?php if (!empty($errores)): ?>
        <div class="alerta alerta--error">
          <?php foreach ($errores as $e): ?><p><?= htmlspecialchars($e) ?></p><?php endforeach; ?>
        </div>
      <?php endif; ?>

      <label>
        <span>Nombre completo *</span>
        <input type="text" name="nombre" required value="<?= htmlspecialchars($valores['nombre'] ?? '') ?>">
      </label>

      <label>
        <span>Celular / WhatsApp *</span>
        <input type="tel" name="telefono" required value="<?= htmlspecialchars($valores['telefono'] ?? '') ?>">
      </label>

      <label>
        <span>Correo</span>
        <input type="email" name="correo" value="<?= htmlspecialchars($valores['correo'] ?? '') ?>">
      </label>

      <label>
        <span>Dirección de envío *</span>
        <input type="text" name="direccion" required value="<?= htmlspecialchars($valores['direccion'] ?? '') ?>">
      </label>

      <label>
        <span>Distrito / Ciudad *</span>
        <input type="text" name="distrito" required value="<?= htmlspecialchars($valores['distrito'] ?? '') ?>">
      </label>

      <label>
        <span>Método de pago *</span>
        <select name="metodo_pago" required>
          <option value="">Selecciona una opción</option>
          <option value="Yape/Plin">Yape / Plin</option>
          <option value="Transferencia">Transferencia bancaria</option>
          <option value="Contraentrega">Pago contraentrega</option>
        </select>
      </label>

      <label>
        <span>Notas del pedido (opcional)</span>
        <textarea name="notas" rows="3" placeholder="Referencia de dirección, horario de entrega, etc."><?= htmlspecialchars($valores['notas'] ?? '') ?></textarea>
      </label>

      <button type="submit" class="btn btn--gold btn--full">Confirmar pedido</button>
      <p class="checkout-legal">Al confirmar aceptas que este es un pedido de reserva; el pago se coordina por el método elegido y se valida por WhatsApp.</p>
    </form>

  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
