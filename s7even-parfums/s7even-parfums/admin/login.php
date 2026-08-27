<?php
require_once __DIR__ . '/../includes/config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $password = $_POST['password'] ?? '';

    // Validación segura y directa
    $hash_ingresado = hash('sha256', $password . ADMIN_SALT);

    if ($usuario === ADMIN_USUARIO && ($password === ADMIN_CLAVE_DIRECTA || $hash_ingresado === ADMIN_PASSWORD_HASH)) {
        $_SESSION['admin_logueado'] = true;
        // Se cambió la redirección a pedidos.php
        header('Location: pedidos.php');
        exit;
    } else {
        $error = 'Usuario o contraseña incorrectos.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - S7even Parfums</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body style="background:#0a0a0a; display:flex; align-items:center; justify-content:center; min-height:100vh;">
    <div style="background:rgba(18,18,18,0.95); border:1px solid rgba(197,160,89,0.4); padding:40px; border-radius:8px; max-width:400px; width:100%;">
        <h2 style="font-family:'Cinzel',serif; color:#c5a059; text-align:center; margin-bottom:20px;">Panel de pedidos</h2>
        
        <?php if ($error): ?>
            <p style="color:#ff5555; text-align:center; margin-bottom:15px; font-size:0.9rem;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="POST" style="display:flex; flex-direction:column; gap:15px;">
            <label style="color:#c5a059; font-size:0.8rem; letter-spacing:1px;">USUARIO</label>
            <input type="text" name="usuario" required style="background:#141414; border:1px solid rgba(197,160,89,0.4); padding:10px; color:#fff; border-radius:4px;">
            
            <label style="color:#c5a059; font-size:0.8rem; letter-spacing:1px;">CONTRASEÑA</label>
            <input type="password" name="password" required style="background:#141414; border:1px solid rgba(197,160,89,0.4); padding:10px; color:#fff; border-radius:4px;">

            <button type="submit" style="background:linear-gradient(135deg, #c5a059, #9a7b3e); color:#000; padding:12px; border:none; font-weight:600; font-family:'Cinzel',serif; border-radius:4px; cursor:pointer; margin-top:10px;">INGRESAR</button>
        </form>
    </div>
</body>
</html>
