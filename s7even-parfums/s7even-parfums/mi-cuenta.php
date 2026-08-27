<?php
$page_title = 'Mi Cuenta - S7even Parfums';
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/productos.php';
require_once __DIR__ . '/includes/carrito.php';

// Redirigir si no ha iniciado sesión
if (!isset($_SESSION['cliente_id'])) {
    header('Location: login.php');
    exit;
}

// Procesar cierre de sesión
if (isset($_GET['logout'])) {
    unset($_SESSION['cliente_id']);
    unset($_SESSION['cliente_nombre']);
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/includes/header.php';
?>

<main style="min-height: 70vh; display: flex; align-items: center; justify-content: center; padding: 40px 20px;">
  <div style="background: rgba(20, 20, 20, 0.85); border: 1px solid rgba(197, 160, 89, 0.3); padding: 40px; border-radius: 8px; width: 100%; max-width: 450px; text-align: center;">
    <h2 style="font-family: 'Cinzel', serif; color: #c5a059; margin-bottom: 10px;">¡Hola, <?= htmlspecialchars($_SESSION['cliente_nombre']) ?>!</h2>
    <p style="color: #ccc; font-size: 0.9rem; margin-bottom: 30px;">Bienvenido a tu panel de cliente.</p>

    <div style="display: flex; flex-direction: column; gap: 15px;">
      <a href="tienda.php" style="background: linear-gradient(135deg, #c5a059, #9a7b3e); color: #000; text-decoration: none; padding: 12px; font-weight: 600; border-radius: 4px; font-family: 'Cinzel', serif;">IR A LA TIENDA</a>
      <a href="mi-cuenta.php?logout=1" style="color: #ff6b6b; border: 1px solid rgba(255, 107, 107, 0.4); text-decoration: none; padding: 10px; border-radius: 4px; font-size: 0.85rem;">CERRAR SESIÓN</a>
    </div>
  </div>
</main>
