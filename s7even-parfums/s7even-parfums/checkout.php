<?php
$page_title = 'Finalizar Pedido - S7even Parfums';
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/productos.php';
require_once __DIR__ . '/includes/carrito.php';

// Tu número real de WhatsApp (Perú +51)
$numero_whatsapp = "51982424158"; 

// Obtener carrito de la sesión de forma directa y segura
$carrito = $_SESSION['carrito'] ?? [];

// Calcular total
$total = 0;
foreach ($carrito as $item) {
    $total += ($item['precio'] * $item['cantidad']);
}

if (empty($carrito)) {
    header('Location: tienda.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $direccion = trim($_POST['direccion'] ?? '');
    $ciudad = trim($_POST['ciudad'] ?? '');
    $metodo_pago = trim($_POST['metodo_pago'] ?? '');
    $notas = trim($_POST['notas'] ?? '');

    if ($nombre && $telefono && $direccion && $ciudad) {
        // 1. Guardar pedido en el JSON para el Panel Admin
        $file_pedidos = __DIR__ . '/data/pedidos.json';
        $pedidos = file_exists($file_pedidos) ? json_decode(file_get_contents($file_pedidos), true) : [];

        $nuevo_pedido = [
            'id' => 'ORD-' . strtoupper(substr(uniqid(), -6)),
            'fecha' => date('Y-m-d H:i:s'),
            'cliente' => [
                'nombre' => $nombre,
                'telefono' => $telefono,
                'email' => $email,
                'direccion' => $direccion,
                'ciudad' => $ciudad
            ],
            'productos' => array_values($carrito),
            'total' => $total,
            'metodo_pago' => $metodo_pago,
            'notas' => $notas,
            'estado' => 'Pendiente'
        ];

        $pedidos[] = $nuevo_pedido;
        file_put_contents($file_pedidos, json_encode($pedidos, JSON_PRETTY_PRINT));

        // 2. Vaciar el carrito
        $_SESSION['carrito'] = [];

        // 3. Crear el mensaje formateado para WhatsApp
        $msg  = "✨ *NUEVO PEDIDO - S7EVEN PARFUMS* ✨\n";
        $msg .= "*Código:* " . $nuevo_pedido['id'] . "\n\n";
        $msg .= "*Cliente:* " . $nombre . "\n";
        $msg .= "*Teléfono:* " . $telefono . "\n";
        $msg .= "*Dirección:* " . $direccion . " (" . $ciudad . ")\n";
        $msg .= "*Método de Pago:* " . $metodo_pago . "\n\n";
        $msg .= "*DETALLE DEL PEDIDO:*\n";

        foreach ($carrito as $item) {
            $msg .= "• " . $item['nombre'] . " (x" . $item['cantidad'] . ") - S/ " . number_format($item['precio'] * $item['cantidad'], 2) . "\n";
        }

        $msg .= "\n*TOTAL A PAGAR:* S/ " . number_format($total, 2);
        if ($notas) {
            $msg .= "\n\n*Notas:* " . $notas;
        }

        // 4. Redirigir a WhatsApp
        $url_wa = "https://api.whatsapp.com/send?phone=" . $numero_whatsapp . "&text=" . urlencode($msg);
        header('Location: ' . $url_wa);
        exit;
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<main style="min-height: 85vh; padding: 60px 20px; display: flex; justify-content: center;">
  <div style="max-width: 1000px; width: 100%; display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
    
    <!-- Resumen del Pedido -->
    <div style="background: rgba(20, 20, 20, 0.85); border: 1px solid rgba(197, 160, 89, 0.3); padding: 30px; border-radius: 8px;">
      <h2 style="font-family: 'Cinzel', serif; color: #c5a059; margin-bottom: 20px;">Resumen de Compra</h2>
      
      <div style="display: flex; flex-direction: column; gap: 15px; margin-bottom: 25px;">
        <?php foreach ($carrito as $item): ?>
          <div style="display: flex; justify-content: space-between; border-bottom: 1px solid rgba(197, 160, 89, 0.15); padding-bottom: 10px;">
            <div>
              <p style="color: #fff; margin: 0; font-weight: 500;"><?= htmlspecialchars($item['nombre']) ?></p>
              <span style="color: #888; font-size: 0.8rem;">Cantidad: <?= $item['cantidad'] ?></span>
            </div>
            <span style="color: #c5a059;">S/ <?= number_format($item['precio'] * $item['cantidad'], 2) ?></span>
          </div>
        <?php endforeach; ?>
      </div>

      <div style="display: flex; justify-content: space-between; font-size: 1.2rem; font-family: 'Cinzel', serif; color: #c5a059; border-top: 1px solid rgba(197, 160, 89, 0.3); padding-top: 15px;">
        <span>Total a pagar</span>
        <span>S/ <?= number_format($total, 2) ?></span>
      </div>

      <div style="margin-top: 30px; border-top: 1px solid rgba(197, 160, 89, 0.2); padding-top: 20px;">
        <h4 style="color: #c5a059; font-family: 'Cinzel', serif; font-size: 0.9rem; margin-bottom: 10px;">MÉTODOS DE PAGO</h4>
        <p style="color: #ccc; font-size: 0.85rem; margin: 5px 0;">Yape / Plin: <strong>982 424 158</strong></p>
        <p style="color: #ccc; font-size: 0.85rem; margin: 5px 0;">BCP — Cuenta Soles: <strong>000-000000-0-00</strong></p>
        <p style="color: #888; font-size: 0.8rem; margin-top: 15px;">Confirmamos tu pedido por WhatsApp apenas lo recibamos.</p>
      </div>
    </div>

    <!-- Formulario de Envío -->
    <div style="background: rgba(20, 20, 20, 0.85); border: 1px solid rgba(197, 160, 89, 0.3); padding: 30px; border-radius: 8px;">
      <h2 style="font-family: 'Cinzel', serif; color: #c5a059; margin-bottom: 20px;">Datos de Envío</h2>

      <form method="POST" style="display: flex; flex-direction: column; gap: 15px;">
        <input type="text" name="nombre" placeholder="Nombre completo *" required style="background: transparent; border: 1px solid rgba(197, 160, 89, 0.4); border-radius: 4px; color: #fff; padding: 10px; font-size: 0.9rem;">
        <input type="tel" name="telefono" placeholder="Teléfono / WhatsApp *" required style="background: transparent; border: 1px solid rgba(197, 160, 89, 0.4); border-radius: 4px; color: #fff; padding: 10px; font-size: 0.9rem;">
        <input type="email" name="email" placeholder="Correo electrónico (Opcional)" style="background: transparent; border: 1px solid rgba(197, 160, 89, 0.4); border-radius: 4px; color: #fff; padding: 10px; font-size: 0.9rem;">
        <input type="text" name="direccion" placeholder="Dirección de envío *" required style="background: transparent; border: 1px solid rgba(197, 160, 89, 0.4); border-radius: 4px; color: #fff; padding: 10px; font-size: 0.9rem;">
        <input type="text" name="ciudad" placeholder="Distrito / Ciudad *" required style="background: transparent; border: 1px solid rgba(197, 160, 89, 0.4); border-radius: 4px; color: #fff; padding: 10px; font-size: 0.9rem;">
        
        <select name="metodo_pago" required style="background: #141414; border: 1px solid rgba(197, 160, 89, 0.4); border-radius: 4px; color: #fff; padding: 10px; font-size: 0.9rem;">
          <option value="Yape / Plin">Yape / Plin</option>
          <option value="Transferencia BCP">Transferencia BCP</option>
          <option value="Efectivo contraentrega">Efectivo contraentrega</option>
        </select>

        <textarea name="notas" placeholder="Referencia de dirección, horario de entrega, etc. (Opcional)" rows="3" style="background: transparent; border: 1px solid rgba(197, 160, 89, 0.4); border-radius: 4px; color: #fff; padding: 10px; font-size: 0.9rem; resize: none;"></textarea>

        <button type="submit" style="background: linear-gradient(135deg, #c5a059, #9a7b3e); color: #000; border: none; padding: 14px; font-weight: 600; cursor: pointer; border-radius: 4px; font-family: 'Cinzel', serif; margin-top: 10px;">CONFIRMAR PEDIDO</button>
      </form>
    </div>

  </div>
</main>
