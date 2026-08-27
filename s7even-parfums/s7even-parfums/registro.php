<?php
$page_title = 'Crear Cuenta - S7even Parfums';
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/productos.php';
require_once __DIR__ . '/includes/carrito.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pass = $_POST['password'] ?? '';

    $file = __DIR__ . '/data/usuarios.json';
    $usuarios = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

    // Validar si el correo ya existe
    $existe = false;
    foreach ($usuarios as $u) {
        if ($u['email'] === $email) { $existe = true; break; }
    }

    if ($existe) {
        $error = 'El correo electrónico ya está registrado.';
    } elseif ($nombre && $email && $pass) {
        $usuarios[] = [
            'id' => uniqid(),
            'nombre' => $nombre,
            'email' => $email,
            'password' => password_hash($pass, PASSWORD_DEFAULT)
        ];
        file_put_contents($file, json_encode($usuarios, JSON_PRETTY_PRINT));
        header('Location: login.php?registrado=1');
        exit;
    } else {
        $error = 'Por favor completa todos los campos.';
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<main style="min-height: 80vh; display: flex; align-items: center; justify-content: center; padding: 40px 20px;">
  <div style="background: rgba(20, 20, 20, 0.85); border: 1px solid rgba(197, 160, 89, 0.3); padding: 40px; border-radius: 8px; width: 100%; max-width: 400px; text-align: center;">
    
    <h2 style="font-family: 'Cinzel', serif; color: #c5a059; margin-bottom: 20px;">Crear Cuenta</h2>
    
    <?php if ($error): ?>
      <p style="color: #ff6b6b; font-size: 0.85rem; margin-bottom: 15px;"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" style="display: flex; flex-direction: column; gap: 15px;">
      <input type="text" name="nombre" placeholder="Nombre completo" required style="background: transparent; border: 1px solid rgba(197, 160, 89, 0.4); border-radius: 4px; color: #fff; padding: 10px; font-size: 0.9rem;">
      <input type="email" name="email" placeholder="Correo electrónico" required style="background: transparent; border: 1px solid rgba(197, 160, 89, 0.4); border-radius: 4px; color: #fff; padding: 10px; font-size: 0.9rem;">
      <input type="password" name="password" placeholder="Contraseña" required style="background: transparent; border: 1px solid rgba(197, 160, 89, 0.4); border-radius: 4px; color: #fff; padding: 10px; font-size: 0.9rem;">
      
      <button type="submit" style="background: linear-gradient(135deg, #c5a059, #9a7b3e); color: #000; border: none; padding: 12px; font-weight: 600; cursor: pointer; border-radius: 4px; font-family: 'Cinzel', serif;">REGISTRARSE</button>
    </form>

    <div style="margin-top: 20px;">
      <a href="login.php" style="color: #c5a059; text-decoration: none; font-size: 0.85rem;">¿Ya tienes cuenta? Inicia sesión</a>
    </div>
  </div>
</main>
