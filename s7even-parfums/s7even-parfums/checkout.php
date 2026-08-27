<?php
$page_title = 'Iniciar Sesión - S7even Parfums';
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/productos.php';
require_once __DIR__ . '/includes/carrito.php';

$redirect = $_GET['redirect'] ?? 'index.php';
$mensaje = isset($_GET['redirect']) && $_GET['redirect'] === 'checkout' ? 'Debes iniciar sesión para realizar tu compra.' : '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $pass = $_POST['password'] ?? '';

    $file = __DIR__ . '/data/usuarios.json';
    $usuarios = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

    $usuario_valido = null;
    foreach ($usuarios as $u) {
        if ($u['email'] === $email && password_verify($pass, $u['password'])) {
            $usuario_valido = $u;
            break;
        }
    }

    if ($usuario_valido) {
        $_SESSION['cliente_id'] = $usuario_valido['id'];
        $_SESSION['cliente_nombre'] = $usuario_valido['nombre'];
        
        $destino = ($redirect === 'checkout') ? 'checkout.php' : 'index.php';
        header("Location: $destino");
        exit;
    } else {
        $error = 'Credenciales incorrectas.';
    }
}

require_once __DIR__ . '/includes/header.php';
?>
