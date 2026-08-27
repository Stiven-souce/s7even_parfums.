<?php
/**
 * Almacenamiento de pedidos en un archivo JSON (data/pedidos.json).
 * Sencillo y funciona en cualquier hosting con PHP, sin necesitar MySQL.
 * Si más adelante quieres una base de datos real, esta es la única capa
 * que tendrías que reemplazar (las demás páginas solo llaman a estas funciones).
 */

function s7_pedidos_leer(): array {
    if (!file_exists(PEDIDOS_FILE)) return [];
    $fp = fopen(PEDIDOS_FILE, 'r');
    if (!$fp) return [];
    flock($fp, LOCK_SH);
    $contenido = stream_get_contents($fp);
    flock($fp, LOCK_UN);
    fclose($fp);
    $data = json_decode($contenido, true);
    return is_array($data) ? $data : [];
}

function s7_pedidos_guardar(array $pedidos): bool {
    $dir = dirname(PEDIDOS_FILE);
    if (!is_dir($dir)) mkdir($dir, 0775, true);

    $fp = fopen(PEDIDOS_FILE, 'c+');
    if (!$fp) return false;
    flock($fp, LOCK_EX);
    ftruncate($fp, 0);
    rewind($fp);
    fwrite($fp, json_encode($pedidos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    fflush($fp);
    flock($fp, LOCK_UN);
    fclose($fp);
    return true;
}

/** Genera un número de pedido corto y legible, ej: S7-20260826-4F2A */
function s7_generar_numero_pedido(): string {
    return 'S7-' . date('Ymd') . '-' . strtoupper(substr(bin2hex(random_bytes(2)), 0, 4));
}

/**
 * Guarda un nuevo pedido. $items = resultado de s7_carrito_items().
 * Devuelve el arreglo del pedido creado (incluye 'numero').
 */
function s7_pedido_crear(array $cliente, array $items, float $total): array {
    $pedidos = s7_pedidos_leer();

    $pedido = [
        'numero'    => s7_generar_numero_pedido(),
        'fecha'     => date('Y-m-d H:i:s'),
        'cliente'   => $cliente, // nombre, telefono, correo, direccion, distrito, metodo_pago, notas
        'items'     => array_map(function ($item) {
            return [
                'id'       => $item['producto']['id'],
                'nombre'   => $item['producto']['nombre'],
                'precio'   => $item['producto']['precio'],
                'cantidad' => $item['cantidad'],
                'subtotal' => $item['subtotal'],
            ];
        }, $items),
        'total'     => $total,
        'estado'    => 'pendiente', // pendiente | pagado | enviado | cancelado
    ];

    $pedidos[] = $pedido;
    s7_pedidos_guardar($pedidos);

    return $pedido;
}

function s7_pedido_actualizar_estado(string $numero, string $estado): bool {
    $pedidos = s7_pedidos_leer();
    $encontrado = false;
    foreach ($pedidos as &$p) {
        if ($p['numero'] === $numero) {
            $p['estado'] = $estado;
            $encontrado = true;
            break;
        }
    }
    unset($p);
    if ($encontrado) s7_pedidos_guardar($pedidos);
    return $encontrado;
}

function s7_pedido_buscar(string $numero): ?array {
    foreach (s7_pedidos_leer() as $p) {
        if ($p['numero'] === $numero) return $p;
    }
    return null;
}
