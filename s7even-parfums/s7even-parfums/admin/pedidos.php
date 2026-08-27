<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/productos.php';
require_once __DIR__ . '/../includes/pedidos.php';

if (empty($_SESSION['admin_autenticado'])) {
    header('Location: login.php');
    exit;
}

// Actualizar estado de un pedido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['numero'], $_POST['estado'])) {
    s7_pedido_actualizar_estado($_POST['numero'], $_POST['estado']);
    header('Location: pedidos.php');
    exit;
}

$pedidos = array_reverse(s7_pedidos_leer()); // más recientes primero
$totalVentas = array_sum(array_column($pedidos, 'total'));

$base = '../';
$page_title = 'Pedidos — Panel S7even Parfums';
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($page_title) ?></title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body class="admin-body">

<div class="admin-topbar">
  <img src="../assets/logo.png" alt="S7even Parfums" class="admin-topbar__logo">
  <div class="admin-topbar__stats">
    <span><?= count($pedidos) ?> pedidos</span>
    <span><?= s7_formato_precio($totalVentas) ?> en total</span>
  </div>
  <a href="logout.php" class="btn-mini">Cerrar sesión</a>
</div>

<div class="admin-wrap">
  <h1>Pedidos recibidos</h1>

  <?php if (empty($pedidos)): ?>
    <p>Todavía no hay pedidos registrados.</p>
  <?php else: ?>
    <div class="admin-tabla-wrap">
      <table class="admin-tabla">
        <thead>
          <tr>
            <th>Pedido</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Contacto</th>
            <th>Productos</th>
            <th>Total</th>
            <th>Pago</th>
            <th>Estado</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pedidos as $p): ?>
            <tr>
              <td><?= htmlspecialchars($p['numero']) ?></td>
              <td><?= htmlspecialchars($p['fecha']) ?></td>
              <td>
                <?= htmlspecialchars($p['cliente']['nombre']) ?><br>
                <small><?= htmlspecialchars($p['cliente']['direccion']) ?>, <?= htmlspecialchars($p['cliente']['distrito']) ?></small>
              </td>
              <td>
                <?= htmlspecialchars($p['cliente']['telefono']) ?><br>
                <small><?= htmlspecialchars($p['cliente']['correo']) ?></small>
              </td>
              <td>
                <?php foreach ($p['items'] as $item): ?>
                  <div><?= (int)$item['cantidad'] ?>&times; <?= htmlspecialchars($item['nombre']) ?></div>
                <?php endforeach; ?>
              </td>
              <td><?= s7_formato_precio($p['total']) ?></td>
              <td><?= htmlspecialchars($p['cliente']['metodo_pago']) ?></td>
              <td>
                <form method="post" class="admin-estado-form">
                  <input type="hidden" name="numero" value="<?= htmlspecialchars($p['numero']) ?>">
                  <select name="estado" onchange="this.form.submit()" class="estado-<?= htmlspecialchars($p['estado']) ?>">
                    <option value="pendiente" <?= $p['estado']==='pendiente'?'selected':'' ?>>Pendiente</option>
                    <option value="pagado" <?= $p['estado']==='pagado'?'selected':'' ?>>Pagado</option>
                    <option value="enviado" <?= $p['estado']==='enviado'?'selected':'' ?>>Enviado</option>
                    <option value="cancelado" <?= $p['estado']==='cancelado'?'selected':'' ?>>Cancelado</option>
                  </select>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

</body>
</html>
