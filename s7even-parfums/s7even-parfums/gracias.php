<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/productos.php';
require_once __DIR__ . '/includes/carrito.php';
require_once __DIR__ . '/includes/pedidos.php';

$base = '';
$page_title = 'Pedido recibido — S7even Parfums';

$numero = trim($_GET['pedido'] ?? '');
$pedido = $numero !== '' ? s7_pedido_buscar($numero) : null;

require __DIR__ . '/includes/header.php';
?>

<section class="gracias-page">
  <?php if ($pedido): ?>
    <p class="eyebrow center">Pedido confirmado</p>
    <h1 class="section-title center">Gracias, <?= htmlspecialchars(explode(' ', $pedido['cliente']['nombre'])[0]) ?>.</h1>
    <p class="section-sub center">Tu pedido <strong><?= htmlspecialchars($pedido['numero']) ?></strong> quedó registrado.</p>

    <div class="gracias-resumen">
      <ul class="checkout-lista">
        <?php foreach ($pedido['items'] as $item): ?>
          <li>
            <span><?= (int)$item['cantidad'] ?>&times; <?= htmlspecialchars($item['nombre']) ?></span>
            <span><?= s7_formato_precio($item['subtotal']) ?></span>
          </li>
        <?php endforeach; ?>
      </ul>
      <div class="checkout-total">
        <span>Total</span>
        <strong><?= s7_formato_precio($pedido['total']) ?></strong>
      </div>
    </div>

    <?php
      $mensaje = "Hola S7even Parfums, confirmo mi pedido {$pedido['numero']} por " . s7_formato_precio($pedido['total']) . ".";
      $whatsappUrl = 'https://wa.me/' . WHATSAPP_NUMERO . '?text=' . rawurlencode($mensaje);
    ?>
    <div class="gracias-acciones">
      <a href="<?= htmlspecialchars($whatsappUrl) ?>" class="btn btn--gold" target="_blank" rel="noopener">Confirmar por WhatsApp</a>
      <a href="tienda.php" class="btn btn--ghost">Seguir comprando</a>
    </div>

  <?php else: ?>
    <p class="eyebrow center">Ups</p>
    <h1 class="section-title center">No encontramos ese pedido.</h1>
    <div class="gracias-acciones">
      <a href="tienda.php" class="btn btn--gold">Volver a la tienda</a>
    </div>
  <?php endif; ?>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
