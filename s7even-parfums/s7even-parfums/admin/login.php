<?php
require_once __DIR__ . '/../includes/config.php';

if (!empty($_SESSION['admin_autenticado'])) {
    header('Location: pedidos.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $clave   = $_POST['clave'] ?? '';
    $hashIngresado = hash('sha256', $clave . ADMIN_SALT);

    if ($usuario === ADMIN_USUARIO && hash_equals(ADMIN_PASSWORD_HASH, $hashIngresado)) {
        $_SESSION['admin_autenticado'] = true;
        header('Location: pedidos.php');
        exit;
    }
    $error = 'Usuario o contraseña incorrectos.';
}

$base = '../';
$page_title = 'Acceso admin — S7even Parfums';
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($page_title) ?></title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body class="admin-body">
<div class="admin-login">
  <img src="../assets/logo.png" alt="S7even Parfums" class="admin-login__logo">
  <h1>Panel de pedidos</h1>
  <?php if ($error): ?><p class="alerta alerta--error"><?= htmlspecialchars($error) ?></p><?php endif; ?>
  <form method="post" class="contacto__form">
    <label>
      <span>Usuario</span>
      <input type="text" name="usuario" required autofocus>
    </label>
    <label>
      <span>Contraseña</span>
      <input type="password" name="clave" required>
    </label>
    <button type="submit" class="btn btn--gold btn--full">Ingresar</button>
  </form>
</div>
</body>
</html>
