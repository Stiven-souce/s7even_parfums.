<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/productos.php';
require_once __DIR__ . '/includes/db.php';

$id = $_GET['id'] ?? '';

// 1. Intentar buscar en el catálogo local (includes/productos.php)
$producto = s7_producto($id);

// 2. Si no existe localmente, buscar en Supabase por ID o slug (insensible a mayúsculas)
if (!$producto && !empty($id)) {
    // Si el ID es numérico o una cadena
    $query = 'productos?id=eq.' . urlencode($id);
    $res = supabase_request($query, 'GET');

    if (!empty($res) && isset($res[0])) {
        $producto = $res[0];
    } else {
        // Búsqueda alternativa por coincidencia de nombre si el ID venía como slug
        $querySlug = 'productos?nombre=ilike.' . urlencode(str_replace('-', ' ', $id));
        $resSlug = supabase_request($querySlug, 'GET');
        if (!empty($resSlug) && isset($resSlug[0])) {
            $producto = $resSlug[0];
        }
    }
}

// Si no existe en ningún lado, redirigir al catálogo
if (!$producto) {
    header('Location: catalogo.php');
    exit;
}

$page_title = htmlspecialchars($producto['nombre']) . " — S7even Parfums";
require __DIR__ . '/includes/header.php';
?>

<div class="producto-detalle-container" style="max-width: 1100px; margin: 40px auto; padding: 0 20px;">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <!-- Tag de Categoría -->
        <span class="categoria-badge" style="background: #111; border: 1px solid #c5a059; color: #c5a059; padding: 6px 16px; border-radius: 20px; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px;">
            <?= htmlspecialchars($producto['categoria'] ?? 'Árabes') ?>
        </span>

        <!-- Botón Volver -->
        <a href="javascript:history.back()" class="btn-volver" style="color: #fff; text-decoration: none; border: 1px solid rgba(255,255,255,0.2); padding: 8px 18px; border-radius: 20px; font-size: 0.9rem;">
            ← Volver
        </a>
    </div>

    <div class="producto-detalle-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: start;">
        
        <!-- LADO IZQUIERDO: Imagen del Producto -->
        <div class="producto-galeria" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(197, 160, 89, 0.2); padding: 30px; border-radius: 12px; text-align: center;">
            <?php if (!empty($producto['imagen'])): ?>
                <img src="<?= htmlspecialchars($producto['imagen']) ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>" style="max-width: 100%; max-height: 420px; object-fit: contain; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.8));">
            <?php else: ?>
                <div class="frasco <?= htmlspecialchars($producto['clase'] ?? 'gold') ?>" style="margin: 40px auto;">
                    <div class="frasco__cap"></div>
                    <div class="frasco__neck"></div>
                    <div class="frasco__body"><span>S7</span></div>
                </div>
            <?php endif; ?>
        </div>

        <!-- LADO DERECHO: Información y Compra -->
        <div class="producto-info">
            <p class="marca" style="color: #c5a059; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 5px; font-size: 0.9rem;">
                <?= htmlspecialchars($producto['marca'] ?? 'S7EVEN') ?>
            </p>
            <h1 style="font-size: 2.2rem; margin: 0 0 15px 0; font-family: 'Cinzel', serif; color: #fff;">
                <?= htmlspecialchars($producto['nombre']) ?>
            </h1>

            <!-- Precio -->
            <div class="precio-box" style="margin-bottom: 20px;">
                <span style="font-size: 1.8rem; font-weight: bold; color: #c5a059;">
                    <?= s7_formato_precio((float)$producto['precio']) ?>
                </span>
            </div>

            <!-- Notas de Aroma / Descripción -->
            <div class="descripcion" style="margin-bottom: 25px; border-top: 1px solid rgba(255,255,255,0.1); border-bottom: 1px solid rgba(255,255,255,0.1); padding: 15px 0;">
                <h4 style="color: #c5a059; margin-bottom: 8px;">📖 Descripción del aroma</h4>
                <p style="color: #ccc; line-height: 1.6; font-size: 0.95rem;">
                    <?= htmlspecialchars($producto['notas'] ?? $producto['descripcion'] ?? 'Fragancia exclusiva de alta duración con proyección elegante y refinada.') ?>
                </p>
            </div>

            <!-- Calculadora de Cantidad -->
            <div class="selector-cantidad-box" style="background: rgba(0,0,0,0.3); padding: 20px; border-radius: 8px; margin-bottom: 25px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                    <label style="color: #fff;">Cantidad</label>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <button type="button" onclick="decrementar()" style="background: #222; border: 1px solid #444; color: #fff; width: 32px; height: 32px; border-radius: 4px; cursor: pointer;">-</button>
                        <input type="number" id="cantidadInput" value="1" min="1" readonly style="width: 45px; text-align: center; background: transparent; border: none; color: #fff; font-weight: bold;">
                        <button type="button" onclick="incrementar()" style="background: #222; border: 1px solid #444; color: #fff; width: 32px; height: 32px; border-radius: 4px; cursor: pointer;">+</button>
                    </div>
                </div>
                
                <div style="display: flex; justify-content: space-between; font-size: 1.1rem; color: #fff; border-top: 1px solid #333; padding-top: 10px;">
                    <span>Total estimado:</span>
                    <strong id="totalEstimado" style="color: #c5a059;"><?= s7_formato_precio((float)$producto['precio']) ?></strong>
                </div>
            </div>

            <!-- Botones de Acción -->
            <div style="display: flex; flex-direction: column; gap: 12px;">
                <form action="carrito-agregar.php" method="post">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($producto['id']) ?>">
                    <input type="hidden" id="formCantidad" name="cantidad" value="1">
                    <button type="submit" class="btn btn--gold" style="width: 100%; text-align: center; padding: 14px; background: linear-gradient(135deg, #c5a059 0%, #9e7d3b 100%); color: #000; font-weight: bold; border: none; border-radius: 4px; cursor: pointer;">Añadir al carrito</button>
                </form>

                <a id="btnWsp" href="https://api.whatsapp.com/send?phone=51982424158&text=<?= urlencode('Hola, deseo comprar 1 unidad(es) de ' . $producto['nombre']) ?>" target="_blank" class="btn btn--outline" style="text-align: center; padding: 14px; border: 1px solid #25D366; color: #25D366; border-radius: 4px; text-decoration: none; font-weight: bold;">
                    Comprar por WhatsApp
                </a>
            </div>

        </div>
    </div>
</div>

<script>
const precioUnitario = <?= (float)$producto['precio'] ?>;

function incrementar() {
    let input = document.getElementById('cantidadInput');
    let val = parseInt(input.value) + 1;
    input.value = val;
    actualizarTotal(val);
}

function decrementar() {
    let input = document.getElementById('cantidadInput');
    if (parseInt(input.value) > 1) {
        let val = parseInt(input.value) - 1;
        input.value = val;
        actualizarTotal(val);
    }
}

function actualizarTotal(cant) {
    document.getElementById('formCantidad').value = cant;
    let total = cant * precioUnitario;
    document.getElementById('totalEstimado').innerText = 'S/ ' + total.toFixed(2);
    
    let mensajeWA = `Hola, deseo comprar ${cant} unidad(es) de <?= rawurlencode($producto['nombre']) ?>`;
    document.getElementById('btnWsp').href = `https://api.whatsapp.com/send?phone=51982424158&text=${mensajeWA}`;
}
</script>

<?php require __DIR__ . '/includes/footer.php'; ?>
