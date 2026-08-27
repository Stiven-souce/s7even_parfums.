<?php
require_once __DIR__ . '/../includes/config.php';

// Verificar sesión de administrador
if (empty($_SESSION['admin_logueado'])) {
    header('Location: login.php');
    exit;
}

// Cargar pedidos guardados en JSON
$pedidos_file = PEDIDOS_FILE;
$pedidos = [];

if (file_exists($pedidos_file)) {
    $json_content = file_get_contents($pedidos_file);
    $pedidos = json_decode($json_content, true) ?? [];
}

// Ordenar pedidos del más reciente al más antiguo
usort($pedidos, function($a, $b) {
    return strtotime($b['fecha'] ?? 0) - strtotime($a['fecha'] ?? 0);
});
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Pedidos - Admin</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body style="background: #0a0a0a; color: #fff; padding: 40px 20px; font-family: 'Poppins', sans-serif;">
    <div style="max-width: 1100px; margin: 0 auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 1px solid rgba(197, 160, 89, 0.3); padding-bottom: 15px;">
            <h1 style="font-family: 'Cinzel', serif; color: #c5a059; margin: 0;">Panel de Pedidos</h1>
            <a href="logout.php" style="color: #ff5555; text-decoration: none; font-size: 0.9rem;">Cerrar Sesión</a>
        </div>

        <?php if (empty($pedidos)): ?>
            <p style="text-align: center; color: #888; padding: 40px;">No hay pedidos registrados hasta el momento.</p>
        <?php else: ?>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
                    <thead>
                        <tr style="border-bottom: 2px solid #c5a059; color: #c5a059;">
                            <th style="padding: 12px;">Código</th>
                            <th style="padding: 12px;">Fecha</th>
                            <th style="padding: 12px;">Cliente</th>
                            <th style="padding: 12px;">Teléfono</th>
                            <th style="padding: 12px;">Método Pago</th>
                            <th style="padding: 12px;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pedidos as $p): 
                            // Manejo seguro de la variable cliente (si es array o string)
                            $nombre_cliente = 'N/A';
                            if (isset($p['cliente'])) {
                                if (is_array($p['cliente'])) {
                                    $nombre_cliente = $p['cliente']['nombre'] ?? ($p['cliente']['email'] ?? 'Cliente Registrado');
                                } else {
                                    $nombre_cliente = $p['cliente'];
                                }
                            } elseif (isset($p['nombre'])) {
                                $nombre_cliente = $p['nombre'];
                            }
                        ?>
                            <tr style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                                <td style="padding: 12px; font-weight: bold; color: #c5a059;"><?= htmlspecialchars($p['codigo'] ?? ($p['id'] ?? 'N/A')) ?></td>
                                <td style="padding: 12px; color: #aaa;"><?= htmlspecialchars($p['fecha'] ?? 'N/A') ?></td>
                                <td style="padding: 12px;"><?= htmlspecialchars($nombre_cliente) ?></td>
                                <td style="padding: 12px;"><?= htmlspecialchars($p['telefono'] ?? ($p['cliente']['telefono'] ?? 'N/A')) ?></td>
                                <td style="padding: 12px;"><?= htmlspecialchars($p['metodo_pago'] ?? ($p['metodo'] ?? 'N/A')) ?></td>
                                <td style="padding: 12px; font-weight: bold; color: #c5a059;">S/ <?= number_format($p['total'] ?? 0, 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
