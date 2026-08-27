<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

$id = $_GET['id'] ?? 0;
$res = supabase_request('productos?id=eq.' . intval($id), 'GET');

if (empty($res)) {
    header('Location: catalogo.php');
    exit;
}

$p = $res[0];
$link_wa = "https://wa.me/" . WHATSAPP_NUMERO . "?text=" . urlencode("Hola S7even Parfums, deseo consultar sobre el perfume: " . $p['nombre']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($p['nombre']) ?> — S7even Parfums</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .p-container { max-width: 1100px; margin: 40px auto; padding: 0 20px; display: grid; grid-template-columns: 1fr 1fr; gap: 40px; }
        .p-galeria { display: flex; gap: 15px; }
        .p-thumb { width: 70px; height: 70px; border: 1px solid #ccc; border-radius: 8px; padding: 5px; cursor: pointer; object-fit: contain; }
        .p-img-main { width: 100%; max-height: 450px; object-fit: contain; background: #fff; border-radius: 12px; padding: 20px; }
        
        .p-info-box { background: #fff; padding: 30px; border-radius: 12px; border: 1px solid #f0f0f0; }
        .p-badge { background: #f0f4f8; color: #334e68; font-size: 0.75rem; padding: 4px 10px; border-radius: 12px; text-transform: uppercase; }
        .p-titulo { font-family: 'Cinzel', serif; font-size: 1.8rem; margin: 15px 0 5px 0; text-transform: uppercase; }
        .p-precio { font-size: 1.6rem; font-weight: bold; margin: 15px 0; }
        
        .btn-add { width: 100%; background: #000; color: #fff; padding: 14px; border: none; border-radius: 25px; font-weight: bold; cursor: pointer; margin-bottom: 10px; }
        .btn-wa { width: 100%; background: #25d366; color: #fff; padding: 14px; border: none; border-radius: 25px; font-weight: bold; text-decoration: none; display: block; text-align: center; }
        
        .grid-garantias { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 20px; }
        .item-garantia { background: #f9f9f9; padding: 10px; text-align: center; font-size: 0.8rem; border-radius: 8px; border: 1px solid #eee; }
    </style>
</head>
<body style="background:#f8f9fa;">

<div style="max-width:1100px; margin:20px auto; padding:0 20px; font-size:0.85rem; color:#666;">
    <a href="catalogo.php" style="color:#666; text-decoration:none;">Inicio</a> / 
    <a href="catalogo.php" style="color:#666; text-decoration:none;">Catálogo</a> / 
    <b><?= htmlspecialchars($p['nombre']) ?></b>
</div>

<div class="p-container">
    <!-- GALERÍA -->
    <div class="p-galeria">
        <div>
            <img src="<?= htmlspecialchars($p['imagen'] ?? 'img/placeholder.jpg') ?>" class="p-thumb">
        </div>
        <div style="flex:1;">
            <img src="<?= htmlspecialchars($p['imagen'] ?? 'img/placeholder.jpg') ?>" class="p-img-main">
        </div>
    </div>

    <!-- DETALLE DEL PRODUCTO -->
    <div class="p-info-box">
        <div style="display:flex; justify-content:space-between; align-items:center;">
            <span class="p-badge"><?= htmlspecialchars($p['categoria'] ?? 'PERFUME') ?></span>
            <a href="catalogo.php" style="text-decoration:none; color:#666; font-size:0.85rem;">← Volver</a>
        </div>

        <div style="font-size:0.85rem; color:#777; margin-top:10px; text-transform:uppercase;"><?= htmlspecialchars($p['marca'] ?? 'S7even') ?></div>
        <h1 class="p-titulo"><?= htmlspecialchars($p['nombre']) ?></h1>

        <div style="margin-top:5px;">
            <span style="background:#eef9f1; color:#1e7e34; padding:3px 8px; border-radius:10px; font-size:0.75rem;">Disponible</span>
            <span style="background:#f4f4f4; padding:3px 8px; border-radius:10px; font-size:0.75rem; margin-left:5px;"><?= htmlspecialchars($p['genero'] ?? 'Unisex') ?></span>
        </div>

        <div class="p-precio">S/ <?= number_format($p['precio'], 2) ?></div>

        <div style="margin: 20px 0;">
            <strong style="font-size:0.9rem;">Descripción del producto</strong>
            <p style="font-size:0.85rem; color:#555; line-height:1.5; margin-top:5px;">
                <?= htmlspecialchars($p['descripcion'] ?? 'Una fragancia exclusiva y moderna que destaca por su elegancia y fijación duradera.') ?>
            </p>
        </div>

        <!-- ACCIONES COMPRA -->
        <form method="POST" action="carrito.php?accion=agregar">
            <input type="hidden" name="producto_id" value="<?= $p['id'] ?>">
            <div style="margin-bottom:15px; display:flex; align-items:center; gap:10px;">
                <label style="font-size:0.85rem; font-weight:bold;">Cantidad:</label>
                <input type="number" name="cantidad" value="1" min="1" style="width:60px; padding:6px; text-align:center; border:1px solid #ccc; border-radius:6px;">
            </div>
            
            <button type="submit" class="btn-add">Añadir al carrito</button>
        </form>

        <a href="<?= $link_wa ?>" target="_blank" class="btn-wa">Comprar por WhatsApp</a>

        <!-- GARANTÍAS -->
        <div class="grid-garantias">
            <div class="item-garantia">✓ Producto original</div>
            <div class="item-garantia">✓ Pago seguro</div>
            <div class="item-garantia">✓ Envíos a todo el Perú</div>
            <div class="item-garantia">✓ Atención por WhatsApp</div>
        </div>
    </div>
</div>

</body>
</html>
