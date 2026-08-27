<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/productos.php';
require_once __DIR__ . '/includes/carrito.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: carrito.php');
    exit;
}

$accion = $_POST['accion'] ?? '';
$id     = trim($_POST['id'] ?? '');

if ($accion === 'actualizar') {
    $cantidad = (int)($_POST['cantidad'] ?? 0);
    s7_carrito_actualizar($id, $cantidad);
} elseif ($accion === 'quitar') {
    s7_carrito_quitar($id);
} elseif ($accion === 'vaciar') {
    s7_carrito_vaciar();
}

header('Location: carrito.php');
exit;
