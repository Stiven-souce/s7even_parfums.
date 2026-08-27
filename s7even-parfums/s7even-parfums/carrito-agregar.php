<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/productos.php';
require_once __DIR__ . '/includes/carrito.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: tienda.php');
    exit;
}

$id       = trim($_POST['id'] ?? '');
$cantidad = max(1, (int)($_POST['cantidad'] ?? 1));
$volver   = $_POST['volver'] ?? 'tienda';

$ok = s7_carrito_agregar($id, $cantidad);

$destino = $volver === 'index' ? 'index.php' : 'tienda.php';
header('Location: ' . $destino . ($ok ? '?agregado=1' : '?agregado=0') . '#tienda-mensaje');
exit;
