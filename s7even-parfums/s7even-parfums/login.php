<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/carrito.php';

$error = '';
$redirect = $_GET['redirect'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';

    $file_clientes = __DIR__ . '/data/clientes.json';
    $clientes = file_exists($file_clientes) ? json_decode(file_get_contents($file_clientes), true) : [];

    $usuario_encontrado = null;
    if (is_array($clientes)) {
        foreach ($clientes as $c) {
            if (isset($c['email']) && strtolower($c['email']) === $email) {
                $usuario_encontrado = $c;
                break;
            }
        }
    }

    if ($usuario_encontrado && (password_verify($password, $usuario_encontrado['password']) || $password === $usuario_encontrado['password'])) {
        $_SESSION['cliente_id'] = $usuario_encontrado['id'];
        $_SESSION['cliente_nombre'] = $usuario_encontrado['nombre'];
        $_SESSION['cliente_email'] = $usuario_encontrado['email'];

        $destino = ($redirect === 'checkout') ? 'checkout.php' : 'index.php';
        header("Location: $destino");
        exit;
    } else {
        $error = 'Credenciales incorrectas.';
    }
}

$page_title = 'Iniciar Sesión - S7even Parfums';
require_once __DIR__ . '/includes/header.php';
?>

<main style="min-height: 80vh; display: flex; align-items: center; justify-content: center; padding: 40px 20px;">
  <div style="background: rgba(18, 18, 18, 0.95); border: 1px solid rgba(197, 160, 89, 0.4); padding: 40px; border-radius: 8px; max-width: 450px; width: 100%;">
    <h2 style="font-family: 'Cinzel', serif; color: #c5a059; text-align: center; margin-bottom: 25px;">INICIAR SESIÓN</h2>

    <?php if (isset($_GET['registrado'])): ?>
      <p style="color: #4CAF50; text-align: center; margin-bottom: 15px; font-size: 0.9rem;">Cuenta creada con éxito. Inicia sesión.</p>
    <?php endif; ?>

    <?php if ($error): ?>
      <p style="color: #ff5555; text-align: center; margin-bottom: 15px; font-size: 0.9rem;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" style="display: flex; flex-direction: column; gap: 15px;">
      <input type="email" name="email" placeholder="Correo electrónico" required style="background: #141414; border: 1px solid rgba(197, 160, 89, 0.4); padding: 12px; color: #fff; border-radius: 4px;">
      <input type="password" name="password" placeholder="Contraseña" required style="background: #141414; border: 1px solid rgba(197, 160, 89, 0.4); padding: 12px; color: #fff; border-radius: 4px;">

      <button type="submit" style="background: linear-gradient(135deg, #c5a059, #9a7b3e); color: #000; padding: 12px; border: none; font-weight: 600; font-family: 'Cinzel', serif; border-radius: 4px; cursor: pointer; margin-top: 10px;">INGRESAR</button>
    </form>

    <p style="text-align: center; margin-top: 20px; color: #888; font-size: 0.85rem;">
      <a href="registro.php<?= $redirect ? '?redirect=' . urlencode($redirect) : '' ?>" style="color: #c5a059; text-decoration: none;">Crear cuenta</a>
    </p>
  </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
