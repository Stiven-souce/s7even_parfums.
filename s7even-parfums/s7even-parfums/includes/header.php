<?php
/**
 * Header compartido. Espera opcionalmente $page_title.
 * Debe incluirse DESPUÉS de config.php + productos.php + carrito.php.
 */
$page_title = $page_title ?? SITE_NAME;
$contador_carrito = s7_carrito_contador();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($page_title) ?></title>
<link rel="icon" href="<?= $base ?? '' ?>assets/logo.png" type="image/png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,400&family=Cinzel:wght@400;500;600&family=Poppins:wght@200;300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= $base ?? '' ?>css/style.css">
</head>
<body>
<div class="grain"></div>

<header class="nav" id="nav">
  <div class="nav__inner">
    <a href="<?= $base ?? '' ?>index.php" class="nav__brand">
      <img src="<?= $base ?? '' ?>assets/logo.png" alt="S7even Parfums" class="nav__logo">
    </a>
    
    <nav class="nav__links">
      <a href="<?= $base ?? '' ?>index.php#manifiesto">Manifiesto</a>
      <a href="<?= $base ?? '' ?>index.php#piramide">La Esencia</a>
      <a href="<?= $base ?? '' ?>tienda.php">Tienda</a>
      <a href="<?= $base ?? '' ?>index.php#contacto">Contacto</a>
    </nav>

    <div class="nav__actions" style="display: flex; align-items: center; gap: 15px;">
      <!-- Buscador -->
      <form action="<?= $base ?? '' ?>tienda.php" method="GET" class="nav__search-form" style="display: flex; align-items: center;">
        <input type="text" name="q" placeholder="Buscar..." class="nav__search-input" style="background: transparent; border: 1px solid rgba(197, 160, 89, 0.4); border-radius: 4px; color: #fff; padding: 4px 8px; font-size: 12px; outline: none; width: 100px;">
        <button type="submit" style="background: none; border: none; color: #c5a059; cursor: pointer; padding-left: 5px;" title="Buscar">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        </button>
      </form>

      <!-- Botón Usuario / Login de Clientes -->
      <a href="<?= $base ?? '' ?>login.php" class="nav__icon-btn" title="Mi Cuenta" style="color: #c5a059; display: flex; align-items: center;">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
      </a>

      <!-- Carrito -->
      <a href="<?= $base ?? '' ?>carrito.php" class="nav__cart">
        Carrito
        <?php if ($contador_carrito > 0): ?>
          <span class="nav__cart-badge"><?= $contador_carrito ?></span>
        <?php endif; ?>
      </a>
    </div>

    <button class="nav__burger" id="burger" aria-label="Abrir menú">
      <span></span><span></span><span></span>
    </button>
  </div>
</header>
