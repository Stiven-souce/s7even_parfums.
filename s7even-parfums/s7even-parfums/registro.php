<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/carrito.php';

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
        // Consultar Supabase para verificar si el correo ya está registrado
        $resultado = supabase_request('clientes?email=eq.' . urlencode($email), 'GET');

        if (!empty($resultado) && isset($resultado[0]) && !isset($resultado['error'])) {
            $error = 'El correo electrónico ya está registrado.';
        } else {
            $nuevo_id = 'CLI-' . strtoupper(substr(uniqid(), -6));

            $nuevo_cliente = [
                'id' => $nuevo_id,
                'nombre' => $nombre,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'fecha_registro' => date('Y-m-d H:i:s')
            ];

            // Insertar nuevo usuario en Supabase
            $respuesta = supabase_request('clientes', 'POST', $nuevo_cliente);

            if (isset($respuesta['error']) || (isset($respuesta['message']) && !isset($respuesta[0]))) {
                $mensaje_db = $respuesta['message'] ?? ($respuesta['hint'] ?? 'Error de conexión');
                $error = 'Error de Supabase: ' . htmlspecialchars($mensaje_db);
            } else {
                $_SESSION['cliente_id'] = $nuevo_id;
                $_SESSION['cliente_nombre'] = $nombre;
                $_SESSION['cliente_email'] = $email;

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
      <p style="color: #ff5555; text-align: center; margin-bottom: 15px; font-size: 0.9rem;"><?= $error ?></p>
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
