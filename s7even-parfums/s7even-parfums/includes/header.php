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
    <a href="<?= $base ?? '' ?>carrito.php" class="nav__cart">
      Carrito
      <?php if ($contador_carrito > 0): ?>
        <span class="nav__cart-badge"><?= $contador_carrito ?></span>
      <?php endif; ?>
    </a>
    <button class="nav__burger" id="burger" aria-label="Abrir menú">
      <span></span><span></span><span></span>
    </button>
  </div>
</header>
