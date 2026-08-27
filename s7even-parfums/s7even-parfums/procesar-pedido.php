<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/productos.php';
require_once __DIR__ . '/includes/carrito.php';
require_once __DIR__ . '/includes/pedidos.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: checkout.php');
    exit;
}

$items = s7_carrito_items();
if (empty($items)) {
    header('Location: tienda.php');
    exit;
}

// ---- Recoger y limpiar datos del formulario ----
$cliente = [
    'nombre'      => trim($_POST['nombre'] ?? ''),
    'telefono'    => trim($_POST['telefono'] ?? ''),
    'correo'      => trim($_POST['correo'] ?? ''),
    'direccion'   => trim($_POST['direccion'] ?? ''),
    'distrito'    => trim($_POST['distrito'] ?? ''),
    'metodo_pago' => trim($_POST['metodo_pago'] ?? ''),
    'notas'       => trim($_POST['notas'] ?? ''),
];

// ---- Validación server-side (nunca confiar solo en el HTML) ----
$errores = [];
if ($cliente['nombre'] === '')      $errores[] = 'Ingresa tu nombre completo.';
if ($cliente['telefono'] === '')    $errores[] = 'Ingresa tu número de celular.';
if ($cliente['direccion'] === '')   $errores[] = 'Ingresa tu dirección de envío.';
if ($cliente['distrito'] === '')    $errores[] = 'Ingresa tu distrito o ciudad.';
if ($cliente['metodo_pago'] === '') $errores[] = 'Selecciona un método de pago.';
if ($cliente['correo'] !== '' && !filter_var($cliente['correo'], FILTER_VALIDATE_EMAIL)) {
    $errores[] = 'El correo ingresado no es válido.';
}

if (!empty($errores)) {
    $_SESSION['checkout_errores'] = $errores;
    $_SESSION['checkout_valores'] = $cliente;
    header('Location: checkout.php');
    exit;
}

// ---- Guardar el pedido ----
$total  = s7_carrito_total();
$pedido = s7_pedido_crear($cliente, $items, $total);

// Vaciar el carrito solo después de guardar exitosamente
s7_carrito_vaciar();

header('Location: gracias.php?pedido=' . urlencode($pedido['numero']));
exit;
