<?php
$page_title = 'Iniciar Sesión - S7even Parfums';
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/productos.php';
require_once __DIR__ . '/includes/carrito.php';

$mensaje = isset($_GET['registrado']) ? 'Cuenta creada con éxito. Inicia sesión.' : '';
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
        header('Location: index.php');
        exit;
    } else {
        $error = 'Credenciales incorrectas.';
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<main style="min-height: 80vh; display: flex; align-items: center; justify-content: center; padding: 40px 20px;">
  <div style="background: rgba(20, 20, 20, 0.85); border: 1px solid rgba(197, 160, 89, 0.3); padding: 40px; border-radius: 8px; width: 100%; max-width: 400px; text-align: center;">
    
    <h2 style="font-family: 'Cinzel', serif; color: #c5a059; margin-bottom: 20px;">Iniciar Sesión</h2>
    
    <?php if ($mensaje): ?>
      <p style="color: #51cf66; font-size: 0.85rem; margin-bottom: 15px;"><?= $mensaje ?></p>
    <?php endif; ?>

    <?php if ($error): ?>
      <p style="color: #ff6b6b; font-size: 0.85rem; margin-bottom: 15px;"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" style="display: flex; flex-direction: column; gap: 15px;">
      <input type="email" name="email" placeholder="Correo electrónico" required style="background: transparent; border: 1px solid rgba(197, 160, 89, 0.4); border-radius: 4px; color: #fff; padding: 10px; font-size: 0.9rem;">
      <input type="password" name="password" placeholder="Contraseña" required style="background: transparent; border: 1px solid rgba(197, 160, 89, 0.4); border-radius: 4px; color: #fff; padding: 10px; font-size: 0.9rem;">
      
      <button type="submit" style="background: linear-gradient(135deg, #c5a059, #9a7b3e); color: #000; border: none; padding: 12px; font-weight: 600; cursor: pointer; border-radius: 4px; font-family: 'Cinzel', serif;">INGRESAR</button>
    </form>

    <div style="margin-top: 20px; text-align: left; font-size: 0.85rem;">
      <a href="registro.php" style="color: #c5a059; text-decoration: none;">Crear cuenta</a>
    </div>
  </div>
</main>
