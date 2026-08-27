<?php
require_once __DIR__ . '/includes/config.php';

$error = '';
$redirect = $_GET['redirect'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';

    if (empty($nombre) || empty($email) || empty($password)) {
        $error = 'Por favor completa todos los campos.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Ingresa un correo electrónico válido.';
    } else {
        $dir_data = __DIR__ . '/data';
        if (!is_dir($dir_data)) {
            mkdir($dir_data, 0777, true);
        }

        $file_clientes = $dir_data . '/clientes.json';
        $clientes = file_exists($file_clientes) ? json_decode(file_get_contents($file_clientes), true) : [];
        if (!is_array($clientes)) {
            $clientes = [];
        }

        // Verificar si el correo ya existe
        $existe = false;
        foreach ($clientes as $c) {
            if (isset($c['email']) && strtolower($c['email']) === $email) {
                $existe = true;
                break;
            }
        }

        if ($existe) {
            $error = 'El correo electrónico ya está registrado.';
        } else {
            $nuevo_cliente = [
                'id' => 'CLI-' . strtoupper(substr(uniqid(), -6)),
                'nombre' => $nombre,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'fecha_registro' => date('Y-m-d H:i:s')
            ];

            $clientes[] = $nuevo_cliente;
            $guardado = file_put_contents($file_clientes, json_encode($clientes, JSON_PRETTY_PRINT));

            if ($guardado === false) {
                $error = 'Error de escritura en el servidor. Inténtalo de nuevo.';
            } else {
                // Iniciar sesión automáticamente tras crear la cuenta
                $_SESSION['cliente_id'] = $nuevo_cliente['id'];
                $_SESSION['cliente_nombre'] = $nuevo_cliente['nombre'];
                $_SESSION['cliente_email'] = $nuevo_cliente['email'];

                $destino = ($redirect === 'checkout') ? 'checkout.php' : 'index.php';
                header("Location: $destino");
                exit;
            }
        }
    }
}

$page_title = 'Crear Cuenta - S7even Parfums';
require_once __DIR__ . '/includes/header.php';
?>

<main style="min-height: 80vh; display: flex; align-items: center; justify-content: center; padding: 40px 20px;">
  <div style="background: rgba(18, 18, 18, 0.95); border: 1px solid rgba(197, 160, 89, 0.4); padding: 40px; border-radius: 8px; max-width: 450px; width: 100%;">
    <h2 style="font-family: 'Cinzel', serif; color: #c5a059; text-align: center; margin-bottom: 25px;">CREAR CUENTA</h2>

    <?php if ($error): ?>
      <p style="color: #ff5555; text-align: center; margin-bottom: 15px; font-size: 0.9rem;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" style="display: flex; flex-direction: column; gap: 15px;">
      <input type="text" name="nombre" placeholder="Nombre completo" required style="background: #141414; border: 1px solid rgba(197, 160, 89, 0.4); padding: 12px; color: #fff; border-radius: 4px;">
      <input type="email" name="email" placeholder="Correo electrónico" required style="background: #141414; border: 1px solid rgba(197, 160, 89, 0.4); padding: 12px; color: #fff; border-radius: 4px;">
      <input type="password" name="password" placeholder="Contraseña" required style="background: #141414; border: 1px solid rgba(197, 160, 89, 0.4); padding: 12px; color: #fff; border-radius: 4px;">

      <button type="submit" style="background: linear-gradient(135deg, #c5a059, #9a7b3e); color: #000; padding: 12px; border: none; font-weight: 600; font-family: 'Cinzel', serif; border-radius: 4px; cursor: pointer; margin-top: 10px;">REGISTRARSE</button>
    </form>

    <p style="text-align: center; margin-top: 20px; color: #888; font-size: 0.85rem;">
      ¿Ya tienes cuenta? <a href="login.php<?= $redirect ? '?redirect=' . urlencode($redirect) : '' ?>" style="color: #c5a059; text-decoration: none;">Iniciar sesión</a>
    </p>
  </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
